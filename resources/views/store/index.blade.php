@extends('layout.main-layout')
@section('title','وبمارکت')
@section('content')
    <!--  ==========  -->
    <!--  = Slider Revolution =  -->
    <!--  ==========  -->
    <div class="fullwidthbanner-container">
        <div class="fullwidthbanner">
            <ul>
                <li data-transition="premium-random" data-slotamount="3">
                    <img src="{{asset("images/dummy/slides/1/slide.jpg")}}" alt="slider img" width="1400" height="377"/>

                    <!-- texts -->
                    <div class="caption lfl big_theme"
                         data-x="120"
                         data-y="120"
                         data-speed="1000"
                         data-start="500"
                         data-easing="easeInOutBack">
                        با وبمارکت، هیچ محدودیتی ندارید
                    </div>

                    <div class="caption lfl small_theme"
                         data-x="120"
                         data-y="190"
                         data-speed="1000"
                         data-start="700"
                         data-easing="easeInOutBack">

                        خرید آسان
                    </div>


                </li><!-- /slide -->

                <li data-transition="premium-random" data-slotamount="3">
                    <img src="{{asset("images/dummy/slides/2/slide.jpg")}}" alt="slider img" width="1400" height="377"/>

                    <!-- texts -->


                    <a href="features.html" class="caption lfl btn btn-primary btn_theme"
                       data-x="120"
                       data-y="260"
                       data-speed="1000"
                       data-start="900"
                       data-easing="easeInOutBack">
                       خرید کالای دیجیتال
                    </a>
                </li><!-- /slide -->


                <li data-transition="premium-random" data-slotamount="3">
                    <img src={{asset("images/dummy/slides/4/slide.jpg")}} alt="slider img" width="1400" height="377"/>

                    <!-- texts -->
                    <div class="caption lfl big_theme"
                         data-x="120"
                         data-y="140"
                         data-speed="1000"
                         data-start="500"
                         data-easing="easeInOutBack">
                        بیش از 1000 مشتری خشنود
                    </div>

                    <div class="caption lfl small_theme"
                         data-x="120"
                         data-y="210"
                         data-speed="1000"
                         data-start="700"
                         data-easing="easeInOutBack">
                        به خوبی شما را پشتیبانی میکنیم

                    </div>
                </li><!-- /slide -->
            </ul>
            <div class="tp-bannertimer"></div>
        </div>
        <!--  ==========  -->
        <!--  = Nav Arrows =  -->
        <!--  ==========  -->
        <div id="sliderRevLeft"><i class="icon-chevron-left"></i></div>
        <div id="sliderRevRight"><i class="icon-chevron-right"></i></div>
    </div> <!-- /slider revolution -->

    <!--  ==========  -->
    <!--  = Main container =  -->
    <!--  ==========  -->
    <div class="container">
        <!--  ==========  -->
        <!--  = Featured Items =  -->
        <!--  ==========  -->
        <div class="row featured-items blocks-spacer">
            <div class="span12">

                <!--  ==========  -->
                <!--  = Title =  -->
                <!--  ==========  -->
                <div class="main-titles lined">
                    <br>
                    <h2 class="title"><span class="light">فروش</span> ویژه</h2>
                    <div class="arrows">
                        <a href="#" class="icon-chevron-right" id="featuredItemsRight"></a>
                        <a href="#" class="icon-chevron-left" id="featuredItemsLeft"></a>
                    </div>
                </div>
            </div>

            <div class="span12"><!--  ==========  -->
                <!--  = Carousel =  -->
                <!--  ==========  -->
                <div class="carouFredSel" data-autoplay="false" data-nav="featuredItems">
                    <div class="slide">
                        <div class="row">
                            <!--  ==========  -->
                            <!--  = Product =  -->
                            <!--  ==========  -->
                            @foreach($specialSalesUp as $specialSaleUp)
                                <div class="span4">
                                    <div class="product">
                                        <div class="product-img featured">
                                            <div class="picture">
                                                <img class="itemimg"
                                                     src={{$specialSaleUp->photo}} alt=""
                                                />
                                                <div class="img-overlay">
                                                    <a href="/detail/{{$specialSaleUp->id}}"
                                                       class="btn more btn-primary">توضیحات بیشتر</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="main-titles">
                                            @if($specialSaleUp->discount->discountPercent !=0)
                                                <h4 class="title"><span class="striked">{{number_format($specialSaleUp->price)}}
                                                        تومان</span> <span
                                                            class="red-clr">{{number_format(($specialSaleUp->price)-(($specialSaleUp->price)*($specialSaleUp->discount->discountPercent)/100))}}
                                                        تومان</span></h4>
                                            @else
                                                <h4 id="title" class="title">{{number_format($specialSaleUp->price )}}تومان</h4>

                                            @endif
                                            <h5 class="no-margin">{{ $specialSaleUp->title }}</h5>
                                        </div>
                                        <p>{{str_limit($specialSaleUp->detail, $limit = 20, $end = '...')}}</p>
                                    </div>
                                </div>
                        @endforeach
                        <!-- /product -->
                        </div>
                    </div>

                    <div class="slide">
                        <div class="row">
                            <!--  ==========  -->
                            <!--  = Product =  -->
                            <!--  ==========  -->
                            @foreach($specialSalesDown as $specialSaleDown)
                                <div class="span4">
                                    <div class="product">
                                        <div class="product-img featured">
                                            <div class="picture">
                                                <img class="itemimg" src={{$specialSaleDown->photo}} alt=""
                                                />
                                                <div class="img-overlay">
                                                    <a href="/detail/{{$specialSaleDown->id}}"
                                                       class="btn more btn-primary">توضیحات بیشتر</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="main-titles">
                                            @if($specialSaleDown->discount->discountPercent !=0)
                                                <h4 class="title"><span class="striked">{{number_format($specialSaleDown->price)}}
                                                        تومان</span> <span
                                                            class="red-clr">{{number_format(($specialSaleDown->price)-(($specialSaleDown->price)*($specialSaleDown->discount->discountPercent)/100))}}
                                                        تومان</span></h4>
                                            @else
                                                <h4 id="title" class="title">{{number_format($specialSaleDown->price)}}تومان</h4>

                                            @endif

                                            <h5 class="no-margin">{{ $specialSaleDown->title }}</h5>
                                        </div>
                                        <p>{{str_limit($specialSaleDown->detail, $limit = 20, $end = '...')}}</p>
                                    </div>
                                </div>
                        @endforeach
                        <!-- /product -->
                        </div>
                    </div>

                </div> <!-- /carousel -->
            </div>

        </div>
    </div> <!-- /container -->

    <!--  ==========  -->
    <!--  = New Products =  -->
    <!--  ==========  -->
    <div class="boxed-area blocks-spacer">
        <div class="container">

            <!--  ==========  -->
            <!--  = Title =  -->
            <!--  ==========  -->
            <div class="row">
                <div class="span12">
                    <div class="main-titles lined">
                        <h2 class="title"><span class="light">محصولات</span> جدید فروشگاه</h2>
                    </div>
                </div>
            </div> <!-- /title -->

            <div class="row popup-products blocks-spacer">
                <!--  ==========  -->
                <!--  = Product =  -->
                <!--  ==========  -->
                @foreach($newProducts as $newProduct)
                    <div class="span3">
                        <div class="product">
                            <div class="product-img">
                                <div class="picture">
                                    <img class="itemimg" src="{{$newProduct->photo}}" alt=""/>
                                    <div class="img-overlay">
                                        <a href="/detail/{{$newProduct->id}}" class="btn more btn-primary">توضیحات
                                            بیشتر</a>
                                    </div>
                                </div>
                            </div>
                            <div class="main-titles no-margin">
                                @if($newProduct->discount->discountPercent !=0)
                                    <h4 class="title"><span class="striked">{{number_format($newProduct->price)}} تومان</span>
                                        <span
                                                class="red-clr">{{number_format(($newProduct->price)-(($newProduct->price)*($newProduct->discount->discountPercent)/100))}}
                                            تومان</span></h4>
                                @else
                                    <h4 id="title" class="title">{{number_format($newProduct->price) }}تومان</h4>

                                @endif
                                <h5 class="no-margin">{{ $newProduct->title }}</h5>
                            </div>
                            <p>{{str_limit($newProduct->detail, $limit = 20, $end = '...')}}</p>
                        </div>
                    </div>
            @endforeach
            <!-- /product -->
            </div>
        </div>
    </div> <!-- /new products -->

    <!--  ==========  -->
    <!--  = Most Popular products =  -->
    <!--  ==========  -->
    <div class="most-popular blocks-spacer">
        <div class="container">

            <!--  ==========  -->
            <!--  = Title =  -->
            <!--  ==========  -->
            <div class="row">
                <div class="span12">
                    <div class="main-titles lined">
                        <h2 class="title"><span class="light">محبوبترین</span>محصولات فروشگاه</h2>
                    </div>
                </div>
            </div> <!-- /title -->

            <div class="row popup-products">


                <!--  ==========  -->
                <!--  = Product =  -->
                <!--  ==========  -->
                @foreach($favProducts as $favProduct)

                        <div class="span3">
                            <div class="product">
                                <div class="product-img">
                                    <div class="picture">
                                        <img class="itemimg" src={{$favProduct->photo}} alt=""
                                        />
                                        <div class="img-overlay">
                                            <a href="/detail/{{$favProduct->id}}" class="btn more btn-primary">توضیحات
                                                بیشتر</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-titles no-margin">
                                    @if($favProduct->discount->discountPercent !=0)
                                        <h4 class="title"><span class="striked">{{number_format($favProduct->price)}} تومان</span>
                                            <span
                                                    class="red-clr">{{number_format(($favProduct->price)-(($favProduct->price)*($favProduct->discount->discountPercent)/100))}}
                                                تومان</span></h4>
                                    @else
                                        <h4 id="title" class="title">{{number_format( $favProduct->price) }}تومان</h4>

                                    @endif
                                    <h5 class="no-margin">{{$favProduct->title}}</h5>
                                </div>
                                <p>{{str_limit($favProduct->detail, $limit = 20, $end = '...')}}</p>
                            </div>
                        </div>
                @endforeach

            </div>
        </div>
    </div> <!-- /most popular -->



@stop