@extends('layout.panel-layout')
@section('title','داشبورد')
@section('content')

    <h3>آمار سایت</h3>
    <hr>
    <div class="well">
        <table class="table table-striped table-condensed table-hover">
            <tr>
                <td>تعداد محصولات: {{$report['productsCount']}}</td>
            </tr>
            <tr>
                <td> تعداد دسته بندی ها: {{$report['categoriesCount']}}</td>
            </tr>
            <tr>
                <td> تعداد زیر دسته ها: {{$report['subCategoriesCount']}}</td>
            </tr>
            <tr>
                <td> تعداد سفارشات : {{$report['countOrders']}}</td>
            </tr>


            <tr>
                <td>درآمد کسب شده  امروز : <span>{{number_format($report['todayIncom'])}}  تومان</span> </td>
            </tr>

            <tr>
                <td>درآمد کسب شده ماهانه : <span>{{number_format($report['monthIncom'])}}تومان </span> </td>
            </tr>
        </table>
    </div>


@stop
