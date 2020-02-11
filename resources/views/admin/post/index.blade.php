@extends('layout.backend.main')
@section('title','Post Admin')

@push('css')
<link href="{{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}"
    rel="stylesheet">
@endpush

@section('content')

<div class="container-fluid">
    <div class="block-header">
        <a href="{{route('admin.post.create')}}" class="btn btn-primary waves-effect">
            <i class="material-icons">add</i>
            <span>Add New Post</span>
        </a>
    </div>
    <!-- Basic Examples -->
    <!-- #END# Basic Examples -->
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        ALL POSTS
                        <span class="badge bg-info">{{$posts->count()}}</span>
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th><i class="material-icons">visibility</i></th>
                                    <th>Is Approved</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    {{-- <th>Updated At</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th><i class="material-icons">visibility</i></th>
                                    <th>Is Approved</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    {{-- <th>Updated At</th> --}}
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($posts as $key=>$post)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{ str_limit($post->title,'10')}}</td>
                                    <td>{{$post->user->name}}</td>
                                    <td>{{$post->view_count}}</td>
                                    {{-- <td>
                                        @if ($post->is_approved == false)
                                        <button type="button" class="btn btn-success waves-effect btn-sm"
                                            onclick="approvePost({{$post->id}})">
                                    <i class="material-icons">done</i>
                                    <span>Approve</span>
                                    </button>
                                    <form action="{{route('admin.post.approve',$post->id)}}" id="approval-form"
                                        style="display:none;" method="POST">
                                        @csrf
                                        @method('PUT')
                                    </form>
                                    @else
                                    <button type="button" class="btn btn-info btn-sm" disabled>
                                        <i class="material-icons">done</i>
                                        <span>Approved</span>
                                    </button>
                                    @endif
                                    </td> --}}
                                    <td>
                                        @if ($post->is_approved == true)
                                        <span class="badge bg-blue">Approved</span>
                                        @else
                                        <span class="badge bg-pink">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($post->status == true)
                                        <span class="badge bg-blue">Published</span>
                                        @else
                                        <span class="badge bg-pink">Not Published</span>
                                        @endif
                                    </td>
                                    <td>{{$post->created_at}}</td>
                                    {{-- <td>{{$post->updated_at}}</td> --}}
                                    <td class="text-center">
                                        <a href="{{route('admin.post.show',$post->id)}}"
                                            class="btn btn-info waves-effect">
                                            <i class="material-icons">visibility</i>
                                        </a>
                                        <a href="{{route('admin.post.edit',$post->id)}}"
                                            class="btn btn-info waves-effect">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <button class="btn btn-danger waves-effect" type="button">
                                            <i class="material-icons" onclick="deletePost({{$post->id}})">delete</i>
                                        </button>
                                        <form id="delete-form-{{$post->id}}"
                                            action="{{route('admin.post.destroy',$post->id)}}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
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
    <!-- #END# Exportable Table -->
</div>

@endsection
@push('js')
<script src="{{asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
<script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>

<script src="{{asset('assets/backend/js/pages/tables/jquery-datatable.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>
    function deletePost(id){
        const swal = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success ml-5 mr-5 px-3',
            cancelButton: 'btn btn-danger ml-5 mr-5 px-3',
        },
        buttonsStyling: false,
        })

        swal.fire({
        width: '32rem',
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
        }).then((result) => {
        if (result.value) {
            event.preventDefault();
            document.getElementById('delete-form-'+id).submit();
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swal.fire(
            'Cancelled',
            'Your data is safe :)',
            'error'
            )
        }
        })
    }
    // function approvePost(id){
    //     const swal = Swal.mixin({
    //     customClass: {
    //         confirmButton: 'btn btn-success ml-5 mr-5 px-3',
    //         cancelButton: 'btn btn-danger ml-5 mr-5 px-3',
    //     },
    //     buttonsStyling: false,
    //     })

    //     swal.fire({
    //     width: '32rem',
    //     title: 'Are you sure?',
    //     text: "You want to approve this post!",
    //     icon: 'warning',
    //     showCancelButton: true,
    //     confirmButtonText: 'Yes, approve it!',
    //     cancelButtonText: 'No, cancel!',
    //     reverseButtons: true
    //     }).then((result) => {
    //     if (result.value) {
    //         event.preventDefault();
    //         document.getElementById('approval-form').submit();
    //     } else if (
    //         /* Read more about handling dismissals below */
    //         result.dismiss === Swal.DismissReason.cancel
    //     ) {
    //         swal.fire(
    //         'Cancelled',
    //         'The post remain pending',
    //         'info'
    //         )
    //     }
    //     })
    // }
</script>

<script src="https://kit.fontawesome.com/3f8ec24245.js" crossorigin="anonymous"></script>
@endpush
