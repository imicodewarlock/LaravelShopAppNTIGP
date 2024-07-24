@extends('layout.dashboard')

@section('contents')
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            @if (session()->has('user') && session('user.role') == 'admin')
                <a href="{{ route('product-categories.create') }}" class="btn btn-primary mb-4"><i class="fa fa-plus me-2"></i>Add new product category</a>
            @endif
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        {{-- <th scope="col"><input class="form-check-input" type="checkbox"></th> --}}
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            {{-- <td><input class="form-check-input" type="checkbox"></td> --}}
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                @if (session()->has('user') && session('user.role') == 'editor')
                                    <a class="btn btn-sm btn-info" href="{{ route('product-categories.show', ['product_category' => $category->id]) }}">Show</a>
                                @endif

                                @if (session()->has('user') && session('user.role') == 'admin')
                                    <a class="btn btn-sm btn-primary" href="{{ route('product-categories.edit', ['product_category' => $category->id]) }}">Edit</a>
                                @endif

                                @if (session()->has('user') && session('user.role') == 'admin')
                                    <form class="d-inline" action="{{ route('product-categories.destroy', ['product_category' => $category->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>

                                    </form>
                                @endif

                                @if (session()->has('user') && session('user.role') == 'admin')
                                    <form class="d-inline" action="{{ route('product-categories.activate', ['product_category' => $category->id]) }}" method="POST">
                                        @csrf

                                        <button type="submit" class="btn btn-sm btn-secondary">{{ $category->is_active ? 'Deactivate' : 'Activate'}}</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Recent Sales End -->

@endsection
