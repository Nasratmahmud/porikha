<?php

namespace App\Http\Controllers\Web\Backend;

use Exception;
use App\Models\User;
use App\Helper\Helper;
use App\Models\Company;
use App\Models\JobPost;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\JobPostFacilities;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobPostRejectReasonMail;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Validator;

class JobPostController extends Controller {
    /**
     * Get all data in table view For Admin
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index( Request $request ) {
        if ( $request->ajax() ) {
            $data = JobPost::with( 'user' )->latest()->with( 'facilities','company' );
            return DataTables::of( $data )
            ->addIndexColumn()
            ->addColumn( 'logo', function ( $data ) {
                $logo = url( $data->company->logo );
                return '<div class="avatar avatar-lg"><img style="border-radius: 10px;" src="' . $logo . '" alt="' . $data->book_name . '"></div>';
            } )
            ->addColumn( 'facilities', function ( $data ) {
                return "<a href='" . route( 'job.post.facitilies', ['id' => $data->id] ) . "' class='ms-1 btn btn-danger'>All (" . $data->facilities()->count() . ")</a>";
            } )
            ->addColumn( 'type', function ( $data ) {
                if ( $data->type == 1 ) {
                    return '<span class="badge bg-primary fs-6">Full-Time</span>';
                } elseif( $data->type == 2 ) {
                    return '<span class="badge bg-secondary fs-6">Part-time</span>';
                }elseif( $data->type == 3 ) {
                    return '<span class="badge bg-info fs-6">Contract</span>';
                }elseif($data->type == 4){
                    return '<span class="badge bg-success fs-6">Internships</span>';
                }elseif($data->type == 5){
                    return '<span class="badge bg-danger fs-6">Temporary</span>';
                }else{
                    return '<span class="badge bg-warning fs-6">Remote</span>';
                }
            } )
            ->addColumn( 'action', function ( $data ) {
                return "<a href='" . route( 'job.post.show', ['id' => $data->id] ) . "' class='ms-1 btn btn-danger'><i class='bi bi-eye-fill'></i></a>";
            } )
                ->addColumn( 'status', function ( $data ) {
                    $status = '<select class="form-select" aria-label="Default select example" onchange="showStatusChangeAlert(' . $data->id . ',this)">
                    <option value="1" ' . ( $data->status == 1 ? 'selected' : '' ) . '>Pending</option>
                    <option value="2" ' . ( $data->status == 2 ? 'selected' : '' ) . '>Approved</option>
                    <option value="3" ' . ( $data->status == 3 ? 'selected' : '' ) . '>Rejected</option>
                  </select>';

                    return $status;
                } )
                ->rawColumns( ['logo', 'status', 'action','type'] )
                ->make( true );
        }
        return view( 'backend.layout.job_post.index' );
    }
    /**
     * Get all data in table view For User
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function userindex( Request $request ) {
        if ( $request->ajax() ) {
            $data = JobPost::with( 'user','applyed' )->latest()->where( 'user_id', auth()->user()->id )->with( 'facilities','company' );
            return DataTables::of( $data )
                ->addIndexColumn()
                ->addColumn( 'logo', function ( $data ) {
                    $logo = url( $data->company->logo );
                    return '<div class="avatar avatar-lg"><img style="border-radius: 10px;" src="' . $logo . '" alt="' . $data->book_name . '"></div>';
                } )
                ->addColumn( 'facilities', function ( $data ) {
                    return "<a href='" . route( 'job.post.facitilies', ['id' => $data->id] ) . "' class='ms-1 btn btn-danger'>All (" . $data->facilities()->count() . ")</a>";
                } )
                ->addColumn( 'type', function ( $data ) {
                    // 1=Full-Time,2=Part-time, 3=Contract, 4=Internships, 5=Temporary,Remote

                    if ( $data->type == 1 ) {
                        return '<span class="badge bg-primary fs-6">Full-Time</span>';
                    } elseif( $data->type == 2 ) {
                        return '<span class="badge bg-secondary fs-6">Part-time</span>';
                    }elseif( $data->type == 3 ) {
                        return '<span class="badge bg-info fs-6">Contract</span>';
                    }elseif($data->type == 4){
                        return '<span class="badge bg-success fs-6">Internships</span>';
                    }elseif($data->type == 5){
                        return '<span class="badge bg-danger fs-6">Temporary</span>';
                    }else{
                        return '<span class="badge bg-warning fs-6">Remote</span>';
                    }
                } )
                ->addColumn( 'applications', function ( $data ) {
                    return "<a href='". route('job.applications',['id' => $data->id]) ."' class='btn btn-success px-4'>Applications(".$data->applyed->count().")</a>";
                } )
                ->addColumn( 'status', function ( $data ) {
                    if ( $data->status == 1 ) {
                        return '<span class="badge bg-warning fs-6">Pending</span>';
                    } elseif ( $data->status == 2 ) {
                        return '<span class="badge bg-success fs-6">Approved</span>';
                    } elseif ( $data->status == 3 ) {
                        return '<span class="badge bg-danger fs-6">Rejected</span>';
                    }
                } )
                ->addColumn( 'action', function ( $data ) {
                    $user = User::find( auth()->user()->id );
                    $html = '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">';
                    if ( $user->hasPermissionTo( 'edit jobpost' ) ) {
                        $html .= '<a href="' . route( 'job.post.edit', $data->id ) . '" class="btn btn-sm btn-success"><i class="bx bxs-edit"></i></a>';
                    }
                    if ( $user->hasPermissionTo( 'delete jobpost' ) ) {
                        $html .= '<a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button"
                        class="btn btn-danger btn-sm text-white" title="Delete" readonly>
                        <i class="bx bxs-trash"></i>
                    </a>';
                    }
                    $html .= '</div>';

                    return $html;
                } )
                ->rawColumns( ['logo', 'type', 'facilities', 'action','applications', 'status'] )
                ->make( true );
        }
        return view( 'backend.layout.job_post.index_user' );
    }

    /**
     * Change Data the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function status( Request $request, $id ) {
        $data = JobPost::findOrFail( $id );
        if ( $data ) {
            $data->status = $request->status;
            $data->save();
            return response()->json( [
                'success' => true,
                'data'    => $data,
                'message' => 'Status Change Successfully.',
            ] );
        } else {
            return response()->json( [
                'success' => false,
                'message' => 'Data Not Found.',
            ] );
        }
    }

    /**
     * Change Data the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function rejectReson( Request $request ) {
        $validate = Validator::make( $request->all(), [
            'user_id' => 'required|exists:users,id',
            'job_id'  => 'required|exists:job_posts,id',
            'reson'   => 'required|string',
        ] );
        if ( $validate->fails() ) {
            return response()->json( [
                'success' => false,
                'message' => 'Title is required',
                'data'    => $validate->errors(),
            ] );
        }
        try {
            $user = User::find( $request->user_id );
            $job = JobPost::find( $request->job_id );
            Mail::to( $user->email )->send( new JobPostRejectReasonMail( $request->reson, $user, $job->title ) );
            return redirect( route( 'job.post' ) )->with( 't-success', 'Reason Send to User Successfully.' );
        } catch ( Exception $e ) {
            return redirect( route( 'job.post' ) )->with( 't-error', $e->getMessage() );
        }

    }

    // Create Job Post As User
    public function create() {
        return view( 'backend.layout.job_post.create' );
    }

    // Store Job Post As User
    public function store( Request $request ) {
        // return $request;
        $request->validate( [
            'title'           => 'required|string',
            'description'     => 'required|string',
            'short_description'     => 'required|string',
            'deadline'        => 'required|date',
            'vacancy'         => 'required|numeric',
            'type'            => 'required|numeric|max:6',
            'selary_range'    => 'required|string',
            'position'        => 'required|string',
            
            // Company
            'institute_name'  => 'required|string',
            'address'         => 'required|string',
            'website'         => 'required|url',
            'about'     => 'required|string',
            'logo' => 'required|file|mimes:jpeg,png,gif|max:5120',

            'facilities.*'    => 'required|string',
        ] );

        DB::beginTransaction();
        try {
            $slug = Helper::MakeSlug( $request->title, JobPost::class );

            // File Upload
            $randomString = Str::random( 30 );
            $url = Helper::fileUpload( $request->logo, 'company_logo', $randomString );

            $data = new JobPost();
            $data->title = $request->title;
            $data->short_description = $request->short_description;
            $data->description = $request->description;
            $data->deadline = $request->deadline;
            $data->vacancy = $request->vacancy;
            $data->type = $request->type;
            $data->selary_range = $request->selary_range;
            $data->position = $request->position;
            $data->slug = $slug;
            $data->user_id = auth()->user()->id;
            $data->save();
            
            
            // Company
            $company = new Company();
            $company->name = $request->institute_name;
            $company->about = $request->about;
            $company->website = $request->website;
            $company->logo = $url;
            $company->address = $request->address;
            $company->job_post_id = $data->id;
            $company->save();


            // Facilities Post
            foreach ( $request->facilities as $facility ) {
                $fac = new JobPostFacilities();
                $fac->job_post_id = $data->id;
                $fac->facility = $facility;
                $fac->save();
            }

            DB::commit();
            return redirect( route( 'job.post.user' ) )->with( 't-success', 'Job Post Create Successfully.' );

        } catch ( Exception $e ) {
            DB::rollBack();
            return redirect( route( 'job.post.user' ) )->with( 't-error', $e->getMessage() );
        }
    }

    /**
     *
     * Edit Journal Page
     */
    public function edit( $id ) {
        $jobpost = JobPost::where('id', $id )->with('company')->first();
        return view( 'backend.layout.job_post.update', compact( 'jobpost' ) );
    }

