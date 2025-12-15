@extends('backend.layout.main')
@section('title', 'Product')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create New Product</h1>
        <a href="{{ route('product.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fa fa-list-ol" aria-hidden="true"></i>
            View List</a>
    </div>
    <div class="row">
        <!-- Profile Edit (SB Admin 2 / Bootstrap 4) -->
        @if (isset($data))
            <form class="container-fluid px-0" method="POST" action="{{ route('product.update', $data->id) }}"
                enctype="multipart/form-data" novalidate>
                @method('PUT')
            @else
                <form class="container-fluid px-0" method="POST" action="{{ route('product.store') }}"
                    enctype="multipart/form-data" novalidate>
        @endif

        @csrf

        <div class="row">
            <!-- Left: Profile Picture -->
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="mb-3 font-weight-bold text-gray-800">Product Picture</h6>

                        <div class="mb-3 align-items-center justify-content-center d-flex flex-column">
                            @if (isset($data))
                                <img id="avatarPreview" src="{{ asset('storage/' . $data->media) }}"
                                    class="rounded img-fluid" style="width:160px;height:160px;object-fit:cover"
                                    alt="Preview">
                            @else
                                {{-- Default (create mode) --}}
                                <img id="avatarPreview" src="{{ asset('backend/img/avatar.png') }}"
                                    class="rounded img-fluid" style="width:160px;height:160px;object-fit:cover"
                                    alt="Preview">
                            @endif

                        </div>

                        <p class="text-muted small mb-3">JPG or PNG or MP4 no larger than 5 MB</p>
                        @error('media')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="custom-file text-left">
                            <input type="file" class="custom-file-input @error('media') is-invalid @enderror"
                                id="media" name="media" accept="image/*">
                            <label class="custom-file-label" for="media">Upload</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Account Details -->
            <div class="col-lg-8 mb-4">

                <div class="card shadow-sm">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Categories List</h6>
                    </div>
                    <div class="card-body">
                        @foreach ($categories as $key => $category)
                            <div class="form-check form-check-inline">
                                 <input class="form-check-input position-static" type="checkbox" id="blankCheckbox{{ $key }}" value="
                                 {{ $category->id }}" name="category_id" aria-label="..."  {{ isset($data) && $category->id == $data->category_id ? 'checked' : '' }}>
                                <label class="form-check-label" for="blankCheckbox{{ $key }}">
                                    {{ $category->name }}
                                </label>
                            </div>
                        @endforeach
                        <br>
                        @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="card shadow-sm">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Slider Details</h6>
                    </div>
                    <div class="card-body">
                        <!-- Username -->


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Product Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Prawn Cracker"
                                    value="{{ isset($data) ? $data->name : old('name') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="price">Price</label>
                                <input type="text" class="form-control @error('price') is-invalid @enderror"
                                    id="price" name="price" placeholder="Rs. 250.00"
                                    value="{{ isset($data) ? $data->price : old('price') }}">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="price">Gram</label>
                                <input type="text" class="form-control @error('gram') is-invalid @enderror"
                                    id="gram" name="gram" placeholder="GM 250"
                                    value="{{ isset($data) ? $data->gram : old('gram') }}">
                                @error('gram')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group">
                            <label for="editor">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="editor"
                                cols="30" rows="10">{{ isset($data) ? $data->description : old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @if (isset($data))
                            <button type="submit" class="btn btn-primary">Update changes</button>
                        @else
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        </form>
        <script>
            (function() {
                var input = document.getElementById('media');
                var label = document.querySelector('label[for="media"].custom-file-label');
                var preview = document.getElementById('avatarPreview');

                if (input) {
                    input.addEventListener('change', function(e) {
                        var file = input.files && input.files[0];
                        if (!file) return;

                        // update label text
                        if (label) label.textContent = file.name;

                        // preview image
                        var reader = new FileReader();
                        reader.onload = function(ev) {
                            preview.src = ev.target.result;
                        };
                        reader.readAsDataURL(file);
                    });
                }
            })();
        </script>


    </div>
@endsection
