@extends('backend.layout.main')
@section('title', 'Site Setting')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Site Setting</div>
                <div class="card-body">
                    <form action="{{ route('site-setting.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div id="site_setting">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab" data-toggle="pill"
                                        data-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                        aria-selected="true">Site Info</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-profile-tab" data-toggle="pill"
                                        data-target="#pills-profile" type="button" role="tab"
                                        aria-controls="pills-profile" aria-selected="false">Social Media</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab" data-toggle="pill"
                                        data-target="#pills-contact" type="button" role="tab"
                                        aria-controls="pills-contact" aria-selected="false">Contact Detail</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                    aria-labelledby="pills-home-tab">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="image">Logo</label>
                                            <div class="trip_thumbnail">
                                                <img @isset($data)
                                                src="{{ asset('storage/' . $data->media) }}"
                                            @endisset
                                                    id="placeholder_image" alt="">
                                                <input class="form-control" type="file" name="media"
                                                    onchange="loadFile(event)">
                                            </div>
                                            @error('media')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12">
                                            <br>
                                            <label for="footer_message">Footer Message</label>
                                            <textarea class="form-control" name="footer_message" id="footer_message" cols="30" rows="10">{{ isset($data) ? $data->footer_message : old('footer_message') }}</textarea>
                                            @error('footer_message')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                    aria-labelledby="pills-profile-tab">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="facebook" class="form-label">Facebook</label>
                                                <input type="text" class="form-control" id="facebook"
                                                    placeholder="Facebook Link" name="facebook" value="{{ isset($data) ? $data->facebook : old('facebook') }}">
                                                @error('facebook')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="instagram" class="form-label">Instagram</label>
                                                <input type="text" class="form-control" id="instagram"
                                                    placeholder="Instagram Link" name="instagram" value="{{ isset($data) ? $data->instagram : old('instagram') }}">
                                                @error('instagram')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="tiktok" class="form-label">Tiktok</label>
                                                <input type="text" class="form-control" id="tiktok"
                                                    placeholder="Tiktok Link" name="tiktok" value="{{ isset($data) ? $data->tiktok : old('tiktok') }}">
                                                @error('tiktok')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="youtube" class="form-label">Youtube</label>
                                                <input type="text" class="form-control" id="youtube"
                                                    placeholder="Youtube Link" name="youtube" value="{{ isset($data) ? $data->youtube : old('youtube') }}">
                                                @error('youtube')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                    aria-labelledby="pills-contact-tab">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="phone_no" class="form-label">Phone No</label>
                                                <input type="number" class="form-control" id="phone_no"
                                                    placeholder="01-4412345" name="phone_no" value="{{ isset($data) ? $data->phone_no : old('phone_no') }}">
                                                @error('phone_no')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="mobile_no" class="form-label">Mobile No</label>
                                                <input type="number" class="form-control" id="mobile_no"
                                                    placeholder="+977-9841234567" name="mobile_no" value="{{ isset($data) ? $data->mobile_no : old('mobile_no') }}">
                                                @error('mobile_no')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email"
                                                    placeholder="example@gmail.com" name="email" value="{{ isset($data) ? $data->email : old('email') }}">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="zip_code" class="form-label">Zip Code</label>
                                                <input type="number" class="form-control" id="zip_code"
                                                    placeholder="04419" name="zip_code" value="{{ isset($data) ? $data->zip_code : old('zip_code') }}">
                                                @error('zip_code')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="location" class="form-label">Location</label>
                                                <textarea class="form-control" name="location" id="location" cols="30" rows="5">{{ isset($data) ? $data->location : old('location') }}</textarea>
                                                @error('location')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="google_map" class="form-label">Google Map</label>
                                                <textarea class="form-control" name="google_map" id="google_map" cols="30" rows="5">{{ isset($data) ? $data->google_map : old('google_map') }}</textarea>
                                                @error('google_map')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <br>
                                    @if(isset($data))
                                    <button type="submit" class="btn btn-success">Update</button>
                                    @else
                                     <button type="submit" class="btn btn-success">Save</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var loadFile = function(event) {
            var image = document.getElementById('placeholder_image');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endpush
