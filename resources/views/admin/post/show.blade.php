@extends('layout.backend.main')


@section('title',$post->title)


@push('css')
@endpush


@section('content')
<div class="container-fluid">
    <a href="{{route('admin.post.index')}}" class="btn btn-danger waves-effect">Back</a>
    @if ($post->is_approved == false)
    <button type="button" class="btn btn-success waves-effect pull-right" onclick="approvePost({{$post->id}})">
        <i class="material-icons">done</i>
        <span>Approve</span>
    </button>
    <form action="{{route('admin.post.approve',$post->id)}}" id="approval-form" style="display:none;" method="POST">
        @csrf
        @method('PUT')
    </form>
    @else
    <button type="button" class="btn btn-success pull-right" disabled>
        <i class="material-icons">done</i>
        <span>Approved</span>
    </button>
    @endif
    <div class="row clearfix">
        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{$post->title}}
                        <small>Posted By <strong><a href="">{{$post->user->name}}</a></strong> on
                            {{$post->created_at->toFormattedDateString()}}</small>
                    </h2>
                </div>
                <div class="body" style="width:100%;">
                    {!!$post->body!!}
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-cyan">
                    <h2>
                        Categories
                    </h2>
                </div>
                <div class="body">
                    @foreach ($post->categories as $category)
                    <span class="label bg-cyan">{{$category->name}}</span>
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="header bg-green">
                    <h2>
                        Tags
                    </h2>
                </div>
                <div class="body">
                    @foreach ($post->tags as $tag)
                    <span class="label bg-green">{{$tag->name}}</span>
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="header bg-amber">
                    <h2>
                        Featured Image
                    </h2>
                </div>
                <div class="body">
                    {{-- <img class="img-responsive thumbnail" src="{{Storage::disk('public')->url('post/'.$post->image)}}"
                    alt="{{$post->image}}"> --}}
                    <img class="img-responsive thumbnail" src="{{URL::asset('storage/post/'.$post->image)}}"
                        alt="{{$post->image}}">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    function approvePost(id){
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
        text: "You want to approve this post!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, approve it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
        }).then((result) => {
        if (result.value) {
            event.preventDefault();
            document.getElementById('approval-form').submit();
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swal.fire(
            'Cancelled',
            'The post remain pending',
            'info'
            )
        }
        })
    }
</script>
@endpush
