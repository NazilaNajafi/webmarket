<!DOCTYPE html>
<!--[if lt IE 8]>
<html class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9]>
<html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ProteusThemes">
    <meta name="csrf-token" content="{{ csrf_token()}}">

    <!-- **************************** -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function () {
            $("#slider-range").slider({
                range: true,
                min: 100000,
                max: 4000000,
                values: [1500000, 3500000],
                slide: function (event, ui) {
                    start = ui.values[0];
                    end = ui.values[1];
                    $("#amount_start").val(start.toLocaleString());
                    $("#amount_end").val(end.toLocaleString());
                }
            });
        });
    </script>

    <!-- **************************** -->

    <!--  Google Fonts  -->
    <link href='http://fonts.googleapis.com/css?family=Pacifico|Open+Sans:400,700,400italic,700italic&amp;subset=latin,latin-ext,greek'
          rel='stylesheet' type='text/css'>

    <!-- Twitter Bootstrap -->
    <link href={{asset("stylesheets/bootstrap.css")}} rel="stylesheet">
    <link href={{asset("stylesheets/responsive.css")}} rel="stylesheet">
    <!-- Slider Revolution -->
    <link rel="stylesheet" href={{asset("js/rs-plugin/css/settings.css")}} type="text/css"/>
    <!-- jQuery UI -->
    <link rel="stylesheet"
          href={{asset("js/jquery-ui-1.10.3/css/smoothness/jquery-ui-1.10.3.custom.min.css")}} type="text/css"/>
    <!-- PrettyPhoto -->
    <link rel="stylesheet" href={{asset("js/prettyphoto/css/prettyPhoto.css")}} type="text/css"/>
    <!-- main styles -->

    <link href={{asset("/stylesheets/main.css")}} rel="stylesheet">
    <link rel="stylesheet" href={{asset("/css/pagination.css")}}>
    <link rel="stylesheet" href="{{asset('/css/sweetalert.css')}}">


    <!-- Modernizr -->
    <script src={{asset("/js/modernizr.custom.56918.js")}}></script>
    <script src={{asset("/js/jquery.js")}}></script>

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href={{asset("images/apple-touch/144.png")}}>
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href={{asset("images/apple-touch/114.png")}}>
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href={{asset("images/apple-touch/72.png")}}>
    <link rel="apple-touch-icon-precomposed" href={{asset("images/apple-touch/57.png")}}>
    <link rel="shortcut icon" href={{asset("images/apple-touch/57.png")}}>
    <style>
        .error {
            color: red;
        }

        .item {
            -webkit-background-size: cover;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: 50% 50%;
            height: 150px;
        }

        .itemimg {
            -webkit-background-size: cover;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: 50% 50%;
            width: 518px;
            height: 358px;
        }

        .auth {
            margin: 20px auto;
            background-color: #fafafa;
            width: 60%;
            padding: 20px 100px 20px 0px;
            border-radius: 5px;
            border: 1px solid #f5f5f5;
        }

    </style>

</head>


<body class="">

