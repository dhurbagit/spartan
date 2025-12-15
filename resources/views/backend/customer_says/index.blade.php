@extends('backend.layout.main')
@section('title', 'Customer Says')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List view of customers</h1>
        <a href="{{ route('customer-says.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fa fa-plus-square" aria-hidden="true"></i>
            Create New customers</a>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">customers list</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Name</th>
                                    <th>Media</th>
                                    <th>Hide/Show</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>S.No</th>
                                    <th>Name</th>
                                    <th>Media</th>
                                    <th>Hide/Show</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @if (isset($data) && $data->count() > 0)
                                    @foreach ($data as $record => $customers)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $customers->name }}</td>
                                            <td>
                                                @if ($customers->media)
                                                    @php
                                                        // detect file extension
                                                        $extension = pathinfo($customers->media, PATHINFO_EXTENSION);
                                                    @endphp
                                                    @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                                        <img src="{{ asset('storage/' . $customers->media) }}"
                                                            alt="customers image" width="100" height="80"
                                                            style="object-fit: cover; border-radius:4px;">
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                <div class="button-relative">
                                                    <div class="switch-button switch-button-xs">
                                                        <input data-id="{{ $customers->id }}" class="status_action"
                                                            type="checkbox" name="item{{ $customers->id }}"
                                                            id="item{{ $customers->id }}"
                                                            @if ($customers->status == 1) checked @endif />
                                                        <span><label for="item{{ $customers->id }}"></label></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('customer-says.edit', $customers->id) }}" class="btn btn-primary">
                                                    <span class="material-symbols-outlined">
                                                        edit
                                                    </span>
                                                </a>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#exampleModal{{ $customers->id }}">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{ $customers->id }}" tabindex="-1"
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
                                                                <form action="{{ route('customer-says.destroy', $customers->id) }}"
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
                url: "{{ route('customer-says.status') }}",
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
