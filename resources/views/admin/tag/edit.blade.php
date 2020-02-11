@extends('layout.backend.main')


@section('title','Edit - Tag')


@push('css')

@endpush


@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        EDIT TAG - {{$tag->name}}
                    </h2>
                </div>
                <div class="body">
                    <form action="{{route('admin.tag.update',$tag->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="name" name="name" class="form-control" value="{{$tag->name}}"
                                    autofocus autocomplete="off">
                                <label class="form-label" for="name">Tag Name</label>
                            </div>
                        </div>

                        <a href="{{route('admin.tag.index')}}" class="btn btn-danger m-t-15 waves-effect">Back</a>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect" autofocus>Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('js')

@endpush
