@extends('backend.layout.main')
@section('title', 'Admin Profile')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <div class="row">

        <form class="container-fluid px-0" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data"
            novalidate>
            @csrf @method('PUT')
            <div class="row">
                <!-- Left: Profile Picture -->
                <div class="col-lg-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body text-center">
                            <h6 class="mb-3 font-weight-bold text-gray-800">Profile Picture</h6>

                            <div class="mb-3">
                                <img id="avatarPreview"
                                    src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('backend/img/avatar.png') }}"
                                    class="rounded-circle img-fluid" style="width:160px;height:160px;object-fit:cover"
                                    alt="Avatar preview">
                                @error('avatar')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <p class="text-muted small mb-3">JPG or PNG no larger than 5 MB</p>

                            <div class="custom-file text-left">
                                <input type="file" class="custom-file-input" id="avatar" name="avatar"
                                    accept="image/*">
                                <label class="custom-file-label" for="avatar">Upload new image</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Account Details -->
                <div class="col-lg-8 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Account Details</h6>
                        </div>
                        <div class="card-body">
                            <!-- Username -->
                            <div class="form-group">
                                <label for="username">Username (how your name will appear to other users on the
                                    site)</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="name"
                                    value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="organization">Organization name</label>
                                    <input type="text" class="form-control" id="organization" name="organization"
                                        value="{{ old('organization', $user->organization) }}">
                                    @error('organization')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="location">Location</label>
                                    <input type="text" class="form-control" id="location" name="location"
                                        placeholder="City, Country" value="{{ old('location', $user->location) }}">
                                    @error('location')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="phone">Phone number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone"
                                        placeholder="555-123-4567" value="{{ old('phone', $user->phone) }}">
                                    @error('phone')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="birthday">Birthday</label>
                                    <input type="date" class="form-control" id="birthday" name="birthday"
                                        value="{{ old('birthday', $user->birthday) }}">
                                    @error('birthday')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>



    </div>
@endsection

@push('scripts')
    <!-- Optional: small JS to show selected avatar filename + preview -->
    <script>
        (function() {
            var input = document.getElementById('avatar');
            var label = document.querySelector('label[for="avatar"].custom-file-label');
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
@endpush