    /**
     *
     * View Journal Page
     */
    public function show( $id ) {
        $jobpost = JobPost::where('id', $id )->with('company')->first();
        return view( 'backend.layout.job_post.view', compact( 'jobpost' ) );
    }

    /**
     *
     * Store The Resource
     */
    public function update( Request $request ) {
        $request->validate( [
            'title'           => 'required|string',
            'description'     => 'required|string',
            'short_description'     => 'required|string',
            'deadline'        => 'required|date',
            'vacancy'         => 'required|numeric',
            'type'            => 'required|numeric|max:6',
            'selary_range'    => 'required|string',
            'position'        => 'required|string',
            
            // Company
            'institute_name'  => 'required|string',
            'address'         => 'required|string',
            'website'         => 'required|url',
            'about'           => 'required|string',
            'logo'            => 'nullable|file|mimes:jpeg,png,gif|max:5120',

            'facilities.*'    => 'required|string',

            'id'              => 'required|exists:job_posts,id',
        ] );

        DB::beginTransaction();
        try {
            $slug = Helper::MakeSlug( $request->title, JobPost::class );
            $data = JobPost::where('id', $request->id )->first();
            $data->title = $request->title;
            $data->short_description = $request->short_description;
            $data->description = $request->description;
            $data->deadline = $request->deadline;
            $data->vacancy = $request->vacancy;
            $data->type = $request->type;
            $data->selary_range = $request->selary_range;
            $data->position = $request->position;
            $data->slug = $slug;
            $data->user_id = auth()->user()->id;
            $data->save();

            
            
            // Company
            $company = Company::where('job_post_id', $data->id )->first();
            $company->name = $request->institute_name;
            $company->about = $request->about;
            $company->website = $request->website;
            if( $request->hasFile( 'logo' ) ){

                if ( File::exists( $company->logo ) ) {
                    File::delete( $company->logo );
                }
                // File Upload
                $randomString = Str::random( 30 );
                $url = Helper::fileUpload( $request->logo, 'company_logo', $randomString );
                $company->logo = $url;
            }
            $company->address = $request->address;
            $company->job_post_id = $data->id;
            $company->save();

            DB::commit();
            return redirect( route( 'job.post.user' ) )->with( 't-success', 'Job Post Updated Successfully.' );
        } catch ( Exception $e ) {
            DB::rollBack();
            return redirect( route( 'job.post.user' ) )->with( 't-error', $e->getMessage() );
        }
    }

