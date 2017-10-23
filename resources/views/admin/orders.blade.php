@extends('layout.panel-layout')
@section('title','سفارشات')
@section('content')
    <div class="well">
        <table class="table table-striped table-condensed table-hover">
            <tr>
                <td style="width: 10%">نام کالا</td>
                <td style="width:10%">قیمت (تومان)</td>
                <td style="width: 5%">تعداد</td>
                <td style="width: 10%"> تاریخ ثبت سفارش</td>
            </tr>
            @foreach($orders as $order)
                <tr>
                    <td>{{$order->product->title}}</td>
                    <td>{{number_format($order->totalPrice)}}</td>
                    <td>{{$order->qty}}</td>
                    <td>{{ jDate($order->created_at)->format('%d-%B-%Y') }}</td>

                </tr>
            @endforeach
        </table>
    </div>
    <div class="text-center">
        {{$orders->links()}}
    </div>

@stop