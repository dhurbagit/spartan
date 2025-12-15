@extends('backend.layout.main')
@section('title', 'Customer contact')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List view Contact</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>S.No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($CustomerContact as $record)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $record->name }}</td>
                                        <td>{{ $record->email }}</td>
                                        <td>{{ $record->phone }}</td>

                                        <td>
                                            <a href="" class="btn btn-primary" data-toggle="modal"
                                                data-target="#message{{ $record->id }}">
                                                <span class="material-symbols-outlined">
                                                    visibility
                                                </span>
                                            </a>
                                            <a href="{{ route('customer-contact.edit', $record->id) }}" class="btn btn-success"
                                                data-toggle="tooltip" data-placement="top" title="Reply Email">
                                                <span class="material-symbols-outlined">
                                                    reply
                                                </span>
                                            </a>
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#exampleModal{{ $record->id }}">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="exampleModal{{ $record->id }}" tabindex="-1"
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
                                                            <form action="{{ route('customer-contact.destroy', $record->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="btn btn-primary">Yes</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- message view Modal -->
                                            <div class="modal fade" id="message{{ $record->id }}" tabindex="-1"
                                                aria-labelledby="messagelLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Message from {{ $record->name }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                           {{ $record->message }}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
