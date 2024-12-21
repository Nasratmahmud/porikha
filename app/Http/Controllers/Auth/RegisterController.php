<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Stripe\Charge;
use Stripe\Stripe;

class RegisterController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware( 'guest' );
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator( array $data ) {
        return Validator::make( $data, [
            'username'      => ['required', 'string', 'max:255'],
            'full_name'     => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number'  => ['required', 'string', 'max:255'],
            'password'      => ['required', 'string', 'min:8', 'confirmed'],
            'stripeToken'   => ['required'],
            'paying_amount' => ['required', 'numeric', 'min:0'],
        ] );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     */
    protected function create( array $data ) {
        $isPayment = null;
        if ( $data['paying_amount'] != 0 ) {
            // For Production
            Stripe::setApiKey( env( 'STRIPE_SECRET' ) );
            $isPayment = Charge::create( [
                "amount"      => $data['paying_amount'] * 100,
                "currency"    => "usd",
                "source"      => $data['stripeToken'],
                "description" => "Parchasing Mambership " . $data['name'],
            ] );
        }

        // Check The Payment Status
        if ( $isPayment !== null && $isPayment->status === "succeeded" ) {
            return User::create( [
                'username'     => $data['username'],
                'name'         => $data['full_name'],
                'email'        => $data['email'],
                'phone_number' => $data['phone_number'],
                'password'     => Hash::make( $data['password'] ),
            ] );
        } elseif ( $data['paying_amount'] == 0 ) {
            return User::create( [
                'username'     => $data['username'],
                'name'         => $data['full_name'],
                'email'        => $data['email'],
                'phone_number' => $data['phone_number'],
                'password'     => Hash::make( $data['password'] ),
            ] );
        } else {
            return redirect()->back()->with( 'error', 'Something wrong...' );
        }
    }
}