    /**
     *
     * Delete Specific record
     *
     */
    public function destroy( Request $request, $id ) {
        if ( $request->ajax() ) {
            DB::beginTransaction();
            try {
                $jobPost = JobPost::where('id', $id)->with('company', 'facilities')->first();

                if (!$jobPost) {
                    // Handle case where job post with given ID doesn't exist
                    return response()->json(['error' => 'Job Post not found.'], 404);
                }

                // Delete related records
                if ($jobPost->company) {
                    // Delete Imagae
                    if ( $jobPost->company->logo) {
                        File::delete($jobPost->company->logo);
                    }

                    // Delete company record
                    $jobPost->company->delete();
                    
                }

                // Delete facilities records
                if ($jobPost->facilities) {
                    // Assuming facilities is a relationship that returns a collection
                    $jobPost->facilities->each(function ($facility) {
                        $facility->delete();
                    });
                }

                // Finally, delete the main JobPost record
                $jobPost->delete();

                DB::commit();

                return response()->json(['message' => 'Job Post and related records deleted successfully.']);
            } catch (Exception $e) {
                DB::rollBack();
                // Handle the exception as needed
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }





    /**
     * Application List
     */
    public function Applications( Request $request, $id ) {
        if ( $request->ajax() ) {
            $data = JobApplication::with( 'user','job' )->latest()->where( 'job_post_id', $id )->latest();
            return DataTables::of( $data )
                ->addIndexColumn()
                ->addColumn( 'resume', function ( $data ) {
                    return "<a href='" . asset($data->resume) . "' target='_blank' class='ms-1 btn btn-success'>Resume <i class='bi bi-eye-fill'></i></a>";
                } )
                ->addColumn( 'action', function ( $data ) {
                    return "<a href='' class='ms-1 btn btn-danger'> <i class='bi bi-eye-fill'></i></a>";
                } )
                ->rawColumns( ['resume','action'] )
                ->make( true );
        }
        return view( 'backend.layout.job_post.application',compact('id') );
    }
}
