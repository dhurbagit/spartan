@extends('backend.layout.main')
@section('title', 'Vacancy')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Vacancy</h1>
        <a href="{{ route('vacancy.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fa fa-list-ol" aria-hidden="true"></i>
            View List</a>
    </div>
    <div class="row">
        <!-- Profile Edit (SB Admin 2 / Bootstrap 4) -->
        @if (isset($data))
            <form class="container-fluid px-0" method="POST" action="{{ route('vacancy.update', $data->id) }}"
                enctype="multipart/form-data" novalidate>
                @method('PUT')
            @else
                <form class="container-fluid px-0" method="POST" action="{{ route('vacancy.store') }}"
                    enctype="multipart/form-data" novalidate>
        @endif

        @csrf

        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Vacancy Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="jobTitle">Job Title</label>
                                <input type="text" class="form-control @error('jobTitle') is-invalid @enderror"
                                    id="jobTitle" name="jobTitle" placeholder="Sales Executive"
                                    value="{{ isset($data) ? $data->jobTitle : old('jobTitle') }}">
                                @error('jobTitle')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="location">Location</label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror"
                                    id="location" name="location" placeholder="Hetauda"
                                    value="{{ isset($data) ? $data->location : old('location') }}">
                                @error('location')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="jobType">Job Type</label>
                                <input type="text" class="form-control @error('jobType') is-invalid @enderror"
                                    id="jobType" name="jobType" placeholder="Part Time/ Full time/ Contract"
                                    value="{{ isset($data) ? $data->jobType : old('jobType') }}">
                                @error('jobType')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="expireDate">Expire Date</label>
                                <input type="date" class="form-control @error('expireDate') is-invalid @enderror"
                                    id="expireDate" name="expireDate" placeholder="Select Date"
                                    value="{{ isset($data) ? \Carbon\Carbon::parse($data->expireDate)->format('Y-m-d') : old('expireDate') }}">
                                @error('expireDate')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group">
                            <label for="editor">Job Detail</label>
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
    </div>
@endsection