<div class="master-wrapper">

    <!--  ==========  -->
    <!--  = Header =  -->
    <!--  ==========  -->
    <header id="header">
        <div class="container">
            <div class="row">

                <!--  ==========  -->
                <!--  = Logo =  -->
                <!--  ==========  -->
                <div class="span7">
                    <a class="brand" href="{{route('home')}}">
                        <img src="{{asset("images/logo.png")}}" alt="Webmarket" Logo" width="48" height="48"/>
                        <span class="pacifico">Webmarket</span>
                    </a>
                </div>

                <!--  ==========  -->
                <!--  = Social Icons =  -->
                <!--  ==========  -->
                <div class="span5">
                    <div class="topmost-line">
                        <div class="register">
                            <ul class="nav navbar-nav navbar-right">
                                <!-- Authentication Links -->
                                @if (Auth::guest())
                                    <a href="{{ route('login') }}">ورود</a>یا
                                    <a href="{{ route('register') }}">ثبت نام</a>
                                @else
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                           aria-expanded="false">
                                            {{ Auth::user()->name }} <span class="caret"></span>
                                        </a>

                                        <ul class="dropdown-menu" role="menu" style="text-align: right;">
                                            @if(Auth::user()->admin == 1)
                                                <li>
                                                    <a href="{{ route('dashboard') }}">پنل مدیریت</a>
                                                </li>
                                            @else
                                                <li>
                                                    <a href="{{route('userPanel',Auth::id())}}">پنل کاربری</a>
                                                </li>
                                            @endif
                                            <li>
                                                <a href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                    خروچ از حساب
                                                </a>

                                                <form id="logout-form" action="/logout" method="POST"
                                                      style="display: none;">
                                                    {{ csrf_field() }}
                                                </form>
                                            </li>

                                        </ul>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div> <!-- /social icons -->
            </div>
        </div>
    </header>

    <!--  ==========  -->
    <!--  = Main Menu / navbar =  -->
    <!--  ==========  -->
    <div class="navbar navbar-static-top" id="stickyNavbar">
        <div class="navbar-inner">
            <div class="container">
                <div class="row">
                    <div class="span9">
                        <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!--  ==========  -->
                        <!--  = Menu =  -->
                        <!--  ==========  -->
                        <div class="nav-collapse collapse">
                            <ul class="nav" id="mainNavigation">
                                @foreach($groups as $group)
                                    <li class="dropdown active">
                                        <a class="dropdow-toggle"> {{$group->groupName}}
                                            <b class="caret"></b> </a>
                                        @if($group->subgroups->count())
                                            <ul class="dropdown-menu">
                                                @foreach ($group->subgroups as $subGroup)
                                                    <li class="dropdown active">
                                                        <a href="{{route('subList',[$subGroup->id])}}">
                                                            {{$subGroup->groupName}}
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            @foreach ($subGroup->products as $product)
                                                                <li>
                                                                    <a href="{{route('detail',[$product->id])}}">{{$product->title}} </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                                <li><a href="{{route('aboutUs')}}">درباره ما</a></li>
                                <li><a href="{{route('contactUs')}}">تماس با ما</a></li>
                            </ul>

                            <!--  ==========  -->
                            <!--  = Search form =  -->
                            <!--  ==========  -->

                            <form class="navbar-form pull-right" action="{{ route('search') }}" method="get" id="form">
                                <button type="submit"><span class="icon-search"></span></button>
                                <input type="text" class="span1" name="search" id="navSearchInput">
                            </form>
                        </div><!-- /.nav-collapse -->
                    </div>

                    <!--  ==========  -->
                    <div class="span3">
                        <div class="cart-container" id="cartContainer">
                            <div class="cart">
                                <p class="items">سبد خرید <span class="dark-clr">{{ $count }}</span></p>
                                <p class="dark-clr hidden-tablet"></p>
                                <a href="checkout-step-1.html" class="btn btn-danger">
                                    <i class="icon-shopping-cart"></i>
                                </a>
                            </div>
                            <div class="open-panel">
                                @if($order != Null)
                                    @foreach($order as $key => $value)
                                        <div class="item-in-cart clearfix">
                                            <div class="desc">
                                                <strong><a href="product.html">{{ $value->name }}</a></strong>
                                                <span class="light-clr qty">تعداد {{ $value->qty }}|
                                                    <a href="/delCart/{{$value->id}}/{{$key}}">حذف</a>
                                         </span>
                                            </div>
                                            <div class="price">
                                                @foreach($new as $index=>$amount)
                                                    @foreach($amount as $in=>$am)
                                                        @foreach($am as $i=>$a)
                                                            @if($in == $value->id)
                                                                {{ number_format($a) }}
                                                                @break
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endforeach

                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="summary">
                                    <div class="line">
                                        <div class="row-fluid">
                                            <div class="span6 align-right size-16"> تومان{{ number_format($sum) }}</div>
                                            <div class="span6"> جمع کل :</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="proceed">
                                    <a href="{{ route('checkoutStep1') }}"
                                       class="btn btn-danger pull-right bold higher">تسویه</a>
                                    <a href="/delAllCart" class="btn btn-danger pull-right bold higher">حذف کل
                                        سبد</a>


                                    <i class="icon-shopping-cart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /cart -->

                </div>
            </div>
        </div>
    </div> <!-- /main menu -->


    @yield('content');


    <!--  ==========  -->
    <!--  = Footer =  -->
    <!--  ==========  -->
    <footer>

        <!--  ==========  -->
        <!--  = Upper footer =  -->
        <!--  ==========  -->
        <div class="foot-light">
            <div class="container">
                <div class="row">
                    <div class="span4">
                        <h2 class="pacifico">Webmarket &nbsp; <img src="{{asset("images/webmarket.png" )}}"
                                                                   alt="WebmarketCart"
                                                                   class="align-baseline"/></h2>
                        <div class="span3">
                            <p>
                                <strong>شماره تماس :</strong> 00386 31 567 537
                                <br/>
                                <strong>فکس:</strong> 00386 31 567 538
                                <br/>
                                <strong>ایمیل:</strong> <a href="{{route('contactUs')}}">info@webmarket.com</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- /upper footer -->

        <!--  ==========  -->
        <!--  = Middle footer =  -->
        <!--  ==========  -->
        <div class="foot-dark">
            <div class="container">
                <div class="row">
                    <!--  ==========  -->
                    <!--  = Menu 1 =  -->
                    <!--  ==========  -->
                    <div class="span3">
                        <div class="main-titles lined">
                            <h3 class="title"><span class="light">پیوندها</span></h3>
                        </div>
                        <ul class="nav bold">
                            <li><a href="{{ route('home') }}">خانه</a></li>
                            <li><a href="{{ route('aboutUs') }}">درباره ما</a></li>
                            <li><a href="{{ route('contactUs') }}">تماس با ما</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div> <!-- /middle footer -->

        <!--  ==========  -->
        <!--  = Bottom Footer =  -->
        <!--  ==========  -->
        <div class="foot-last">
            <a href="#" id="toTheTop">
                <span class="icon-chevron-up"></span>
            </a>
            <div class="container">
                <div class="row">
                    <div class="span6">
                        &copy; Copyright 2013. Images of products by
                    </div>
                </div>
            </div>
        </div> <!-- /bottom footer -->
    </footer> <!-- /footer -->

