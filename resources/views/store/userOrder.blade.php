@extends('layout.main-layout')
@section('title','سفارشات کاربر')
@section('content')
    <!--  ==========  -->
    <!--  = Breadcrumbs =  -->
    <!--  ==========  -->
    <div class="darker-stripe">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <ul class="breadcrumb">
                        <li>
                            <a href="">وبمارکت</a>
                        </li>
                        <li><span class="icon-chevron-right"></span></li>
                        <li>
                            <a>سفارشات کاربر</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="push-up blocks-spacer">
            <div class="row">

                <!--  ==========  -->
                <!--  = Main content =  -->
                <!--  ==========  -->
                <section class="span12">

                    <!--  ==========  -->
                    <!--  = Title =  -->
                    <!--  ==========  -->
                    <div class="underlined push-down-20">
                        <h3><span class="light">همه</span> امکانات</h3>
                    </div> <!-- /title -->

                    <!--  ==========  -->
                    <!--  = Tables =  -->
                    <!--  ==========  -->
                    <section id="tables">

                        <!--  ==========  -->
                        <!--  = Classes for tables:
                             =  -->
                        <!--  ==========  -->

                        <table class="table table-theme table-striped">
                            <thead>
                            <tr>
                                <th>نام کالا</th>
                                <th>تاریخ سفارش</th>
                                <th>تعداد</th>
                                <th>قیمت (تومان)</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $key=>$value)

                                <tr>
                                    <td>{{$value->product->title}}</td>
                                    <td>{{ jDate($value->created_at)->format('datetime') }}</td>
                                    <td>{{$value->qty}}</td>
                                    <td>{{$value->totalPrice}}</td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </section>

                    <hr/>

                </section> <!-- /main content -->
            </div>
        </div>
        <div class="text-center">
            {{$orders->links()}}
        </div>
    </div>

    </div> <!-- /container -->



@stop