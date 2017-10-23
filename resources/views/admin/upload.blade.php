@extends('layout.panel-layout')
@section('title','آپلود تصویر')
@section('content')

    <h2>ارسال و آپلود تصویر جدید</h2>
    @if ($product->images->count() < 3)
        <form class="dropzone"
              id="addPhotosForm"
              action="{{route('addPhotos',[$product->id])}}"
              method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
        </form>
    @else
        <h4>حداکثر فایل مجاز انتخاب گردید.</h4>
    @endif

    <br>
<div class="well">
    <table class="table table-striped table-condensed table-hover">
        <tr>
            <td>تصویر</td>
            <td>عملیات</td>

        </tr>
        @foreach($product->images as $image)
        <tr>
            <td><img class="th" src="{{$image->imageUrl}}" width="50" height="40"/>
            <td><a href="">حذف</a>
            </td>
        </tr>
            @endforeach
    </table>
</div>


@stop

