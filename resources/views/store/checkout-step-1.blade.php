@extends('layout.checkout-layout')
@section('title','بازبینی سبد خرید')
@section('content')


    <div class="container">
        <div class="row">

            <!--  ==========  -->
            <!--  = Main content =  -->
            <!--  ==========  -->
            <section class="span12">

                <div class="checkout-container">
                    <div class="row">
                        <div class="span10 offset1">

                            <!--  ==========  -->
                            <!--  = Header =  -->
                            <!--  ==========  -->
                            <header>
                                <div class="row">
                                    <div class="span2">
                                        <img src="{{asset("images/logo-bw.png")}}" alt="Webmarket Logo"
                                                                  width="48" height="48"/>
                                    </div>
                                    <div class="span6">
                                        <div class="center-align">
                                            <h1><span class="light">بازبینی</span> سبد خرید</h1>
                                        </div>
                                    </div>
                                    <div class="span2">
                                        <div class="right-align">
                                            <img src="{{asset("images/buttons/security.jpg" )}}"alt="Security Sign" width="92"
                                                 height="65"/>
                                        </div>
                                    </div>
                                </div>
                            </header>

                            <!--  ==========  -->
                            <!--  = Steps =  -->
                            <!--  ==========  -->
                            <div class="checkout-steps">
                                <div class="clearfix">
                                    <div class="step active">
                                        <div class="step-badge">1</div>
                                        سبد خرید
                                    </div>
                                    <div class="step">
                                        <div class="step-badge">2</div>
                                        آدرس ارسال
                                    </div>
                                    <div class="step">
                                        <div class="step-badge">3</div>
                                        بازبینی اطلاعات
                                    </div>
                                    <div class="step">
                                        <div class="step-badge">4</div>
                                        تایید و پرداخت
                                    </div>
                                </div>
                            </div> <!-- /steps -->
                            <!--  ==========  -->
                            <!--  = Selected Items =  -->
                            <!--  ==========  -->
                            <table class="table table-items">
                                <thead>
                                <tr>
                                    <th colspan="2">آیتم</th>
                                    <th>
                                        <div class="align-center">تعداد</div>
                                    </th>
                                    <th>
                                        <div class="align-right">قیمت</div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($order != Null)
                                    @foreach($order as $key => $value)
                                        <tr>
                                            <td class="desc">{{ $value->name }}&nbsp;
                                                <a href="/delCart/{{$value->id}}/{{$key}}">|حذف</a>

                                            <td class="qty">
                                                {{$value->qty}}
                                            </td>
                                            <td class="price">
                                                @foreach($new as $index=>$amount)
                                                    @foreach($amount as $in=>$am)
                                                        @foreach($am as $i=>$a)
                                                            @if($in == $value->id)
                                                                {{number_format($a) }}تومان
                                                                @break
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                                <tr>
                                    <td class="stronger">جمع کل :</td>
                                    <td class="stronger">
                                        <div class="size-16 align-right"> {{number_format($sum) }} تومان</div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <hr/>

                            <p class="right-align">
                                مرحله بعدی
                                @if(\Auth::user())
                                    <a href="{{route('checkoutStep2')}}" class="btn btn-primary higher bold">ادامه</a>
                                @else
                                    <a href="{{route('home')}}" class="btn btn-primary higher bold">برای تکمیل خرید و
                                        پرداخت
                                        باید پس از عضویت وارد سایت شوید.</a>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>


            </section> <!-- /main content -->

        </div>
    </div> <!-- /container -->



