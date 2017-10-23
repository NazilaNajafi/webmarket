@extends('layout.main-layout')
@section('title','تماس با ما')
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
                            <a>وبمارکت</a>
                        </li>
                        <li><span class="icon-chevron-right"></span></li>
                        <li>
                            <a>Contact Us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="push-up top-equal blocks-spacer-last">
            <div class="row">
                
                <!--  ==========  -->
                <!--  = Main Title =  -->
                <!--  ==========  -->
                
                <div class="span12">
                    <div class="title-area">
                        <h1 class="inline"><span class="light">تماس با ما</span> </h1>
                    </div>
                </div>
                
                <!--  ==========  -->
                <!--  = Main content =  -->
                <!--  ==========  -->
                <section class="span8 single single-page">

                    <!--  ==========  -->
                    <!--  = Contact Form =  -->
                    <!--  ==========  -->
                    <section class="contact-form-container">
                        
                        <h3 class="push-down-25"><span class="light">ارسال</span> پیام</h3>
                        <div class="abstract">
                            <form method="post" action="{{route('contactUs')}}">
                                {{csrf_field()}}
                                <div class="control-group push-down-20">

                                <input class="form-control rtl" type="text" name="name" placeholder="نام شما" required/>
                                    @if ($errors->has('name'))
                                        <span class="help-block error">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif

                                </div>
                                <div class="control-group push-down-20">

                                <input class="form-control rtl" type="text" name="email" placeholder="ایمیل شما" required/>
                                    @if ($errors->has('email'))
                                        <span class="help-block error">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif

                                </div>
                                <div class="control-group push-down-20">
                                    <textarea class="input-block-level" tabindex="4" rows="7" cols="70" id="message" name="message" placeholder="متن پیام شما ..." required></textarea>
                                    @if ($errors->has('message'))
                                        <span class="help-block error">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                    @endif

                                </div>
                                <p>
                                    <input type="hidden" value="1" name="submit" />
                                    <button class="btn btn-primary bold" name="sendMail" tabindex="5" id="submit">ارسال</button>
                                </p>
                            </form>
                        </div>

                    </section>

                </section> <!-- /main content -->

            </div>
        </div>
    </div> <!-- /container -->

@stop
    
    