</div> <!-- end of master-wrapper -->


<!--  ==========  -->
<!--  = JavaScript =  -->
<!--  ==========  -->

<!--  = FB =  -->

<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=126780447403102";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>


<!--  = jQuery - CDN with local fallback =  -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
    if (typeof jQuery == 'undefined') {
        document.write('<script src={{asset("js/jquery.js")}}><\/script>');
    }
</script>

<!--  = _ =  -->
<script src={{asset("js/underscore/underscore-min.js")}} type="text/javascript"></script>

<!--  = Bootstrap =  -->
<script src={{asset("js/bootstrap.min.js" )}} type="text/javascript"></script>

<!--  = Slider Revolution =  -->
<script src={{asset("js/rs-plugin/pluginsources/jquery.themepunch.plugins.min.js")}} type="text/javascript"></script>
<script src={{asset("js/rs-plugin/js/jquery.themepunch.revolution.min.js")}} type="text/javascript"></script>

<!--  = CarouFredSel =  -->
<script src={{asset("js/jquery.carouFredSel-6.2.1-packed.js")}} type="text/javascript"></script>

<!--  = jQuery UI =  -->
<script src={{asset("js/jquery-ui-1.10.3/js/jquery-ui-1.10.3.custom.min.js")}} type="text/javascript"></script>
<script src={{asset("js/jquery-ui-1.10.3/touch-fix.min.js")}} type="text/javascript"></script>

<!--  = Isotope =  -->
<script src={{asset("js/isotope/jquery.isotope.min.js")}} type="text/javascript"></script>

<!--  = Tour =  -->
<script src={{asset("js/bootstrap-tour/build/js/bootstrap-tour.min.js")}} type="text/javascript"></script>

<!--  = PrettyPhoto =  -->
<script src={{asset("js/prettyphoto/js/jquery.prettyPhoto.js")}} type="text/javascript"></script>

<!--  = Google Maps API =  -->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src={{asset("js/goMap/js/jquery.gomap-1.3.2.min.js")}}></script>

<!--  = Custom JS =  -->
<script src={{asset("js/custom.js")}} type="text/javascript"></script>

<script src="{{asset('/js/sweetalert.js')}}"></script>
@include('flash')

</body>
</html>


