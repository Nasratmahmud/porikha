<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionAssignController extends Controller {
    /**
     * Get all data in table view
     *
     * @param Request $request
     * @throws \Exception
     */
    public function index( Request $request ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'permission menu' ) ) {
            if ( $request->ajax() ) {
                $data = User::with( 'permissions' )->where( 'user_type', 1 )->whereDoesntHave( 'permissions', function ( $query ) {
                    $query->where( 'name', 'super admin' );
                } )->get();

                return DataTables::of( $data )
                    ->addIndexColumn()
                    ->addColumn( 'name', function ( $data ) {
                        return "<span class=' text-capitalize fw-bold'>{$data['name']}</span>";
                    } )
                    ->addColumn( 'permissions', function ( $data ) {
                        $permissions = '<div class="d-flex flex-wrap justify-content-center gap-1">';
                        if ( count( $data->permissions ) ) {
                            foreach ( $data->permissions as $permission ) {
                                $permissions .= "<span class='text-light bg-success p-1 rounded-3'>{$permission->name}</span>";
                            }
                        } else {
                            $permissions .= "<span class='text-light bg-danger py-1 px-2 rounded-3'>No Permission Assign</span>";
                        }

                        $permissions .= '</div>';
                        return $permissions;
                    } )
                    ->addColumn( 'action', function ( $data ) {
                        if ( User::find( auth()->user()->id )->hasPermissionTo( 'super admin' ) && auth()->user() ) {
                            return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                    <a  href="' . route( 'user.permission.edit', $data->id ) . '" class="btn btn-sm btn-info"><i class="bx bxs-edit"></i></a>
                                    <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button"
                                        class="btn btn-danger btn-sm text-white" title="Delete" readonly>
                                        <i class="bx bxs-trash"></i>
                                    </a>
                                </div>';
                        }
                    } )
                    ->rawColumns( ['name', 'permissions', 'action'] )
                    ->make( true );
            }
            return view( 'backend.layout.all_user_permission.index' );
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
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'permission menu' ) ) {
            $user = User::find( $id );
            $existsPermissionsId = $user->getAllPermissions()->pluck( 'id' )->toArray();
            $permissionGroup = User::getPermissionGroups();
            return view( 'backend.layout.all_user_permission.edit_user_permission', compact( 'user', 'existsPermissionsId', 'permissionGroup' ) );
        }
        return redirect()->back();

    }
    /**
     * Update selected item in database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update( Request $request, $id ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'permission menu' ) ) {
            try {
                $user = User::findOrFail( $id );
                $permissions = $request->input( 'permission' );

                if ( !empty( $permissions ) ) {
                    $syncedPermissions = [];
                    foreach ( $permissions as $permissionId ) {
                        $permission = Permission::find( $permissionId );
                        if ( $permission ) {
                            $syncedPermissions[] = $permission->name; // Assuming 'name' field holds the permission identifier
                        }
                    }
                    $user->syncPermissions( $syncedPermissions );
                } else {
                    // If there are no permissions sent, you might want to detach all existing permissions.
                    $user->syncPermissions( [] );
                }

                return redirect( route( 'user.permission.index' ) )->with( 't-success', 'User Permission Assigned Successful' );

            } catch ( Exception $e ) {
                return redirect()->back()->with( 't-error', 'Something Went Wrong' );
            }
        }
        return redirect()->back();

    }

    /**
     * Insert Or Update
     *
     * @param Request $request
     *
     */
    public function addUser( Request $request ) {
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'user permission' ) ) {
            if ( $request->ajax() ) {
                $validate = Validator::make( $request->all(), [
                    'name'     => ['required', 'string', 'max:255'],
                    'username' => ['required', 'string', 'max:255'],
                    'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:8'],
                ] );

                if ( $validate->fails() ) {
                    return response()->json( [
                        'success' => false,
                        'message' => 'Please Input a valid information',
                        'data'    => $validate->errors(),
                    ] );
                }
                try {
                    $user = new User();
                    $user->name = $request->name;
                    $user->username = $request->username;
                    $user->email = $request->email;
                    $user->password = Hash::make( $request->password );
                    $user->user_type = 1;
                    $user->save();
                    return response()->json( [
                        'success' => true,
                        'message' => 'User Added',
                    ] );
                } catch ( Exception $e ) {
                    return response()->json( [
                        'success' => false,
                        'message' => 'Something went wrong',
                    ] );
                }
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
        if ( User::find( auth()->user()->id )->hasPermissionTo( 'permission menu' ) ) {
            if ( $request->ajax() ) {
                $data = User::findOrFail( $id );
                if ( $data ) {
                    // Remove old image
                    if ( File::exists( $data->user_avatar ) ) {
                        File::delete( $data->user_avatar );
                    }
                    $data->delete();
                }
                return response()->json( [
                    'success' => true,
                    'message' => 'User Deleted Successfully.',
                ] );
            }
        }
        return redirect()->back();

    }
}