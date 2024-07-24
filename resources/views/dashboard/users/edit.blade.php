@extends('layout.dashboard')

@section('title', 'Users')

@section('subTitle', 'Update')

@section('contents')
    <!-- Form Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Update User information</h6>
                    <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
                        @csrf
                        @method("PUT")

                        <div class="mb-3">
                            <label for="inputFullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="inputFullName" name="fullName" value="{{ $user->name }}" aria-describedby="fullnameHelp">
                            <div id="fullnameHelp" class="form-text">The name that will be displayed.</div>
                        </div>
                        <div class="mb-3">
                            <label for="inputUsername" class="form-label">User Name</label>
                            <input type="text" class="form-control" id="inputUsername" name="username" value="{{ $user->username }}" aria-describedby="usernameHelp">
                            <div id="usernameHelp" class="form-text">The name that you use for signing in.</div>
                        </div>
                        <div class="mb-3">
                            <label for="inputEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="inputEmail" name="email" value="{{ $user->email }}" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="inputPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="inputPassword" name="password">
                        </div>

                        <div class="mb-3">
                            <label for="inputRole" class="form-label">Role</label>
                            <select id="inputRole" name="role" class="form-select mb-3" aria-label="Default select example">
                                <option>Select Role</option>
                                <option value="1" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                <option value="2" {{ $user->role == 'editor' ? 'selected' : '' }}>Editor</option>
                                <option value="3" {{ $user->role == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                                <option value="4" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Form End -->
@endsection
