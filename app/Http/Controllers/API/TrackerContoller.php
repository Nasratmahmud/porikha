<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Prayer;
use App\Traits\apiresponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TrackerContoller extends Controller
{
    use apiresponse;

    /**
     * Get Avarage of Salat
     * @return \Illuminate\Http\Response
     */
    public function AvgOfSalat(Request $request)
    {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'yearmonth' => 'required|date_format:Y-m',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), "Validation Error", 422);
        }
        // Extract month and year from the input
        $yearMonth = $request->input('yearmonth');
        $year = Carbon::createFromFormat('Y-m', $yearMonth)->year;
        $month = Carbon::createFromFormat('Y-m', $yearMonth)->month;
        $date = Carbon::createFromDate($year, $month, 1);
        $daysInMonth = $date->daysInMonth;

        // Query data for the specified month
        $avgAll = Prayer::whereYear('date', $year)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->where(['fajr' => 1, 'dhuhr' => 1, 'asr' => 1, 'maghrib' => 1, 'isha' => 1])
            ->count();

        // Calculate the total number of prayers for each type
        $fajr = Prayer::where('fajr', 1)->whereYear('date', $year)->whereMonth('date', $month)->count();
        $duhr = Prayer::where('dhuhr', 1)->whereYear('date', $year)->whereMonth('date', $month)->count();
        $asr = Prayer::where('asr', 1)->whereYear('date', $year)->whereMonth('date', $month)->count();
        $maghrib = Prayer::where('maghrib', 1)->whereYear('date', $year)->whereMonth('date', $month)->count();
        $isha = Prayer::where('isha', 1)->whereYear('date', $year)->whereMonth('date', $month)->count();

        // Return success response
        return $this->success([
            'month' => $month,
            'days' => $daysInMonth,
            'avgAll' => $avgAll,
            'fajr' => $fajr,
            'duhr' => $duhr,
            'asr' => $asr,
            'maghrib' => $maghrib,
            'isha' => $isha,
        ], "Prayer fetched successfully", 200);

    }
    /**
     * Get Avarage of Salat
     * @return \Illuminate\Http\Response
     */
    public function dateWizeAvgOfSalat(Request $request)
    {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'date' => 'required|date_format:Y-m-d',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), "Validation Error", 422);
        }
        $prayer = Prayer::where('date', $request->input('date'))
            ->where('user_id', Auth::user()->id)->first(['fajr', 'dhuhr', 'asr', 'maghrib', 'isha', 'date']);
        if ($prayer == null) {
            $prayer = (object) [
                "fajr" => "0",
                "dhuhr" => "0",
                "asr" => "0",
                "maghrib" => "0",
                "isha" => "0",
                "date" => $request->input('date'),
            ];
        }
        // Return success response
        return $this->success([
            'prayer' => $prayer,
        ], "Prayer fetched successfully", 200);

    }

    /**
     * store a specific wake time
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'salat' => 'required|in:fajr,dhuhr,asr,maghrib,isha',
            'date' => 'required|date_format:Y-m-d|after_or_equal:' . Carbon::now()->format('Y-m-d'),
        ]);
        if ($validator->fails()) {
            return $this->error($validator->errors(), "Validation Error", 422);
        }

        // Retrieve the existing record or create a new one
        $prayer = Prayer::firstOrNew(
            [
                'date' => $request->date,
                'user_id' => Auth::user()->id,
            ]
        );

        // Toggle the field value (if it exists, switch between true and false)
        $prayer->{$request->salat} = $prayer->{$request->salat} === 1 ? 0 : 1;

        // Save the updated or new record
        $prayer->save();

        return $this->success($prayer, "Prayer status toggled successfully", 200);
    }
}
