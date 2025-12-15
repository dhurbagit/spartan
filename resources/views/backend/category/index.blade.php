@extends('backend.layout.main')
@section('title', 'Product Category')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Product Categories View</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Create Category</h6>
                </div>
                <div class="card-body">
                    @if (isset($category))
                        <form class="container-fluid px-0" method="POST" action="{{ route('category.update', $category->id) }}"
                            enctype="multipart/form-data" novalidate>
                            @method('PUT')
                        @else
                            <form class="container-fluid px-0" method="POST" action="{{ route('category.store') }}"
                                enctype="multipart/form-data" novalidate>
                    @endif

                    @csrf

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="name">Category Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="Prawn Cracker" value="{{ isset($category) ? $category->name : old('name') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror


                        </div>
                    </div>
                     @if (isset($category))
                            <button type="submit" class="btn btn-primary">Update changes</button>
                        @else
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
    </br>
    <div class="row">
        <div class="col-lg-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Category list</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Title 1</th>
                                    <th>Hide/Show</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>S.No</th>
                                    <th>Title 1</th>
                                    <th>Hide/Show</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @if (isset($data) && $data->count() > 0)
                                    @foreach ($data as $record => $category)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $category->name }}</td>

                                            <td>
                                                <div class="button-relative">
                                                    <div class="switch-button switch-button-xs">
                                                        <input data-id="{{ $category->id }}" class="status_action"
                                                            type="checkbox" name="item{{ $category->id }}"
                                                            id="item{{ $category->id }}"
                                                            @if ($category->status == 1) checked @endif />
                                                        <span><label for="item{{ $category->id }}"></label></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('category.edit', $category->id) }}"
                                                    class="btn btn-primary">
                                                    <span class="material-symbols-outlined">
                                                        edit
                                                    </span>
                                                </a>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#exampleModal{{ $category->id }}">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{ $category->id }}" tabindex="-1"
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
                                                                <form action="{{ route('category.destroy', $category->id) }}"
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
        $('.status_action').change(function() {
            var id = $(this).attr('data-id');
            $.ajax({
                type: "post",
                url: "{{ route('category.status') }}",
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
