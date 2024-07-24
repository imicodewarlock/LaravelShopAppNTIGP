@extends('layout.dashboard')

@section('contents')
<style>
    .img-preview {
        width: 100%;
        height: auto;
        max-width: 200px; /* Adjust as needed */
        max-height: 200px; /* Adjust as needed */
    }
</style>

<!-- Form Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Create New product</h6>
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="inputProductName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="inputProductName" name="productName" aria-describedby="productNameHelp">
                        {{-- <div id="productNameHelp" class="form-text">The name that will be displayed.</div> --}}
                    </div>
                    <div class="mb-3">
                        <label for="inputProductDescription" class="form-label">Description</label>
                        <input type="text" class="form-control" id="inputProductDescription" name="productDesc" aria-describedby="productDescriptionHelp">
                        {{-- <div id="productDescriptionHelp" class="form-text">The name that you use for signing in.</div> --}}
                    </div>

                    <div class="mb-3">
                        <label for="inputProductPrice" class="form-label">Price</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="text" class="form-control" id="inputProductPrice" name="productPrice" aria-label="Amount (to the nearest dollar)">
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>
                    {{-- <div class="mb-3">
                        <label for="inputProductPrice" class="form-label">Price</label>
                        <input type="text" class="form-control" id="inputProductPrice" name="productPrice" aria-describedby="productPriceHelp">
                        <div id="productPriceHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div> --}}

                    <div class="mb-3">
                        <label for="inputProductCategory" class="form-label">Category</label>
                        <select id="inputProductCategory" name="productCategory" class="form-select mb-3" aria-label="Default select example">
                            <option selected>Select category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                            {{-- <option value="1">Editor</option>
                            <option value="2">Supervisor</option>
                            <option value="3">Admin</option> --}}
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="inputProductPhoto" class="form-label">Select product photo</label>
                        <input class="form-control" type="file" id="inputProductPhoto" accept="image/*" name="productPhoto">
                    </div>

                    <div class="mb-3">
                        <img id="inputProductPreview" class="img-preview" src="#" alt="Image Preview" style="display: none;">
                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Form End -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputProductPhoto = document.getElementById('inputProductPhoto');
        const inputProductPreview = document.getElementById('inputProductPreview');

        inputProductPhoto.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    inputProductPreview.src = event.target.result;
                    inputProductPreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    });
    // $(document).ready(function() {
    //     $('#inputProductPhoto').change(function() {
    //         const file = this.files[0];
    //         if (file) {
    //             const reader = new FileReader();
    //             reader.onload = function(event) {
    //                 $('#inputProductPreview').attr('src', event.target.result);
    //                 $('#inputProductPreview').css('display', 'block');
    //             }
    //             reader.readAsDataURL(file);
    //         }
    //     });
    // });
</script>
@endsection
