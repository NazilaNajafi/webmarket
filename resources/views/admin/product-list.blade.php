@extends('layout.panel-layout')
@section('title','لیست محصول')
@section('content')
    <div class="well">
        <table class="table table-striped table-condensed table-hover">
            <tr>
                <td style="width: 30%">نام محصول</td>
                <td>گروه</td>
                <td>تاریخ انتشار</td>
                <td>عملیات</td>

            </tr>
            @foreach($products as $product)
                <tr>
                    <td>{{$product->title}}</td>
                    <td>{{$product->group->groupName}}</td>
                    <td>{{ jDate($product->created_at)->format('%d-%B-%Y') }}</td>
                    <td><a href="{{route('delete_product',['product'=>$product->id])}}">حذف</a>/
                        <a href="{{route('update_page',['product'=>$product->id])}}">ویرایش</a>/
                        <a href="{{route('addPhotos',['product'=>$product->id])}}">افزودن عکس بیشتر</a></td>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="text-center">
        {{$products->links()}}
    </div>
@stop
