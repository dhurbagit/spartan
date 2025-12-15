@extends('backend.layout.main')
@section('title', 'Promotion Media')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Promotion Video/images</h1>
    </div>
    <div class="row">
        <!-- Profile Edit (SB Admin 2 / Bootstrap 4) -->
        <form class="container-fluid px-0" method="POST" action="{{ route('promotion-video.update') }}"
            enctype="multipart/form-data" novalidate>
            @method('PUT')
            @csrf

            <div class="row">
                <!-- Left: Profile Picture -->
                <div class="col-lg-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h6 class="mb-3 font-weight-bold text-gray-800">Promotion Picture/video</h6>
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
                                            class="rounded img-fluid"
                                            style="width:160px;height:160px;object-fit:cover;display:none;" alt="Preview">
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
                <div class="col-lg-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h6 class="mb-3 font-weight-bold text-gray-800">Cover Image</h6>
                            <div class="mb-3 align-items-center justify-content-center d-flex flex-column">
                                @php
                                    $media = isset($data) ? $data->cover_image : null;
                                    $ext = $media ? strtolower(pathinfo($media, PATHINFO_EXTENSION)) : null;
                                @endphp
                                @if ($media)
                                    {{-- If image --}}
                                    @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                        <img id="cover_imagePreview" src="{{ asset('storage/' . $media) }}"
                                            class="rounded img-fluid" style="width:160px;height:160px;object-fit:cover"
                                            alt="Preview">
                                    @endif
                                @else
                                    {{-- Default (create mode) --}}
                                    <img id="cover_imagePreview" src="{{ asset('backend/img/avatar.png') }}"
                                        class="rounded img-fluid" style="width:160px;height:160px;object-fit:cover"
                                        alt="Preview">
                                @endif
                            </div>
                            <p class="text-muted small mb-3">JPG or PNG or MP4 no larger than 5 MB</p>
                            @error('cover_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="custom-file text-left">
                                <input type="file" class="custom-file-input @error('cover_image') is-invalid @enderror"
                                    id="cover_image" name="cover_image" accept="image/*">
                                <label class="custom-file-label" for="cover_image">Upload</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    @if (isset($data))
                        <button type="submit" class="btn btn-primary btn-block mb-4">Update Changes</button>
                    @else
                        <button type="submit" class="btn btn-primary btn-block mb-4">Create Promotion Media</button>
                    @endif
                </div>
                <!-- Right: Account Details -->
            </div>
        </form>
        <script>
            (function() {
                // Reusable wiring function
                function wireUploader(cfg) {
                    var input = document.getElementById(cfg.inputId);
                    if (!input) return;

                    var label = document.querySelector(`label[for="${cfg.inputId}"].custom-file-label`);
                    var imgPrev = cfg.imgPreviewId ? document.getElementById(cfg.imgPreviewId) : null;
                    var vidPrev = cfg.videoPreviewId ? document.getElementById(cfg.videoPreviewId) : null;
                    var vidSrc = (vidPrev && vidPrev.querySelector('source')) ? vidPrev.querySelector('source') : null;

                    input.addEventListener('change', function() {
                        var file = input.files && input.files[0];
                        if (!file) return;

                        // size check
                        if (file.size > (cfg.maxMB || 5) * 1024 * 1024) {
                            alert(`File is too large. Maximum allowed size is ${(cfg.maxMB || 5)} MB.`);
                            input.value = "";
                            if (label) label.textContent = (cfg.placeholder || "Choose file");
                            if (imgPrev && cfg.defaultImg) imgPrev.src = cfg.defaultImg;
                            if (imgPrev) imgPrev.style.display = imgPrev ? "block" : "";
                            if (vidPrev) vidPrev.style.display = "none";
                            return;
                        }

                        // type check
                        var isImage = file.type.startsWith("image/");
                        var isMp4 = file.type === "video/mp4";
                        var ok = (cfg.acceptImages && isImage) || (cfg.acceptVideo && isMp4);

                        if (!ok) {
                            alert(cfg.acceptVideo ?
                                "Invalid file type. Please upload an image or an MP4 video." :
                                "Invalid file type. Please upload an image.");
                            input.value = "";
                            if (label) label.textContent = (cfg.placeholder || "Choose file");
                            return;
                        }

                        // label text
                        if (label) label.textContent = file.name;

                        // previews
                        if (isImage && imgPrev) {
                            var r = new FileReader();
                            r.onload = function(ev) {
                                imgPrev.src = ev.target.result;
                            };
                            r.readAsDataURL(file);
                            imgPrev.style.display = "block";
                            if (vidPrev) vidPrev.style.display = "none";
                        } else if (isMp4 && vidPrev && vidSrc) {
                            var url = URL.createObjectURL(file);
                            vidSrc.src = url;
                            vidPrev.load();
                            vidPrev.style.display = "block";
                            if (imgPrev) imgPrev.style.display = "none";
                        }
                    });
                }

                // 1) Input that supports IMAGE + MP4 video (e.g., id="media")
                wireUploader({
                    inputId: "media",
                    imgPreviewId: "avatarPreview", // <img id="avatarPreview">
                    videoPreviewId: "videoPreview", // <video id="videoPreview"><source></video>
                    defaultImg: "{{ asset('backend/img/avatar.png') }}",
                    placeholder: "Choose file",
                    maxMB: 5,
                    acceptImages: true,
                    acceptVideo: true
                });

                // 2) Input that supports IMAGES ONLY (e.g., id="cover_image")
                wireUploader({
                    inputId: "cover_image",
                    imgPreviewId: "cover_imagePreview", // <img id="cover_imagePreview">
                    defaultImg: "{{ asset('backend/img/avatar.png') }}",
                    placeholder: "Choose file",
                    maxMB: 5,
                    acceptImages: true,
                    acceptVideo: false
                });
            })();
        </script>




    </div>
@endsection
