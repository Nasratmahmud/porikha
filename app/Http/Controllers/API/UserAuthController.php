<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\apiresponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;

class UserAuthController extends Controller
{
    use apiresponse;

    /**
     * Register a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return $this->error([], $validator->errors()->first(), 422);
        }

        // Create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Create token for user
        $token = JWTAuth::fromUser($user);

        return $this->success(
            [
                'user' => $user,
                'token' => $token,
            ],
            'User successfully registered.',
            200,
        );
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Attempt to log the user in
        if (!($token = JWTAuth::attempt($credentials))) {
            return $this->error([], 'Invalid credentials', 401);
        }

        $user = $request->user(); ;
        // Extract only the required fields
         $userData = $user->only(['name', 'email', 'updated_at', 'created_at', 'id']);

        return $this->success(
            [
                'user' => $userData,
                'token' => $this->respondWithToken($token),
            ],
            'User logged in successfully.',
            200,
        );
    }

    /**
     * Google Login
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function googleLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'required|string',
        ]);
        if ($validator->fails()) {
            return $this->error([], $validator->errors()->first(), 422);
        }
        $credentials = $request->only('email');
        $user = User::where('email', $credentials['email'])->first();
        if (!$user) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }
        $token = JWTAuth::fromUser($user);
        return $this->success(
            [
                'token' => $this->respondWithToken($token),
            ],
            'User logged in successfully.',
            200,
        );
    }

    /**
     * Forget Password Controller
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return $this->error([], $validator->errors()->first(), 422);
        }
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return $this->error([], 'User not found', 404);
        }

        $otp = $user->PasswordResetNotification();
        //dd($otp);
        $user->update(['otp' => $otp, 'otp_created_at' => now()]);

        return $this->success([], 'Check Your Email for Password Reset Otp', 200);
    }

    /**
     * Reset Password Controller
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return $this->error([], $validator->errors()->first(), 422);
        }

        $user = User::where('otp', $request->otp)
            ->where('email', $request->email)
            ->first();
        if (!$user) {
            return $this->error([], 'Invalid OTP. Please try again.', 422);
        }

        $user->update([
            'password' => Hash::make($request->password),
            'otp' => null,
            'otp_created_at' => null,
        ]);
        return $this->success([], 'Password Reset Successfully', 200);
    }

    // Resend Otp
    public function resendOtp(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return $this->error([], 'User not found', 404);
        }
        $otp = $user->PasswordResetNotification();
        $user->update(['otp' => $otp, 'otp_created_at' => now()]);
        return $this->success([], 'OTP sent successfully', 200);
    }

    /**
     * Varify User Otp
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function varifyOtpWithOutAuth(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'otp' => 'required',
            'email' => 'required|email',
        ]);

        if ($validation->fails()) {
            return $this->error([], $validation->errors()->first(), 422);
        }

        $user = User::where('otp', $request->otp)
            ->where('email', $request->email)
            ->first();

        if (!$user) {
            return $this->error([], 'Invalid OTP. Please try again.', 422);
        }
        $otpExpirationTime = now()->subMinutes(10); // Example: OTP is valid for 10 minutes

        // Check if the OTP has expired
        if ($user->otp_created_at < $otpExpirationTime) {
            return $this->error([], 'OTP has expired.', 400);
        }

        // Check if the provided OTP matches the stored OTP
        if ($request->otp == $user->otp) {
            // Mark the email as verified
            $user->email_verified_at = now();
            $user->otp_created_at = null; // Clear the OTP creation timestamp
            $user->save();
            return $this->success([], 'OTP successfully verified', 200);
        }

        // If the OTP is invalid
        return $this->error([], 'Invalid OTP. Please try again.', 400);
    }

    /**
     * Log out the user (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function logout()
    {
        try {
            // Use the 'api' guard to work with JWT (ensure this is the correct guard)
            $token = auth('api')->getToken();
            auth('api')->invalidate($token); // Invalidate the JWT token

            return response()->json(['message' => 'Successfully logged out']);
        } catch (\Exception $e) {
            \Log::error('Logout failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to logout, please try again'], 500);
        }
    }

    /**
     * Get the authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {

        $user = Auth::user()->only(['id', 'name', 'email','phone_number','user_avatar']);
        return $this->success(
            [
                'user' => $user,
            ],
            'User retrieved successfully',
            200,
        );
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        try {
            // Refresh the token
            $newToken = JWTAuth::refresh(JWTAuth::getToken());

            return $this->success(
                [
                    'access_token' => $newToken,
                    'token_type' => 'bearer',
                    'expires_in' => auth('api')->factory()->getTTL() * 60,
                ],
                'Token refreshed successfully',
                200,
            );
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage(), 400);
        }
    }

    /**
     * Get Token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ]);
    }
}
