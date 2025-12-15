@extends('backend.layout.main')
@section('title', 'Welcome Message')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create New Welcome Message</h1>
        <a href="{{ route('product.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fa fa-list-ol" aria-hidden="true"></i>
            View List</a>
    </div>
    <div class="row">
        <!-- Profile Edit (SB Admin 2 / Bootstrap 4) -->
        <form class="container-fluid px-0" method="POST" action="{{ route('welcome-message.update') }}"
            enctype="multipart/form-data" novalidate>
            @method('PUT')
            @csrf

            <div class="row">
                <!-- Left: Profile Picture -->
                <div class="col-lg-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h6 class="mb-3 font-weight-bold text-gray-800">Welcome Picture/video</h6>
                            <div class="mb-3 align-items-center justify-content-center d-flex flex-column">
                                @php
                                    $media = isset($data) ? $data->media : null;
                                    $ext = $media ? strtolower(pathinfo($media, PATHINFO_EXTENSION)) : null;
                                @endphp
                                @if ($media)
                                    {{-- If image --}}
                                    @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                        <img id="avatarPreview" src="{{ asset('storage/' . $media) }}"
                                            class="rounded img-fluid" style="width:160px;height:160px;object-fit:cover"
                                            alt="Preview">
                                        <video id="videoPreview" width="320" height="180" controls
                                            style="display:none; margin-top:10px;">
                                            <source src="" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    @endif

                                    {{-- If video --}}
                                    @if ($ext === 'mp4')
                                        <img id="avatarPreview" src="{{ asset('backend/img/avatar.png') }}"
                                            class="rounded img-fluid" style="width:160px;height:160px;object-fit:cover;display:none;"
                                            alt="Preview">
                                        <video id="videoPreview" width="320" height="180" controls
                                            style="margin-top:10px;">
                                            <source src="{{ asset('storage/' . $media) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    @endif
                                @else
                                    {{-- Default (create mode) --}}
                                    <img id="avatarPreview" src="{{ asset('backend/img/avatar.png') }}"
                                        class="rounded img-fluid" style="width:160px;height:160px;object-fit:cover"
                                        alt="Preview">

                                    <video id="videoPreview" width="320" height="180" controls
                                        style="display:none; margin-top:10px;">
                                        <source src="" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @endif
                            </div>
                            <p class="text-muted small mb-3">JPG or PNG or MP4 no larger than 5 MB</p>
                            @error('media')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="custom-file text-left">
                                <input type="file" class="custom-file-input @error('media') is-invalid @enderror"
                                    id="media" name="media" accept="image/*,video/*">
                                <label class="custom-file-label" for="media">Upload</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Account Details -->
                <div class="col-lg-8 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Welcome Message Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Main Title</label>
                                    <input type="text" class="form-control @error('main_title') is-invalid @enderror"
                                        id="main_title" name="main_title" placeholder="WELCOME TO SPARTAN"
                                        value="{{ isset($data) ? $data->main_title : old('main_title') }}">
                                    @error('main_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="price">Sub Title</label>
                                    <input type="text" class="form-control @error('sub_title') is-invalid @enderror"
                                        id="sub_title" name="sub_title" placeholder="About Company"
                                        value="{{ isset($data) ? $data->sub_title : old('sub_title') }}">
                                    @error('sub_title')
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
                var imgPrev = document.getElementById('avatarPreview');
                var vidPrev = document.getElementById('videoPreview');
                var vidSrc = vidPrev.querySelector('source');

                if (input) {
                    input.addEventListener('change', function() {
                        var file = input.files && input.files[0];
                        if (!file) return;

                        // --- Validate file size (5 MB max) ---
                        if (file.size > 5 * 1024 * 1024) {
                            alert("File is too large. Maximum allowed size is 5 MB.");
                            input.value = "";
                            if (label) label.textContent = "Choose file";
                            imgPrev.src = "{{ asset('backend/img/avatar.png') }}";
                            imgPrev.style.display = "block";
                            vidPrev.style.display = "none";
                            return;
                        }

                        // Update label text
                        if (label) label.textContent = file.name;

                        // --- Image preview ---
                        if (file.type.startsWith("image/")) {
                            var reader = new FileReader();
                            reader.onload = function(ev) {
                                imgPrev.src = ev.target.result;
                            };
                            reader.readAsDataURL(file);

                            imgPrev.style.display = "block";
                            vidPrev.style.display = "none";

                            // --- Video preview (mp4) ---
                        } else if (file.type === "video/mp4") {
                            var videoURL = URL.createObjectURL(file);
                            vidSrc.src = videoURL;
                            vidPrev.load();

                            vidPrev.style.display = "block";
                            imgPrev.style.display = "none";
                        } else {
                            alert("Invalid file type. Please upload an image or mp4 video.");
                            input.value = "";
                        }
                    });
                }
            })();
        </script>



    </div>
@endsection
