<?php

namespace App\Http\Middleware;

use App\Models\CoinBalance;
use App\Models\LoginAwardsCoinBonuse;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserPerDayAccessBonusMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle( $request, Closure $next, $guard = null ) {

        $data = LoginAwardsCoinBonuse::where( 'user_id', Auth::user()->id )->whereDate( 'date', Carbon::now()->toDateString() )->first();

        $userCurrentBalance = CoinBalance::where( 'user_id', Auth::user()->id )->latest( 'created_at' )->first( 'total' );

        if ( $data == null ) {

            DB::beginTransaction();
            try {

                LoginAwardsCoinBonuse::create( [
                    'user_id' => Auth::user()->id,
                    'date'    => Carbon::now(),
                    'amount'  => '0.5',
                ] );

                CoinBalance::create( [
                    'user_id'          => Auth::user()->id,
                    'amount'           => '0.5',
                    'transaction_type' => '1',
                    'total'            => $userCurrentBalance == null ? 0.5 : $userCurrentBalance->total + 0.5,
                ] );

                DB::commit();

                return $next( $request );

            } catch ( \Exception $e ) {
                DB::rollback();
                return response( 'Something went wrong...', 502 );
            }
        } else {
            return $next( $request );
        }
    }
}
