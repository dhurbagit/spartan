@extends('backend.layout.main')
@section('title', 'Product Background')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Product Background Images</h1>
    </div>

    <div class="row">
        <div class="col-lg-4">
            @if (isset($background_image))
                <form class="container-fluid px-0" method="POST" action="{{ route('background-image.update', $background_image->id) }}"
                    enctype="multipart/form-data" novalidate>
                    @method('PUT')
                @else
                    <form class="container-fluid px-0" method="POST" action="{{ route('background-image.store') }}"
                        enctype="multipart/form-data" novalidate>
            @endif

            @csrf
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h6 class="mb-3 font-weight-bold text-gray-800">Product Background Picture</h6>

                    <div class="mb-3 align-items-center justify-content-center d-flex flex-column">
                        @if (isset($background_image))
                            <img id="avatarPreview" src="{{ asset('storage/' . $background_image->media) }}" class="rounded img-fluid"
                                style="width:160px;height:160px;object-fit:cover" alt="Preview">
                        @else
                            {{-- Default (create mode) --}}
                            <img id="avatarPreview" src="{{ asset('backend/img/avatar.png') }}" class="rounded img-fluid"
                                style="width:160px;height:160px;object-fit:cover" alt="Preview">
                        @endif

                    </div>

                    <p class="text-muted small mb-3">JPG or PNG or MP4 no larger than 5 MB</p>
                    @error('media')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="custom-file text-left">
                        <input type="file" class="custom-file-input @error('media') is-invalid @enderror" id="media"
                            name="media" accept="image/*">
                        <label class="custom-file-label" for="media">Upload</label>
                    </div>
                </div>
                <div class="card-footer text-center">
                    @if (isset($background_image))
                        <button type="submit" class="btn btn-primary">Update changes</button>
                    @else
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    @endif
                </div>
            </div>
            </form>

        </div>
        <div class="col-lg-8">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Product Background Images list</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Images</th>
                                    <th>Hide/Show</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>S.No</th>
                                    <th>Images</th>
                                    <th>Hide/Show</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @if (isset($data) && $data->count() > 0)
                                    @foreach ($data as $record => $background_image)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if ($background_image->media)
                                                    <img src="{{ asset('storage/' . $background_image->media) }}" alt="slider image"
                                                        width="100" height="80"
                                                        style="object-fit: cover; border-radius:4px;">
                                                @endif
                                            </td>

                                            <td>
                                                <div class="button-relative">
                                                    <div class="switch-button switch-button-xs">
                                                        <input data-id="{{ $background_image->id }}" class="status_action"
                                                            type="checkbox" name="item{{ $background_image->id }}"
                                                            id="item{{ $background_image->id }}"
                                                            @if ($background_image->status == 1) checked @endif />
                                                        <span><label for="item{{ $background_image->id }}"></label></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('background-image.edit', $background_image->id) }}"
                                                    class="btn btn-primary">
                                                    <span class="material-symbols-outlined">
                                                        edit
                                                    </span>
                                                </a>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#exampleModal{{ $background_image->id }}">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{ $background_image->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Are you sure
                                                                    you
                                                                    want to
                                                                    delete</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">No</button>
                                                                <form
                                                                    action="{{ route('background-image.destroy', $background_image->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Yes</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        (function() {
            var input = document.getElementById('media');
            var label = document.querySelector('label[for="media"].custom-file-label');
            var preview = document.getElementById('avatarPreview');

            if (input) {
                input.addEventListener('change', function(e) {
                    var file = input.files && input.files[0];
                    if (!file) return;

                    // check file size (5MB = 5 * 1024 * 1024)
                    if (file.size > 5 * 1024 * 1024) {
                        alert("⚠️ File size must not exceed 5MB!");
                        input.value = ""; // reset file input
                        if (label) label.textContent = "Choose file";
                        preview.src = "{{ asset('backend/img/avatar.png') }}"; // reset to default if needed
                        return;
                    }

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

    <script>
        $('.status_action').change(function() {
            var id = $(this).attr('data-id');
            $.ajax({
                type: "post",
                url: "{{ route('background-image.status') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                },
                success: function(res) {
                    toastr.success(res);
                }
            });
        });
    </script>
@endpush
