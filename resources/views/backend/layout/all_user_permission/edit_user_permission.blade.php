@extends('backend.app')

<!-- Start:Title -->
@section('title', 'Edit User Permission')
<!-- End:Title -->

<!-- Start:Content -->
@section('content')
    <div class="app-content-area">
        <div class="container-fluid">
            <!-- row -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="text-end d-flex px-3 justify-content-between align-items-center mb-4">
                        <h3 class="text-primary">Edit User Permission</h3>
                        <a href="{{ route('user.permission.index') }}" class="btn btn-primary mb-3">View All</a>
                    </div>
                    <!-- card -->
                    <div class="card mb-4">
                        <!-- card body -->
                        <div class="card-body">
                            <form action="{{ route('user.permission.update', $user->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <!-- Input Item -->
                                    <div class="col-12 mb-3">
                                        <label class="form-label">User Name</label>
                                        <input class="form-control" type="text" value="{{ $user->name }}" disabled>
                                    </div>
                                    <hr>
                                    <div class="col-12 mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="checkAllButton">
                                            <label class="form-check-label" for="checkAllButton">
                                                Permission All
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    @foreach ($permissionGroup as $group)
                                        <div class="row">
                                            @if ($group->group_name != 'admin' && $group->group_name != 'permission')
                                                <div class="col-12 mb-3">
                                                    @php
                                                        $permissions = App\Models\User::getPermissionByGroupName($group->group_name);
                                                    @endphp
                                                    <h4 class="text-capitalize">{{ $group->group_name }}</h4>
                                                    @foreach ($permissions as $permission)
                                                        <div class="form-check">
                                                            <input class="form-check-input permission-checkbox"
                                                                name="permission[]" type="checkbox"
                                                                value="{{ $permission->id }}" id="per_{{ $permission->id }}"
                                                                {{ in_array($permission->id, $existsPermissionsId) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="per_{{ $permission->id }}">
                                                                {{ $permission->name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach

                                    <div class="col-12">
                                        <a href="{{ route('user.permission.index') }}"
                                            class="btn btn-danger text-white w-auto">Cancel</a>
                                        <button type="submit" class="btn btn-primary text-white w-auto">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
<!-- Start:Script -->
@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var checkAllButton = document.getElementById('checkAllButton');
            var permissionCheckboxes = document.querySelectorAll('.permission-checkbox');

            if (document.querySelectorAll('.permission-checkbox').length == document.querySelectorAll(
                    '.permission-checkbox:checked').length) {
                checkAllButton.checked = true;
            }

            checkAllButton.addEventListener('change', function() {
                permissionCheckboxes.forEach(function(checkbox) {
                    checkbox.checked = checkAllButton.checked;
                });
            });
        });
    </script>
@endpush
