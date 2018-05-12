@php
  $logo = DB::table('setting_situses')->where('id','=','1')->get()->first()->logo;
@endphp
@extends('layouts.dlayout');

@section('title')
  Report
@endsection

@section('content')
  <textarea id="my-editor" name="content" class="form-control">{!! old('content', 'test editor content') !!}</textarea>
  <script src="templateEditor/ckeditor/ckeditor.js"></script>
  <script>
    var options = {
      filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
      filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
      filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
      filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
  </script>
  <script>
    CKEDITOR.replace('my-editor', options);
  </script>
@endsection
