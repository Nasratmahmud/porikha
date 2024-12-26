<?php

namespace App\Http\Controllers\Web\Backend;

use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoicesController extends Controller
{
    //
    public function downloadInvoice($purchaseId)
    {
        $purchases = Purchase::where('user_id',$purchaseId)->get();
        // dd($purchase);
        if (!$purchases) {
            return redirect()->back()->with('error', 'Purchase not found');
        }

        foreach($purchases as $coursePurchase){
            $courses[] = $coursePurchase->course->course_title ;
            $amounts[] = $coursePurchase->course->course_price;
        $user = $coursePurchase->user;
    }
        $amount = array_sum($amounts);
        $coursesList = implode(',',$courses);
        $status = $coursesList ? 'Purchase successfully' : 'No course purchase';

        $data = [
            'userName' => $user->name,
            'courseName' => $coursesList,
            'amount' => number_format($amount/112, 3, '.', ''),
            'status' => $status,
        ];
        $pdf = PDF::loadView('backend.invoice', $data);
        return $pdf->download('invoice_' . $user->name . '.pdf');
    }
}
