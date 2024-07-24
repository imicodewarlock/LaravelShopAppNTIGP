@extends('layout.dashboard')

@section('title', 'Users')

@section('subTitle', 'Create')

@section('contents')
    <!-- Form Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Create New User</h6>
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="inputFullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="inputFullName" name="fullName" aria-describedby="fullnameHelp">
                            <div id="fullnameHelp" class="form-text">The name that will be displayed.</div>
                        </div>
                        <div class="mb-3">
                            <label for="inputUsername" class="form-label">User Name</label>
                            <input type="text" class="form-control" id="inputUsername" name="username" aria-describedby="usernameHelp">
                            <div id="usernameHelp" class="form-text">The name that you use for signing in.</div>
                        </div>
                        <div class="mb-3">
                            <label for="inputEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="inputEmail" name="email" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="inputPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="inputPassword" name="password">
                        </div>

                        <div class="mb-3">
                            <label for="inputRole" class="form-label">Role</label>
                            <select id="inputRole" name="role" class="form-select mb-3" aria-label="Default select example">
                                <option selected>Select Role</option>
                                <option value="1">User</option>
                                <option value="2">Editor</option>
                                <option value="3">Supervisor</option>
                                <option value="4">Admin</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Form End -->
@endsection
