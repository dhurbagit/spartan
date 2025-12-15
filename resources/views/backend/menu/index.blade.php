@extends('backend.layout.main')
@section('title', 'Menu')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Menu</h1>
        <a href="{{ route('menu.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Create</a>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h4>Header Menu</h4>
        </div>
        <div class="col-lg-12">
            <div class="dd nestable" id="nestable">
                @if ($menus->count() > 0)
                    <ol class="dd-list menu-list sortable">
                        @foreach ($menus as $menu)
                            <li id="menuItem_{{ $menu->id }}" class="dd-item" data-id="{{ $menu->id }}"
                                data-name="{{ $menu->menu_name }}" data-slug="{{ $menu->slug }}" data-new="0"
                                data-deleted="0">
                                <div class="dd-handle">{{ $menu->menu_name }}</div>
                                <div class="flex_box_wrapper">

                                    <a class="btn btn-success" href="{{ route('menu.edit', $menu->id) }}">
                                        <span class="material-symbols-outlined">
                                            edit
                                        </span>
                                    </a>

                                    <!-- Button trigger modal -->
                                    <a type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#exampleModal{{ $menu->id }}">
                                        <span class="material-symbols-outlined">
                                            delete
                                        </span>
                                    </a>
                                    <div class="switch-button switch-button-xs">
                                        <input data-id="{{ $menu->id }}" class="status_action" type="checkbox"
                                            name="item{{ $menu->id }}" id="item{{ $menu->id }}"
                                            @if ($menu->status == 1) checked @endif />
                                        <span><label for="item{{ $menu->id }}"></label></span>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $menu->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete
                                                    {{ $menu->menu_name }} menu?
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">No</button>
                                                <form action="{{ route('menu.destroy', $menu->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-primary">Yes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- If the menu has children -->
                                @if ($menu->children->count() > 0)
                                    <ol class="dd-list">
                                        @foreach ($menu->children as $submenu)
                                            <li id="menuItem_{{ $submenu->id }}" class="dd-item"
                                                data-id="{{ $submenu->id }}" data-name="{{ $submenu->menu_name }}"
                                                data-slug="{{ $submenu->slug }}" data-new="0" data-deleted="0">
                                                <div class="dd-handle">{{ $submenu->menu_name }}</div>
                                                <div class="flex_box_wrapper">
                                                    <a class="btn btn-success"
                                                        href="{{ route('menu.edit', $submenu->id) }}">
                                                        <span class="material-symbols-outlined">
                                                            edit
                                                        </span>
                                                    </a>

                                                    <!-- Button trigger modal -->
                                                    <a type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#exampleModal{{ $submenu->id }}">
                                                        <span class="material-symbols-outlined">
                                                            delete
                                                        </span>
                                                    </a>
                                                    <div class="switch-button switch-button-xs">
                                                        <input data-id="{{ $submenu->id }}" class="status_action"
                                                            type="checkbox" name="item0{{ $submenu->id }}"
                                                            id="item0{{ $submenu->id }}"
                                                            @if ($submenu->status == 1) checked @endif />
                                                        <span><label for="item0{{ $submenu->id }}"></label></span>
                                                    </div>

                                                </div>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{ $submenu->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Are you sure
                                                                    to delete {{ $submenu->menu_name }} menu?
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">No</button>
                                                                <form action="{{ route('menu.destroy', $submenu->id) }}"
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



                                            </li>
                                        @endforeach
                                    </ol>
                                @endif
                            </li>
                        @endforeach
                    </ol>
                @else
                    <p class="text-center">Menu not found in database</p>
                @endif

            </div>
        </div>
        <div class="col-lg-12">
            <button type="button" class="btn btn-success btn-sm btn-flat" id="serialize">
                <i class="fa fa-save"></i> Update Menu
            </button>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <h4>Footer Menu</h4>
        </div>
        <div class="col-lg-12">
            <div class="dd nestable" id="nestable1">
                @if ($footermenus->count() > 0)
                    <ol class="dd-list menu-list sortable">
                        @foreach ($footermenus as $menu)
                            <li id="menuItem_{{ $menu->id }}" class="dd-item" data-id="{{ $menu->id }}"
                                data-name="{{ $menu->menu_name }}" data-slug="{{ $menu->slug }}" data-new="0"
                                data-deleted="0">
                                <div class="dd-handle">{{ $menu->menu_name }}</div>
                                <div class="flex_box_wrapper">
                                    <a class="btn btn-success" href="{{ route('menu.edit', $menu->id) }}">
                                        <span class="material-symbols-outlined">
                                            edit
                                        </span>
                                    </a>

                                    <!-- Button trigger modal -->
                                    <a type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#exampleModal{{ $menu->id }}">
                                        <span class="material-symbols-outlined">
                                            delete
                                        </span>
                                    </a>
                                    <div class="switch-button switch-button-xs">
                                        <input data-id="{{ $menu->id }}" class="status_action" type="checkbox"
                                            name="item{{ $menu->id }}" id="item{{ $menu->id }}"
                                            @if ($menu->status == 1) checked @endif />
                                        <span><label for="item{{ $menu->id }}"></label></span>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $menu->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete
                                                    {{ $menu->menu_name }} menu?
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">No</button>
                                                <form action="{{ route('menu.destroy', $menu->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-primary">Yes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- If the menu has children -->
                                @if ($menu->children->count() > 0)
                                    <ol class="dd-list">
                                        @foreach ($menu->children as $submenu)
                                            <li id="menuItem_{{ $submenu->id }}" class="dd-item"
                                                data-id="{{ $submenu->id }}" data-name="{{ $submenu->menu_name }}"
                                                data-slug="{{ $submenu->slug }}" data-new="0" data-deleted="0">
                                                 <div class="dd-handle">{{ $submenu->menu_name }}</div>
                                                <div class="flex_box_wrapper">
                                                    <a class="btn btn-success"
                                                        href="{{ route('menu.edit', $submenu->id) }}">
                                                        <span class="material-symbols-outlined">
                                                            edit
                                                        </span>
                                                    </a>

                                                    <!-- Button trigger modal -->
                                                    <a type="button" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#exampleModal{{ $submenu->id }}">
                                                        <span class="material-symbols-outlined">
                                                            delete
                                                        </span>
                                                    </a>
                                                    <div class="switch-button switch-button-xs">
                                                        <input data-id="{{ $submenu->id }}" class="status_action"
                                                            type="checkbox" name="item0{{ $submenu->id }}"
                                                            id="item0{{ $submenu->id }}"
                                                            @if ($submenu->status == 1) checked @endif />
                                                        <span><label for="item0{{ $submenu->id }}"></label></span>
                                                    </div>
                                                </div>


                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{ $submenu->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Are you
                                                                    sure
                                                                    to delete {{ $submenu->menu_name }} menu?
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">No</button>
                                                                <form action="{{ route('menu.destroy', $submenu->id) }}"
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
                                            </li>
                                        @endforeach
                                    </ol>
                                @endif
                            </li>
                        @endforeach
                    </ol>
                @else
                    <p class="text-center">Menu not found in database</p>
                @endif

            </div>
        </div>
        <div class="col-lg-12">
            <button type="button" class="btn btn-success btn-sm btn-flat" id="serialize1">
                <i class="fa fa-save"></i> Update Menu
            </button>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('#nestable, #nestable1').nestable({
            maxDepth: 1
        });

        $("#serialize, #serialize1").click(function(e) {
            e.preventDefault();

            var button = $(this); // Get the clicked button
            var nestableId = button.attr("id") === "serialize" ? "#nestable" :
                "#nestable1"; // Determine which nestable list to use
            var serializedData = $(nestableId).nestable('serialize');

            button.prop("disabled", true).html(
                `<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Updating...`
            );

            $.ajax({
                url: "{{ route('updateMenuOrder') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    sort: serializedData
                },
                success: function(res) {
                    toastr.options.closeButton = true;
                    toastr.success('Menu Order Updated Successfully', "Success!");
                    button.prop("disabled", false).html(
                        `<i class="fa fa-save"></i> Update Menu`);
                },
                error: function(xhr, status, error) {
                    toastr.error('An error occurred while updating the menu order', "Error!");
                    button.prop("disabled", false).html(
                        `<i class="fa fa-save"></i> Update Menu`);
                }
            });
        });
    </script>
    <script>
        $('.status_action').change(function() {
            var id = $(this).attr('data-id');
            $.ajax({
                type: "post",
                url: "{{ route('menu.status') }}",
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
    <script>
        $(document).on("change", ".status_action", function() {
            var dataId = $(this).data("id"); // Get the data-id of clicked checkbox
            var isChecked = $(this).prop("checked"); // Get the current checked state

            // Find all checkboxes with the same data-id and update their state
            $(".status_action[data-id='" + dataId + "']").prop("checked", isChecked);
        });
    </script>
@endpush
