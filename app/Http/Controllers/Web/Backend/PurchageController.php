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
         return view('backend.layout.purchage.index');
    }
}
