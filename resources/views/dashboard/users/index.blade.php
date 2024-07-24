@extends('layout.dashboard')

@section('title', 'Users')

@section('subTitle', 'Home')

@section('contents')
<!-- Table Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12">
            <div class="bg-light rounded h-100 p-4">
                @if(session()->has('user') && session('user.role') == 'admin')
                    <a href="{{ route('users.create') }}" class="btn btn-primary mb-4"><i class="fa fa-plus me-2"></i>Add new user</a>
                @endif
                <table class="table table-bordered mb-4">
                    <thead>
                        <tr>
                            {{-- <th scope="col"><input class="form-check-input" type="checkbox"></th> --}}
                            {{-- <th scope="col">#</th> --}}
                            <th scope="col">User Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                {{-- <td><input class="form-check-input" type="checkbox"></td> --}}

                                {{-- <th scope="row">{{ ++$idx }}</th> --}}
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if(session()->has('user') && session('user.role') == 'admin')
                                        <a class="btn btn-sm btn-info" href="{{ route('users.show', ['user' => $user->id]) }}">Show</a>
                                    @endif
                                    @if(session()->has('user') && session('user.role') == 'admin')
                                        <a class="btn btn-sm btn-primary" href="{{ route('users.edit', ['user' => $user->id]) }}">Edit</a>
                                    @endif
                                    @if(session()->has('user') && session('user.role') == 'admin')
                                        <form class="d-inline" action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    @endif
                                    @if(session()->has('user') && session('user.role') == 'admin')
                                        <form class="d-inline" action="{{ route('users.activate', ['user' => $user->id]) }}" method="POST">
                                            @csrf

                                            <button type="submit" class="btn btn-sm btn-secondary">{{ $user->is_active ? 'Deactivate' : 'Activate'}}</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                {{ $users->onEachSide(5)->links() }}
            </div>
        </div>
    </div>
</div>
<!-- Table End -->

@endsection
