@extends('layout.panel-layout')
@section('title','نظرات')
@section('content')
    <div class="well">
        <table class="table table-striped table-condensed table-hover">
            <tr>
                <td style="width: 20%">نام کالا</td>
                <td style="width: 50%">نظر</td>
                <td style="width: 15%"> تاریخ</td>
                <td style="width: 15%">عملیات</td>
            </tr>
            @foreach($comments as $comment)
                <tr>
                    <td>{{$comment->product->title}}</td>
                    <td>{{$comment->body}}</td>
                    <td>{{ jDate($comment->created_at)->format('%d-%B-%Y') }}</td>
                    <td><a href="{{route('delete_comment',['comment'=>$comment->id])}}">حذف</a>|
                        @if(($comment->status)=='0')
                            <a href="{{route('check_comment',['comment'=>$comment->id])}}">تائید</a>
                        @else
                            <a href="{{route('check_comment',['comment'=>$comment->id])}}">لغو تائید</a>
                        @endif
                    </td>
                </tr>
            @endforeach


        </table>
    </div>
    <div class="text-center">
        {{$comments->links()}}
    </div>

@stop