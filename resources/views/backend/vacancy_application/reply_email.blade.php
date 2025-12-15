@extends('backend.layout.main')
@section('title', 'Vacancy')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Reply Email to {{ $VacancyApplication->name }}</h1>
          <a href="{{ route('vacancy-view.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fa fa-plus-square" aria-hidden="true"></i>
            Back</a>
    </div>


    <form action="{{ route('vacancy-view.update', $VacancyApplication->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-12">
                <input type="hidden" name="reply_email" value="{{ $VacancyApplication->email }}">
                <textarea name="vacancy_reply" id="editor" cols="30" rows="10"></textarea>
                @error('vacancy_reply')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-lg-12">
                <br>
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
        </div>
    </form>
@endsection
{{-- VacancyApplication --}}
