<?php

namespace App\Http\Controllers\API;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Verse;
use App\Traits\apiresponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use apiresponse;

    // Update User Information
    /**
     * Update user primary info
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateUserInfo(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone_number'=>'nullable|string|max:15|regex:/^\+?[0-9]{10,15}$/'
        ]);

        if ($validation->fails()) {
            return $this->error([], $validation->errors(), 500);
        }

        try
        {
            $user = User::where('id', Auth::id())->first();
            $user->name = $request->name;
            $user->phone_number = $request->phone_number;
            if ($request->hasFile('avatar')) {
                $url = Helper::fileUpload($request->file('avatar'), 'users', $user->name . "-" . time());
                $user->user_avatar = $url;
            }

            $user->save();
            return $this->success([], "User updated successfully", 200);
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage(), 500);
        }
    }

    /**
     * Change Password
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'old_password' => 'required|string|max:255',
            'new_password' => 'required|string|max:255',
        ]);

        if ($validation->fails()) {
            return $this->error([], $validation->errors(), 500);
        }

        try
        {
            $user = User::where('id', Auth::id())->first();
            if (password_verify($request->old_password, $user->password)) {
                $user->password = Hash::make($request->new_password);
                $user->save();
                return $this->success([], "Password changed successfully", 200);
            } else {
                return $this->error([], "Old password is incorrect", 500);
            }
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage(), 500);
        }
    }

    /**
     * Change additional info
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function changeAdditionalInfo(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "phone" => "required|string|max:15",
            "address" => "required|string|max:255",
        ]);

        if ($validation->fails()) {
            return $this->error([], $validation->errors(), 500);
        }

        try {
            // Get the authenticated user
            $user = User::find(Auth::id());

            // Ensure that user det

            return $this->success([], "User updated successfully", 200);
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage(), 500);
        }
    }

    /**
     * Change Bio and current job additional info
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function changeBioCurrentJobInfo(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "bio" => "required|string",
            "current_company" => "required|string|max:255",
            "location" => "required|string|max:255",
            "current_designation" => "required|string|max:255",
            "industry" => "required|string|max:255",
        ]);

        if ($validation->fails()) {
            return $this->error([], $validation->errors(), 500);
        }

        try {
            // Get the authenticated user
            $user = User::find(Auth::id());

            // Ensure that user details exist, or create a new UserDetail instance
            $userDetail = $user->userDetail ?: new UserDetail();

            // Assign the updated data to the user detail model
            $userDetail->bio = $request->bio;
            $userDetail->current_company = $request->current_company;
            $userDetail->location = $request->location;
            $userDetail->current_designation = $request->current_designation;
            $userDetail->industry = $request->industry;

            // Associate the user detail with the user and save it
            $user->userDetail()->save($userDetail);

            return $this->success([], "User updated successfully", 200);
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage(), 500);
        }
    }

    /**
     * Change key skill info
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function changeKeySkillJobInfo(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "key_skills" => "required|string|max:255",
            "languages" => "required|string|max:255",
        ]);

        if ($validation->fails()) {
            return $this->error([], $validation->errors(), 500);
        }

        try {

            return $this->success([], "User updated successfully", 200);
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage(), 500);
        }
    }

    /**
     * Get My Notifications
     * @return \Illuminate\Http\Response
     */
    public function getMyNotifications()
    {
        $user = Auth::user();
        $notifications = $user->notifications()->latest()->get();
        return $this->success([
            'notifications' => $notifications,
        ], "Notifications fetched successfully", 200);
    }

    /**
     * Get All Verse
     * @return \Illuminate\Http\Response
     */
    public function getVerse()
    {

        $verse = Verse::where('status', 'active')->latest()->get();
        return $this->success([
            'verse' => $verse,
        ], "Verse fetched successfully", 200);
    }

    /**
     * Delete User
     * @return \Illuminate\Http\Response
     */
    public function deleteUser()
    {

        $user = User::where('id', Auth::id())->with('bookmarks', 'communities', 'duaBookmarks', 'haditBookmarks', 'journals', 'message', 'prayers', 'replies')->first();

        if ($user) {
            // Delete related data if the user exists
            $user->bookmarks()->delete();
            $user->communities()->delete();
            $user->duaBookmarks()->delete();
            $user->haditBookmarks()->delete();
            $user->journals()->delete();
            $user->message()->delete();
            $user->prayers()->delete();
            $user->replies()->delete();
            $user->delete();

            return $this->success([], "User deleted successfully", 200);
        } else {
            return $this->error("User not found", 404);
        }

    }

}
