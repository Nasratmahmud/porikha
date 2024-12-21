<?php

namespace App\Http\Controllers\Web\FrontEnd;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\BookFavourite;
use App\Models\BundleFavourite;
use App\Models\CoursePurchase;
use App\Models\Journal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserProfileController extends Controller {

    /*

     * user profile View

     *

     */

    public function userProfilePage() {

        $type = request()->query( "type", 'profile' );

        $books = BookFavourite::with( 'book' )->where( 'user_id', auth()->user()->id )->latest()->paginate( 5 );
        $purchaseCourses = CoursePurchase::with( 'course.course_modules.course_contents' )->where( 'user_id', auth()->user()->id )->latest()->paginate( 6 );
        $favBundle = BundleFavourite::with( 'bundle' )->where( 'user_id', auth()->user()->id )->latest()->paginate( 10 );
        $myJournal = Journal::where( 'user_id', Auth::user()->id )->latest()->get();

        if ( $type == 'profile' ) {

            return view( 'frontend.layout.profile.profile', compact( 'books', 'purchaseCourses', 'favBundle', 'myJournal' ) );

        } else if ( $type == 'edit-profile' ) {

            return view( 'frontend.layout.profile.edit_profile_component' );

        } else if ( $type == 'change-pass' ) {

            return view( 'frontend.layout.profile.change_pass' );

        } else if ( $type == 'journal' ) {

            return view( 'frontend.layout.profile.journal_component' );

        } else if ( $type == 'course' ) {

            return view( 'frontend.layout.profile.course_component' );

        } else if ( $type == 'bundles' ) {

            return view( 'frontend.layout.profile.bundle_component', compact( 'favBundle' ) );

        } else if ( $type == 'books' ) {

            return view( 'frontend.layout.profile.book_component', compact( 'books' ) );

        }

    }

    //user profile info updated

    public function userInfoUpdate( Request $request ) {

        $request->validate( [

            'name'        => 'nullable|string',

            'user_avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',

        ] );

        $user = User::findOrFail( Auth::id() );

        $user->name = $request->name;

        // Upload User Avatar

        if ( $request->user_avatar != null ) {

            // Remove old image

            if ( File::exists( $user->user_avatar ) ) {

                File::delete( $user->user_avatar );

            }

            // random string generator

            $randomString = Str::random( 20 );

            // Image store in local

            $featuredImage = Helper::fileUpload( $request->file( 'user_avatar' ), 'user', $request->user_avatar . '_' . $randomString );

            $user->user_avatar = $featuredImage;

        }

        $user->save();

        return redirect()->back()->with( 't-success', 'Profile Update successfully.' );

    }

    /**

     * Update the specified resource in storage.

     *

     * @param Request $request

     * @return \Illuminate\Http\RedirectResponse

     */

    public function userPasswordUpdate( Request $request ) {
        $request->validate( [
            'old_password'     => 'required|string|min:6',
            'new_password'     => 'required|string|min:6',
            'confirm_password' => 'required|string|same:new_password|min:6',
        ] );

        if ( Hash::check( $request->old_password, Auth::user()->password ) ) {
            User::findOrFail( Auth::user()->id )->update( ['password' => Hash::make( $request->new_password )] );
            return redirect()->route( 'userProfile' )->with( 't-success', 'Password Update successfully.' );
        } else {
            return redirect()->back()->with( 't-error', 'Please Enter Your Right Current Password' );
        }

    }

    public function userCoverPictureUpdate( Request $request ) {

        $request->validate( [

            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',

        ] );

        $user = User::findOrFail( Auth::id() );

        $user->name = $request->name;

        // Upload User Avatar

        if ( !empty( $request['cover_image'] ) ) {

            if ( empty( $user->cover_image ) ) {

                // Upload New User Avatar

                $cover_image = Helper::fileUpload( $request->cover_image, 'user', $user->name . '_' . $user->id );

            } else {

                // Remove Old File

                @unlink( public_path( '/' ) . $user->cover_image );

                // Upload New User Avatar

                $cover_image = Helper::fileUpload( $request->cover_image, 'user', $user->name . '_' . $user->id );

            }

            $user->cover_image = $cover_image;

        }

        $user->save();

        return redirect()->route( 'userProfile', ['type' => 'profile'] )->with( 't-success', 'Cover Picture Update successfully.' );

    }

}
