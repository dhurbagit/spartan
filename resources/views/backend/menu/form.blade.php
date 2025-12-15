@extends('backend.layout.main')
@section('title', 'Menu')
@section('content')
    <!-- Page Heading -->
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        @if (isset($data))
            <h1 class="h3 mb-0 text-gray-800">Edit Menu</h1>
        @else
            <h1 class="h3 mb-0 text-gray-800">Create New Menu</h1>
        @endif
        <a href="{{ route('menu.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-fw fa-cog text-white-50"></i> View List</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if (isset($data))
                        <form action="{{ route('menu.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PUT')
                        @else
                            <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
                    @endif

                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="menu_name">Menu Name</label>
                                <input type="text" class="form-control" name="menu_name" id="menu_name"
                                    value="{{ isset($data) ? $data->menu_name : old('menu_name') }}"
                                    placeholder="Enter Menu Name">
                                @error('menu_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label for="image">Main Image</label>
                            <div class="trip_thumbnail">
                                <img @isset($data)
                                        src="{{ asset('storage/' . $data->image) }}"
                                    @endisset
                                    id="placeholder_image" alt="">
                                <input class="form-control" type="file" name="image" onchange="loadFile(event)">
                            </div>

                        </div>
                        <div class="col-lg-4">
                            <label for="bannerImage">Banner Image</label>
                            <div class="trip_thumbnail">
                                <img @isset($data)
                                        src="{{ asset('storage/' . $data->bannerImage) }}"
                                    @endisset
                                    id="placeholder_image1" alt="">
                                <input class="form-control" type="file" name="bannerImage" onchange="loadFile1(event)">
                            </div>
                            @error('bannerImage')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="page_title">Page Title</label>
                                <input type="text" class="form-control" name="page_title" id="page_title"
                                    value="{{ isset($data) ? $data->page_title : old('page_title') }}"
                                    placeholder="Enter Page Title">
                                @error('page_title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Menu Category (Page Template)</label>
                                <select class="form-control js-example-basic-single select2" name="category_slug">
                                    <option value="">--Select a category--</option>
                                    @foreach ($menu_categories as $category)
                                        <option value="{{ $category }}"
                                            {{ isset($data) ? ($category == $data->category_slug ? 'selected' : '') : '' }}>
                                            {{ ucwords($category) }}</option>
                                    @endforeach

                                </select>
                                @error('category_slug')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Main or Child Menu</label>
                                <select class="form-control js-example-basic-single select2 main_child" name="main_child">
                                    <option value="">--Select a category--</option>
                                    <option value="0"
                                        {{ isset($data) ? ($data->main_child == 0 ? 'selected' : '') : '' }}>Main Menu
                                    </option>
                                    <option value="1" disabled
                                        {{ isset($data) ? ($data->main_child == 1 ? 'selected' : '') : '' }}>Child Menu
                                    </option>
                                </select>
                                @error('main_child')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-lg-4" id="parent" style="display:none">
                            <div class="form-group">
                                <label>Under Main Menu</label>

                                <select class="form-control" name="parent_id">
                                    <option value="">--Select a Parent Menu--</option>
                                    @foreach ($parent_menus as $menu)
                                        <option value="{{ $menu->id }}"
                                            {{ isset($data) ? ($data->parent_id == $menu->id ? 'selected' : '') : '' }}>
                                            {{ $menu->menu_name }}
                                            ({{ $menu->header_footer == 1 ? 'header' : ($menu->header_footer == 2 ? 'footer' : ($menu->header_footer == 3 ? 'header and footer' : '')) }})
                                        </option>
                                        </option>
                                        @foreach ($menu->children as $childMenu)
                                            <option value="{{ $childMenu->id }}"
                                                {{ isset($data) ? ($data->parent_id == $childMenu->id ? 'selected' : '') : '' }}>
                                                --{{ $childMenu->menu_name }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                                 @error('parent_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4" id="header_footer">
                            <div class="form-group">
                                <label>Show In</label>
                                <select class="form-control js-example-basic-single select2" name="header_footer">
                                    <option value="">--Select where to show--</option>
                                    <option value="1"
                                        {{ isset($data) ? ($data->header_footer == 1 ? 'selected' : '') : '' }}>Header
                                    </option>
                                    <option value="2"
                                        {{ isset($data) ? ($data->header_footer == 2 ? 'selected' : '') : '' }}>Footer
                                    </option>
                                    <option value="3"
                                        {{ isset($data) ? ($data->header_footer == 3 ? 'selected' : '') : '' }}>Header
                                        and Footer</option>

                                </select>
                                @error('header_footer')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>External Link (Optional)</label>
                                <input type="text" class="form-control" name="external_link"
                                    value="{{ isset($data) ? $data->external_link : old('external_link') }}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="content" id="editor" cols="30" rows="10">{{ isset($data) ? $data->content : old('content') }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Page Content</label>
                                <textarea class="form-control" name="description" id="editor1" cols="30" rows="10">{{ isset($data) ? $data->description : old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Meta Title</label>
                                <textarea class="form-control" name="metaTitle" id="" cols="30" rows="10">{{ isset($data) ? $data->metaTitle : old('metaTitle') }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Meta Keyword</label>
                                <textarea class="form-control" name="metaKeyword" id="" cols="30" rows="10">{{ isset($data) ? $data->metaKeyword : old('metaKeyword') }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Meta Description</label>
                                <textarea class="form-control" name="metaDescription" id="" cols="30" rows="10">{{ isset($data) ? $data->metaDescription : old('metaDescription') }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <br>
                            @if (isset($data))
                                <button type="submit" class="btn btn-success">Update</button>
                            @else
                                <button type="submit" class="btn btn-success">Save</button>
                            @endif
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
        @if (isset($data))
            $(window).ready(function() {

                var main_child = $('.main_child').children("option:selected").val();

                if (main_child == 1) {
                    document.getElementById("parent").style.display = "block";

                } else if (main_child == 0) {
                    document.getElementById("parent").style.display = "none";

                }
            })
        @endif
    </script>
    <script>
        $(function() {
            $('.main_child').change(function() {
                var main_child = $(this).children("option:selected").val();
                if (main_child == 1) {
                    document.getElementById("parent").style.display = "block";
                } else if (main_child == 0) {
                    document.getElementById("parent").style.display = "none";
                }
            })
        });
    </script>
    <script>
        var loadFile = function(event) {
            var image = document.getElementById('placeholder_image');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
    <script>
        var loadFile1 = function(event) {
            var image = document.getElementById('placeholder_image1');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endpush
