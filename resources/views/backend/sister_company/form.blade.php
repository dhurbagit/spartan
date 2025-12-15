@extends('backend.layout.main')
@section('title', 'Sister Company')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sister Company Detail</h1>
        <a href="{{ route('product.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fa fa-list-ol" aria-hidden="true"></i>
            View List</a>
    </div>
    <div class="row">
        <!-- Profile Edit (SB Admin 2 / Bootstrap 4) -->
        <form class="container-fluid px-0" method="POST" action="{{ route('sisterCompany.update') }}"
            enctype="multipart/form-data" novalidate>
            @method('PUT')
            @csrf

            <div class="row">
                <!-- Left: Profile Picture -->
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h6 class="mb-3 font-weight-bold text-gray-800">Cover Picture of company of 1</h6>
                            <div class="mb-3 align-items-center justify-content-center d-flex flex-column">
                                @php
                                    $cover_image_one = isset($data) ? $data->cover_image_one : null;
                                @endphp
                                @if ($cover_image_one)
                                    {{-- If image --}}
                                    <img id="cover_image_onePreview" src="{{ asset('storage/' . $cover_image_one) }}"
                                        class="rounded img-fluid" style="width:160px;height:160px;object-fit:cover"
                                        alt="Preview">
                                @else
                                    {{-- Default (create mode) --}}
                                    <img id="cover_image_onePreview" src="{{ asset('backend/img/avatar.png') }}"
                                        class="rounded img-fluid" style="width:160px;height:160px;object-fit:cover"
                                        alt="Preview">
                                @endif
                            </div>
                            <p class="text-muted small mb-3">JPG or PNG or MP4 no larger than 5 MB</p>
                            @error('cover_image_one')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="custom-file text-left">
                                <input type="file"
                                    class="custom-file-input @error('cover_image_one') is-invalid @enderror"
                                    id="cover_image_one" name="cover_image_one" accept="image/*">
                                <label class="custom-file-label" for="cover_image_one">Upload</label>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group row">
                                <label for="cover_title_one" class="col-sm-2 col-form-label">Company Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="cover_title_one" name="cover_title_one"
                                        placeholder="Company Name"
                                        value="{{ isset($data) ? $data->cover_title_one : old('cover_title_one') }}">
                                    @error('cover_title_one')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="link_one" class="col-sm-2 col-form-label">Website Link</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="link_one" name="link_one"
                                        placeholder="www.example.com"
                                        value="{{ isset($data) ? $data->link_one : old('link_one') }}">
                                    @error('link_one')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h6 class="mb-3 font-weight-bold text-gray-800">Cover Picture of company of 2</h6>
                            <div class="mb-3 align-items-center justify-content-center d-flex flex-column">
                                @php
                                    $cover_image_two = isset($data) ? $data->cover_image_two : null;
                                @endphp
                                @if ($cover_image_two)
                                    <img id="avatarPreview" src="{{ asset('storage/' . $cover_image_two) }}"
                                        class="rounded img-fluid" style="width:160px;height:160px;object-fit:cover"
                                        alt="Preview">
                                @else
                                    {{-- Default (create mode) --}}
                                    <img id="cover_image_twoPreview" src="{{ asset('backend/img/avatar.png') }}"
                                        class="rounded img-fluid" style="width:160px;height:160px;object-fit:cover"
                                        alt="Preview">
                                @endif
                            </div>
                            <p class="text-muted small mb-3">JPG or PNG or MP4 no larger than 5 MB</p>
                            @error('cover_image_two')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="custom-file text-left">
                                <input type="file"
                                    class="custom-file-input @error('cover_image_two') is-invalid @enderror"
                                    id="cover_image_two" name="cover_image_two" accept="image/*">
                                <label class="custom-file-label" for="cover_image_two">Upload</label>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group row">
                                <label for="cover_title_two" class="col-sm-2 col-form-label">Company Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="cover_title_two" name="cover_title_two"
                                        placeholder="Company Name"
                                        value="{{ isset($data) ? $data->cover_title_two : old('cover_title_two') }}">
                                         @error('cover_title_two')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="link_two" class="col-sm-2 col-form-label">Website Link</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="link_two" name="link_two"
                                        placeholder="www.example.com"
                                        value="{{ isset($data) ? $data->link_two : old('link_two') }}">
                                         @error('link_two')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Account Details -->
                <div class="col-lg-12 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Message Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="title">Main Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" placeholder="Our Sister Companies"
                                        value="{{ isset($data) ? $data->title : old('title') }}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="subtitle">Sub Title</label>
                                    <input type="text" class="form-control @error('subtitle') is-invalid @enderror"
                                        id="subtitle" name="subtitle"
                                        placeholder="Connected to establish business network."
                                        value="{{ isset($data) ? $data->subtitle : old('subtitle') }}">
                                    @error('subtitle')
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
                function setupImageUploader(inputId, labelFor, previewId, defaultImg) {
                    var input = document.getElementById(inputId);
                    var label = document.querySelector(`label[for="${labelFor}"].custom-file-label`);
                    var imgPrev = document.getElementById(previewId);

                    if (!input) return;

                    input.addEventListener('change', function() {
                        var file = input.files && input.files[0];
                        if (!file) return;

                        // Validate size (5 MB)
                        if (file.size > 5 * 1024 * 1024) {
                            alert("File is too large. Maximum allowed size is 5 MB.");
                            input.value = "";
                            if (label) label.textContent = "Choose file";
                            if (imgPrev) imgPrev.src = defaultImg;
                            return;
                        }

                        // Update label
                        if (label) label.textContent = file.name;

                        // Preview only if image
                        if (file.type.startsWith("image/")) {
                            var reader = new FileReader();
                            reader.onload = function(ev) {
                                imgPrev.src = ev.target.result;
                            };
                            reader.readAsDataURL(file);
                        } else {
                            alert("Invalid file type. Please upload an image only.");
                            input.value = "";
                        }
                    });
                }

                // Call for each input
                setupImageUploader("cover_image_one", "cover_image_one", "cover_image_onePreview",
                    "{{ asset('backend/img/avatar.png') }}");
                setupImageUploader("cover_image_two", "cover_image_two", "cover_image_twoPreview",
                    "{{ asset('backend/img/avatar.png') }}");
            })();
        </script>




    </div>
@endsection
