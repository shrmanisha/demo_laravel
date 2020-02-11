@extends('layout.backend.main')


@section('title','Create - Post')


@push('css')
{{-- select plugin --}}
<link href="{{asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />
@endpush


@section('content')
<div class="container-fluid">
    <form action="{{route('admin.post.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            ADD NEW POST
                        </h2>
                    </div>
                    <div class="body">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" id="title" name="title" class="form-control" value="{{old('title')}}"
                                    autofocus autocomplete="off">
                                <label class="form-label" for="title">Enter title here</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="image">Featured Image</label>
                            <input type="file" name="image" id="image" autofocus value="{{old('image')}}">
                        </div>

                        <div class="form-group">
                            <input type="checkbox" name="status" id="publish" class="filled-in" value="1">
                            <label for="publish">Publish</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            CATEGORIES and TAGS
                        </h2>
                    </div>
                    <div class="body">
                        <div class="form-group form-float">
                            <div class="form-line {{$errors->has('categories') ? 'focused error' : ''}}">
                                <label for="category">Select Categories</label>
                                <select class="form-control show-tick" id="category" name="categories[]" multiple
                                    data-live-search="true">
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line {{$errors->has('tags') ? 'focused error' : ''}}">
                                <label for="tag">Select Tags</label>
                                <select class="form-control show-tick" id="tag" name="tags[]" multiple
                                    data-live-search="true">
                                    @foreach ($tags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <a href="{{route('admin.post.index')}}"
                            class="btn btn-danger m-t-15 waves-effect btn-lg">Back</a>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect btn-lg"
                            autofocus>Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            BODY
                        </h2>
                    </div>
                    <div class="body">
                        <textarea id="ckeditor" name="body">
                            {{old('body')}}
                        </textarea>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection


@push('js')
{{-- select plugin --}}
<script src="{{asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>
<!-- Ckeditor -->
<script src="{{asset('assets/backend/plugins/ckeditor/ckeditor.js')}}"></script>

{{-- <script src="{{asset('assets/backend/js/pages/forms/editors.js')}}"></script> --}}
<script>
    $(function () {
    //CKEditor
    CKEDITOR.replace('ckeditor');
    CKEDITOR.config.height = 300;
    CKEDITOR.on('dialogDefinition', function (ev) {
        var dialogName = ev.data.name,
            dialogDefinition = ev.data.definition;

        if (dialogName == 'image') {
            var onOk = dialogDefinition.onOk;

            dialogDefinition.onOk = function (e) {
                var width = this.getContentElement('info', 'txtWidth');
                width.setValue('100%');//Set Default Width

                var height = this.getContentElement('info', 'txtHeight');
                height.setValue('auto');//Set Default height

                onOk && onOk.apply(this, e);
            };
        }
        });
});
</script>
@endpush
