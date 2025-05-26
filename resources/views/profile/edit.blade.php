@extends('adminlte::page')

@section('title', 'Profile Edit')

@section('content_header')
    <h1>Edit Profile</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header ">
                    <h3 class="card-title">Profile Information</h3>
                </div>
                <div class="card-body">
                    <form id="profileUpdateForm" method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" 
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $user->name) }}" required autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" 
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', $user->email) }}" required>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" onclick="confirmProfileUpdate(event)">
                                Update Profile
                            </button>
                        </div>
                    </form>
                </div>
                
            </div>
            <div class="card mt-4">
                <div class="card-header bg-danger">
                    <h3 class="card-title text-white">Delete Account</h3>
                </div>
                <div class="card-body">
                    <p>Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                    
                    <form id="deleteAccountForm" method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('DELETE')
                        
                        <div class="form-group">
                            <label for="delete_password">Current Password</label>
                            <input type="password" id="delete_password" name="password" 
                                   class="form-control" required>
                        </div>
                        
                        <button type="submit" class="btn btn-danger" onclick="confirmAccountDeletion(event)">
                            Delete Account
                        </button>
                    </form>
                </div>
            </div>
        </div>
        

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Change Password</h3>
                </div>
                <div class="card-body">
                    <form id="passwordUpdateForm" method="POST" action="{{ route('profile.password') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" id="current_password" name="current_password" 
                                   class="form-control @error('current_password') is-invalid @enderror" required>

                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" id="password" name="password" 
                                   class="form-control @error('password') is-invalid @enderror" required>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" 
                                   class="form-control" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" onclick="confirmPasswordChange(event)">
                                Change Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Delete Account Section -->
            
        </div>
    </div>
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Profile Update Confirmation
        function confirmProfileUpdate(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Update Profile?',
                text: "Are you sure you want to update your profile information?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('profileUpdateForm').submit();
                }
            });
        }

        // Password Change Confirmation
        function confirmPasswordChange(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Change Password?',
                text: "Are you sure you want to change your password?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, change it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('passwordUpdateForm').submit();
                }
            });
        }

        // Account Deletion Confirmation
        function confirmAccountDeletion(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Delete Your Account?',
                text: "This action cannot be undone. All your data will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteAccountForm').submit();
                }
            });
        }

        // Show success messages if any
        @if(session('status'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('status') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        @endif

        @if($errors->any())
            Swal.fire({
                title: 'Error!',
                html: '<ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
@stop