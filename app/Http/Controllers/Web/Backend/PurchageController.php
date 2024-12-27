<?php

namespace App\Http\Controllers\Web\Backend;

use App\Models\User;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PurchageController extends Controller
{
    //
    public function index(Request $request)
    {

        $coursesList = '';
        $userId = Auth::user()->id;
        $user = User::find($userId);
        $puchaseTableValue = Purchase::where('user_id',$userId)->get();

        $checkAnyPurchase = $user->cashonpurchases()
            ->whereHas('course', function ($query) {
                $query->whereNotNull('id');
            })
            ->first();
        if( isset( $checkAnyPurchase ) ){
            $purchases = $user->cashonpurchases()
                ->whereHas('course', function ($query) {
                    $query->whereNotNull('id');
                })
                ->get();
            foreach ($purchases as $coursePurchase){
                $courses[] = $coursePurchase->course->course_title ;
                $price[] = $coursePurchase->course->course_price ;
            }
            $coursesList = implode(',',$courses);
            $price = '$'.number_format(array_sum($price)/112,3,'.','');
        }
        else{

            $courses = '';
            $price = '';
           // return redirect()->route('purchases.index')->with('t-success', 'NO purchase');

        }

        // foreach ($puchaseTableValue as $coursePrice){
        //         $price[] = $coursePrice->amount ;
        //     }
        // $price = implode(',',$price);

        $name =  $courses ? Auth::user()->name : '';
        $userId = $courses ? Auth::user()->id : '';
        $status = $courses ? 'Purchase successfully' : '';
        return view('backend.layout.purchage.index',compact('name', 'coursesList','price' , 'status', 'userId'));
    }
}
