<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->

    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.0/ckeditor5.css" />
    <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('backend/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('backend/img/favicon_io/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('backend/img/favicon_io/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/img/favicon_io/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('backend/img/favicon_io/site.webmanifest') }}">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('backend.layout.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('backend.layout.header')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('content')


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('backend.layout.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('backend/js/sb-admin-2.min.js') }}"></script>

    <script src="{{ asset('backend/js/nested-menu.js') }}"></script>
    <script src="{{ asset('backend/js/nested-menu1.js') }}"></script>

    <!-- Page level plugins -->
    {{-- <script src="{{ asset('backend/vendor/chart.js/Chart.min.js') }}"></script> --}}

    <!-- Page level custom scripts -->
    {{-- <script src="{{ asset('backend/js/demo/chart-area-demo.js') }}"></script> --}}
    {{-- <script src="{{ asset('backend/js/demo/chart-pie-demo.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!--
    |----------------------------------------------------------------------|
    |  The following scripts are for DataTables.                           |
    |----------------------------------------------------------------------|
    -->
    <!-- Page level plugins -->
    <script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Page level custom scripts -->
    <script src="{{ asset('backend/js/demo/datatables-demo.js') }}"></script>
    @stack('scripts')
    <script>
        // toster ja
        @if (Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <script type="importmap">
        {
            "imports": {
                "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.0/ckeditor5.js",
                "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.0/",
                "ckeditor5-premium-features": "https://cdn.ckeditor.com/ckeditor5-premium-features/42.0.0/ckeditor5-premium-features.js",
                "ckeditor5-premium-features/": "https://cdn.ckeditor.com/ckeditor5-premium-features/42.0.0/"
            }
        }
    </script>
    <script type="module">
        import {
            ClassicEditor,
            Autoformat,
            Bold,
            Italic,
            Underline,
            BlockQuote,
            Base64UploadAdapter,
            CloudServices,
            Essentials,
            FindAndReplace,
            Font,
            Heading,
            Image,
            ImageCaption,
            ImageResize,
            ImageStyle,
            ImageToolbar,
            ImageUpload,
            PictureEditing,
            Indent,
            IndentBlock,
            Link,
            List,
            MediaEmbed,
            Mention,
            Paragraph,
            PasteFromOffice,
            SourceEditing,
            Table,
            TableColumnResize,
            TableToolbar,
            TextTransformation,
            HtmlEmbed,
            CodeBlock,
            RemoveFormat,
            Code,
            SpecialCharacters,
            HorizontalLine,
            PageBreak,
            TodoList,
            Strikethrough,
            Subscript,
            Superscript,
            Highlight,
            Alignment
        } from 'ckeditor5';

        import {
            ExportPdf,
            ExportWord
        } from 'ckeditor5-premium-features';

        const editors = ['#editor', '#editor1', '#editor2', '#editor3', '#editor4', '#editor5', '#editor6', '#editor7',
            '#editor8'
        ];

        editors.forEach(selector => {
            ClassicEditor.create(document.querySelector(selector), {
                    plugins: [
                        Autoformat,
                        BlockQuote,
                        Bold,
                        CloudServices,
                        Essentials,
                        FindAndReplace,
                        Font,
                        Heading,
                        Image,
                        ImageCaption,
                        ImageResize,
                        ImageStyle,
                        ImageToolbar,
                        ImageUpload,
                        Base64UploadAdapter,
                        Indent,
                        IndentBlock,
                        Italic,
                        Link,
                        List,
                        MediaEmbed,
                        Mention,
                        Paragraph,
                        PasteFromOffice,
                        PictureEditing,
                        SourceEditing,
                        Table,
                        TableColumnResize,
                        TableToolbar,
                        TextTransformation,
                        Underline,
                        HtmlEmbed,
                        CodeBlock,
                        RemoveFormat,
                        Code,
                        SpecialCharacters,
                        HorizontalLine,
                        PageBreak,
                        TodoList,
                        Strikethrough,
                        Subscript,
                        Superscript,
                        Highlight,
                        Alignment,
                        ExportPdf,
                        ExportWord
                    ],
                    toolbar: {
                        items: [
                            'undo', 'redo',
                            '|',
                            'sourceEditing',
                            '|',
                            'exportPDF', 'exportWord',
                            '|',
                            'findAndReplace', 'selectAll',
                            '|',
                            'heading',
                            '|',
                            'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor',
                            '-',
                            'bold', 'italic', 'underline',
                            {
                                label: 'Formatting',
                                icon: 'text',
                                items: ['strikethrough', 'subscript', 'superscript', 'code', '|',
                                    'removeFormat'
                                ]
                            },
                            '|',
                            'specialCharacters', 'horizontalLine', 'pageBreak',
                            '|',
                            'link', 'insertImage', 'insertTable',
                            {
                                label: 'Insert',
                                icon: 'plus',
                                items: ['highlight', 'blockQuote', 'mediaEmbed', 'codeBlock', 'htmlEmbed']
                            },
                            'alignment',
                            '|',
                            'bulletedList', 'numberedList', 'todoList',
                            {
                                label: 'Indents',
                                icon: 'plus',
                                items: ['outdent', 'indent']
                            }
                        ],
                        shouldNotGroupWhenFull: true
                    },
                    list: {
                        properties: {
                            styles: true,
                            startIndex: true,
                            reversed: true
                        }
                    },
                    heading: {
                        options: [{
                                model: 'paragraph',
                                title: 'Paragraph',
                                class: 'ck-heading_paragraph'
                            },
                            {
                                model: 'heading1',
                                view: 'h1',
                                title: 'Heading 1',
                                class: 'ck-heading_heading1'
                            },
                            {
                                model: 'heading2',
                                view: 'h2',
                                title: 'Heading 2',
                                class: 'ck-heading_heading2'
                            },
                            {
                                model: 'heading3',
                                view: 'h3',
                                title: 'Heading 3',
                                class: 'ck-heading_heading3'
                            },
                            {
                                model: 'heading4',
                                view: 'h4',
                                title: 'Heading 4',
                                class: 'ck-heading_heading4'
                            },
                            {
                                model: 'heading5',
                                view: 'h5',
                                title: 'Heading 5',
                                class: 'ck-heading_heading5'
                            },
                            {
                                model: 'heading6',
                                view: 'h6',
                                title: 'Heading 6',
                                class: 'ck-heading_heading6'
                            }
                        ]
                    },
                    placeholder: 'Welcome to CKEditor 5!',
                    image: {
                        resizeOptions: [{
                                name: 'resizeImage:original',
                                label: 'Default image width',
                                value: null
                            },
                            {
                                name: 'resizeImage:50',
                                label: '50% page width',
                                value: '50'
                            },
                            {
                                name: 'resizeImage:75',
                                label: '75% page width',
                                value: '75'
                            }
                        ],
                        toolbar: [
                            'imageTextAlternative', 'toggleImageCaption', '|',
                            'imageStyle:inline', 'imageStyle:wrapText', 'imageStyle:breakText', '|',
                            'resizeImage'
                        ]
                    },
                    link: {
                        addTargetToExternalLinks: true,
                        defaultProtocol: 'https://'
                    },
                    table: {
                        contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells'],
                    }
                })
                .then((editor) => {
                    window.editor = editor;
                })
                .catch((error) => {
                    console.error(error.stack);
                });
        });
    </script>


</body>

</html>
