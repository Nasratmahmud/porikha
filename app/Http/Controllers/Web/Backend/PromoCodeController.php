<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\PromoCode;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class PromoCodeController extends Controller {
    /**
     * Get all data in table view
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index( Request $request ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'promo code menu' ) ) {
            if ( $request->ajax() ) {

                $data = PromoCode::latest();

                return DataTables::of( $data )
                    ->addIndexColumn()
                    ->addColumn( 'status', function ( $data ) {
                        $status = ' <div class="form-check form-switch d-flex justify-content-center align-items-center">';
                        $status .= ' <input onclick="showStatusChangeAlert(' . $data->id . ')" type="checkbox" class="form-check-input" id="customSwitch' . $data->id . '" getAreaid="' . $data->id . '" name="status"';
                        if ( $data->status == 1 ) {
                            $status .= "checked";
                        }
                        $status .= '><label for="customSwitch' . $data->id . '" class="form-check-label" for="customSwitch"></label></div>';

                        return $status;
                    } )
                    ->addColumn( 'promo_code', function ( $data ) {
                        return "<span class='bg-primary rounded py-1 px-3 text-light me-1'>" . $data->promo_code . "</span>";
                    } )
                    ->addColumn( 'start_date', function ( $data ) {
                        return "<span class='bg-info rounded py-1 px-3 text-light me-1'>" . $data->start_date . "</span>";
                    } )
                    ->addColumn( 'end_date', function ( $data ) {
                        return "<span class='bg-secondary rounded py-1 px-3 text-light me-1'>" . $data->end_date . "</span>";
                    } )
                    ->addColumn( 'discount_percentage', function ( $data ) {
                        return "<span class='bg-success rounded py-1 px-3 text-light me-1'>" . $data->discount_percentage . " %</span>";
                    } )
                    ->addColumn( 'action', function ( $data ) {
                        $user = User::find( auth()->user()->id );
                        $html = '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">';
                        if ( !$user->hasPermissionTo( 'edit promo code' ) && !$user->hasPermissionTo( 'delete promo code' ) ) {
                            $html .= "<span class='text-light bg-danger p-1 rounded-3'>No access</span>";
                        }
                        if ( $user->hasPermissionTo( 'edit promo code' ) ) {
                            $html .= '<a href="' . route( 'promoCode.edit', $data->id ) . '" class="btn btn-sm btn-success"><i class="bx bxs-edit"></i></a>';
                        }
                        if ( $user->hasPermissionTo( 'delete promo code' ) ) {
                            $html .= '<a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button"
                                            class="btn btn-danger btn-sm text-white" title="Delete" readonly>
                                            <i class="bx bxs-trash"></i>
                                        </a>';
                        }
                        $html .= '</div>';
                        return $html;
                    } )
                    ->rawColumns( ['status', 'promo_code', 'end_date', 'start_date', 'discount_percentage', 'action'] )
                    ->make( true );
            }
            return view( 'backend.layout.promo_code.index' );
        }
        return redirect()->back();

    }
    /**
     * Insert View
     *
     * @param Request $request
     * @return Illuminate\Contracts\View\View
     */
    public function create(): View {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'create promo code' ) ) {
            return view( 'backend.layout.promo_code.create' );
        }
        return redirect()->back();

    }
    /**
     * Store data
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store( Request $request ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'create promo code' ) ) {
            $request->validate( [
                'promo_code_title'    => 'required|string|unique:promo_codes,promo_code_title',
                'promo_code'          => 'required|unique:promo_codes,promo_code',
                'discount_percentage' => 'required|numeric',
                'start_date'          => 'required|string',
                'end_date'            => 'required|string',
            ] );

            // Slug Check
            $slug = PromoCode::where( 'promo_code_slug', Str::slug( $request->promo_code_title ) )->first();
            $slug_data = '';

            if ( $slug ) {
                // random string generator
                $randomString = Str::random( 5 );
                $slug_data = Str::slug( $request->promo_code_title ) . $randomString;
            } else {
                $slug_data = Str::slug( $request->promo_code_title );
            }

            // Store data in database
            try {
                $promoCode = new PromoCode();
                $promoCode->promo_code_title = $request->promo_code_title;
                $promoCode->promo_code_slug = $slug_data;
                $promoCode->promo_code = $request->promo_code;
                $promoCode->discount_percentage = $request->discount_percentage;
                $promoCode->start_date = $request->start_date;
                $promoCode->end_date = $request->end_date;
                $promoCode->save();

                return redirect( route( 'promoCode.index' ) )->with( 't-success', 'Promo Code added successfully.' );

            } catch ( Exception $e ) {
                return redirect( route( 'promoCode.create' ) )->with( 't-error', 'Something Went Wrong' );
            }
        }
        return redirect()->back();

    }
    /**
     * Get Selected item data
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit( $id ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'edit promo code' ) ) {
            $promoCode = PromoCode::where( 'id', $id )->first();
            return view( 'backend.layout.promo_code.update', compact( 'promoCode' ) );
        }
        return redirect()->back();

    }
    /**
     * Update selected item in database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update( Request $request ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'edit promo code' ) ) {
            $request->validate( [
                'promo_code_title'    => 'required|string|unique:promo_codes,promo_code_title,' . $request->id . 'id',
                'promo_code'          => 'required|unique:promo_codes,promo_code,' . $request->id . 'id',
                'discount_percentage' => 'required|numeric',
                'start_date'          => 'required|string',
                'end_date'            => 'required|string',
            ] );

            // Slug Check
            $slug = PromoCode::where( 'promo_code_slug', Str::slug( $request->promo_code_title ) )->first();
            $slug_data = '';

            if ( $slug ) {
                // random string generator
                $randomString = Str::random( 5 );
                $slug_data = Str::slug( $request->promo_code_title ) . $randomString;
            } else {
                $slug_data = Str::slug( $request->promo_code_title );
            }

            // Store data in database
            try {
                $promoCode = PromoCode::where( 'id', $request->id )->first();
                $promoCode->promo_code_title = $request->promo_code_title;
                $promoCode->promo_code_slug = $slug_data;
                $promoCode->promo_code = $request->promo_code;
                $promoCode->discount_percentage = $request->discount_percentage;
                $promoCode->start_date = $request->start_date;
                $promoCode->end_date = $request->end_date;
                $promoCode->save();

                return redirect( route( 'promoCode.index' ) )->with( 't-success', 'Promo Code Edit successfully.' );

            } catch ( Exception $e ) {
                return redirect( route( 'promoCode.index' ) )->with( 't-error', 'Something Went Wrong' );
            }
        }
        return redirect()->back();

    }

    /**
     * Delete selected item
     * @param Request $request
     * @param $id
     */
    public function destroy( Request $request, $id ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'delete promo code' ) ) {
            if ( $request->ajax() ) {
                PromoCode::findOrFail( $id )->delete();
                return response()->json( [
                    'success' => true,
                    'message' => 'Promo Code Deleted Successfully.',
                ] );
            }
        }
        return redirect()->back();

    }

    /**
     * Change Data the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function status( $id ) {
        $data = PromoCode::where( 'id', $id )->first();
        if ( $data->status == 1 ) {
            $data->status = '0';
            $data->save();
            return response()->json( [
                'success' => false,
                'message' => 'Unpublished Successfully.',
            ] );
        } else {
            $data->status = '1';
            $data->save();
            return response()->json( [
                'success' => true,
                'message' => 'Published Successfully.',
            ] );
        }
    }
}
