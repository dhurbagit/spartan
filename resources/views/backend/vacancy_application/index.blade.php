@extends('backend.layout.main')
@section('title', 'Vacancy')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List view Vacancy</h1>
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
                                    <th>Position</th>
                                    <th>Phone</th>
                                    <th>File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>S.No</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Phone</th>
                                    <th>File</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($vacancy as $record)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $record->name }}</td>
                                        <td>{{ $record->job_title }}</td>
                                        <td>{{ $record->phone }}</td>
                                        <td><a target="_blank" href="{{ asset('storage/' . $record->media) }}"
                                                data-toggle="tooltip" data-placement="top" title="View File">File</a></td>
                                        <td>
                                            <a href="{{ route('vacancy-view.edit', $record->id) }}" class="btn btn-success"
                                                data-toggle="tooltip" data-placement="top" title="Reply Email">
                                                <span class="material-symbols-outlined">
                                                    reply
                                                </span>
                                            </a>
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#exampleModal{{ $record->id }}">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                            <!-- Modal -->
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
                                                            <form action="{{ route('vacancy-view.destroy', $record->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="btn btn-primary">Yes</button>
                                                            </form>
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
