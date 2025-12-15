@extends('backend.layout.main')
@section('title', 'Story')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create New Story</h1>
    </div>
    <div class="row">
        <!-- Profile Edit (SB Admin 2 / Bootstrap 4) -->
        <form class="container-fluid px-0" method="POST" action="{{ route('story.update') }}" enctype="multipart/form-data"
            novalidate>
            @method('PUT')
            @csrf

            <div class="row">
                <!-- Left: Profile Picture -->
                <div class="col-lg-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h6 class="mb-3 font-weight-bold text-gray-800">Welcome Picture</h6>
                            <div class="mb-3 align-items-center justify-content-center d-flex flex-column">
                                @php
                                    $media = isset($data) ? $data->media : null;
                                @endphp
                                @if ($media)
                                    <img id="avatarPreview" src="{{ asset('storage/' . $media) }}" class="rounded img-fluid"
                                        style="width:160px;height:160px;object-fit:cover" alt="Preview">
                                @else
                                    {{-- Default (create mode) --}}
                                    <img id="avatarPreview" src="{{ asset('backend/img/avatar.png') }}"
                                        class="rounded img-fluid" style="width:160px;height:160px;object-fit:cover"
                                        alt="Preview">
                                @endif
                            </div>
                            <p class="text-muted small mb-3">JPG or PNG no larger than 5 MB</p>
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
                            <h6 class="m-0 font-weight-bold text-primary">Story Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" placeholder="WELCOME TO SPARTAN"
                                        value="{{ isset($data) ? $data->title : old('title') }}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="editor">Description</label>
                                <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="editor" cols="30"
                                    rows="10">{{ isset($data) ? $data->content : old('content') }}</textarea>
                                @error('content')
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
                        } else {
                            alert("Invalid file type. Please upload an image.");
                            input.value = "";
                        }
                    });
                }
            })();
        </script>
    </div>
@endsection
