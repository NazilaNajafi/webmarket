@extends('layout.checkout-layout')
@section('title','آدرس ارسال')
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
                                        <a href="index.html"><img src="{{asset('images/logo-bw.png')}}" alt="Webmarket Logo" width="48" height="48" /></a>

                                    </div>
                                    <div class="span6">
                                        <div class="center-align">
                                            <h1><span class="light">آدرس ارسال</span> </h1>
                                        </div>
                                    </div>
                                    <div class="span2">
                                        <div class="right-align">
                                            <img src={{asset("images/buttons/security.jpg")}} alt="Security Sign" width="92" height="65" />

                                        </div>
                                    </div>
                                </div>
                            </header>

                            <!--  ==========  -->
                            <!--  = Steps =  -->
                            <!--  ==========  -->
                            <div class="checkout-steps">
                                <div class="clearfix">
                                    <div class="step done">
                                        <div class="step-badge"><i class="icon-ok"></i></div>سبد خرید
                                    </div>
                                    <div class="step active">
                                        <div class="step-badge">2</div>
                                        آدرس ارسال
                                    </div>
                                    <div class="step">
                                        <div class="step-badge">2</div>
                                        بازبینی اطلاعات
                                    </div>
                                    <div class="step">
                                        <div class="step-badge">4</div>
                                        تایید و پرداخت
                                    </div>
                                </div>
                            </div> <!-- /steps -->

                            <!--  ==========  -->
                            <!--  = Shipping addr form =  -->
                            <!--  ==========  -->

                            <form action="{{route('create_buyer')}}" method="post"
                                  class="form-horizontal form-checkout">
                                {{csrf_field()}}
                                <div class="control-group">
                                    <label class="control-label" for="telephone">تلفن ثابت<span
                                                class="red-clr bold">*</span></label>
                                    <div class="controls">
                                        <input type="tel" id="telephone" name="phone" class="span4"
                                               value="{{$buyer!=''? $buyer->phone :""}}"
                                               required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="telephone">تلفن همراه<span
                                                class="red-clr bold">*</span></label>
                                    <div class="controls">
                                        <input type="tel" id="cellphone" name="cellphone" class="span4"
                                               value="{{$buyer!=''? $buyer->cellphone :""}}"
                                               required>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="city">شهر<span
                                                class="red-clr bold">*</span></label>
                                    <div class="controls">
                                        <input type="text" id="city" name="city" class="span4"
                                               value="{{$buyer!=''? $buyer->city :""}}"
                                               required>
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label" for="addr1">ادرس <span
                                                class="red-clr bold">*</span></label>
                                    <div class="controls">
                                        <input type="text" id="addr1" name="address" class="span4"
                                               value="{{$buyer!=''? $buyer->address :""}}"
                                               required>
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label" for="addr1">
                                        در مرحله بعدی شما شیوه پرداخت را انتخاب میکنید
                                    </label>
                                    <div class="controls">
                                        <input type="submit" name="submit" value="ادامه" class="btn btn-primary">
                                    </div>
                                </div>


                            </form>

                            <hr/>


                        </div>
                    </div>
                </div>


            </section> <!-- /main content -->

        </div>
    </div> <!-- /container -->

@stop
