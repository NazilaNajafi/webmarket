@extends('layout.main-layout')
@section('title','404')
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
                            <a>خطای 404</a>
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

                    <p class="container-404">
                        <img src={{asset("images/404.png")}} alt="404 Error" width="394" height="161" />
                    </p>

                    <hr/>

                    <p class="center-align size-16">
                        به نظر می آید مشکلی پیش آمده! صفحه این که به دنبال آن میگردید در اینجا نیست.
                    </p>
                    <p class="center-align size-16 push-down-50">
                        به <a href="{{route('home')}}">خانه</a> باز گردید
                    </p>


                </section> <!-- /main content -->
            </div>
        </div>
    </div> <!-- /container -->


@stop