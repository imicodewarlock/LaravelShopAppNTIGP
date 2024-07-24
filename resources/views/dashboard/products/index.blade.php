@extends('layout.dashboard')

@section('contents')
<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            @if(session()->has('user') && session('user.role') == 'editor')
                <a href="{{ route('products.create') }}" class="btn btn-primary mb-4"><i class="fa fa-plus me-2"></i>Add new product</a>
            @endif
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover">
                <thead>
                    <tr class="text-dark">
                        {{-- <th scope="col"><input class="form-check-input" type="checkbox"></th> --}}
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            {{-- <td><input class="form-check-input" type="checkbox"></td> --}}
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                                @if(session()->has('user') && session('user.role') == 'editor')
                                    <a class="btn btn-sm btn-info" href="{{ route('products.show', ['product' => $product->id]) }}">Show</a>
                                @endif
                                @if(session()->has('user') && session('user.role') == 'editor')
                                    <a class="btn btn-sm btn-primary" href="{{ route('products.edit', ['product' => $product->id]) }}">Edit</a>
                                @endif
                                @if(session()->has('user') && session('user.role') == 'editor')
                                    <form class="d-inline" action="{{ route('products.destroy', ['product' => $product->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                @endif
                                @if(session()->has('user') && session('user.role') == 'editor')
                                    <form class="d-inline" action="{{ route('products.activate', ['product' => $product->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-secondary">{{ $product->is_active ? 'Deactivate' : 'Activate'}}</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        {{ $products->onEachSide(5)->links() }}
    </div>
</div>
<!-- Recent Sales End -->
@endsection
