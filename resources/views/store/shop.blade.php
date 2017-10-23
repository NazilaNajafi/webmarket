@extends('layout.main-layout')
@section('title','لیست محصولات')
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
                            <a href="{{route('home')}}">فروشگاه</a>
                        </li>
                        <li><span class="icon-chevron-right"></span></li>
                        <li>
                            <a>{{$group}}</a>
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
                <!--  = Sidebar =  -->
                <!--  ==========  -->
                <aside class="span3 left-sidebar" id="tourStep1">
                    <div class="sidebar-item sidebar-filters" id="sidebarFilters">

                        <!--  ==========  -->
                        <!--  = Sidebar Title =  -->
                        <!--  ==========  -->
                        <div class="underlined">
                            <h3><span class="light">بر اساس فیلتر</span> خرید کنید</h3>
                        </div>

                        <!--  ==========  -->
                        <!--  = Prices slider =  -->
                        <!--  ==========  -->
                        <div class="accordion-group">
                            <label for="amount">قیمت</label>
                            <div id="slider-range" style="width: 250px;"></div>
                        <br>
                            <input type="text" id="amount_start" class="max-val pull-right" value="<?php echo (number_format(1500000)); ?>" >
                            <input type="text" id="amount_end"  class="min-val" value="<?php echo (number_format(3500000)); ?>">
                            </br>
                            <button onclick="send()" class="btn btn-primary">فیلتر</button>

                        </div> <!-- /prices slider -->

                    </div>
                </aside> <!-- /sidebar -->

                <!--  ==========  -->
                <!--  = Main content =  -->
                <!--  ==========  -->
                <section class="span9">

                    <!--  ==========  -->
                    <!--  = Title =  -->
                    <!--  ==========  -->
                    <div class="underlined push-down-20">
                        <div class="row">
                            <div class="span5">
                                <h3><span class="light">همه</span> محصولات</h3>
                            </div>
                            <div class="span4">
                                <div class="form-inline sorting-by" id="tourStep4">
                                    <label for="isotopeSorting" class="black-clr">چینش :</label>
                                    <select id="isotopeSorting" class="span3">
                                        <option value='{"sortBy":"price", "sortAscending":"true"}'>بر اساس قیمت (کم به
                                            زیاد) &uarr;
                                        </option>
                                        <option value='{"sortBy":"price", "sortAscending":"false"}'>بر اساس قیمت (زیاد
                                            به کم) &darr;
                                        </option>
                                        <option value='{"sortBy":"name", "sortAscending":"true"}'>بر اساس نام (صعودی)
                                            &uarr;
                                        </option>
                                        <option value='{"sortBy":"name", "sortAscending":"false"}'>بر اساس نام (نزولی)
                                            &darr;
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /title -->

                <!--  ==========  -->
                    <!--  = Products =  -->
                    <!--  ==========  -->
                    <div class="row popup-products" id="updateDiv" >
                        <div id="isotopeContainer" class="isotope-container" >
                            <!--  ==========  -->
                            <!--  = Single Product =  -->
                            <!--  ==========  -->
                            @foreach($products as $product)
                                <div class="span3 filter--accessories" data-price="738" data-popularity="4"
                                     data-size="l|xl" data-color="red" data-brand="adidas">
                                    <div class="product">

                                        <div class="product-img">
                                            <div class="picture">
                                                <img class="itemimg" alt="" src="{{$product->photo}}"/>
                                                <div class="img-overlay">
                                                    <a class="btn more btn-primary"
                                                       href="{{route('detail',[$product->id])}}">توضیحات بیشتر</a>
                                                    @if($product->quantity!=0)
                                                        <a href="{{route('subList',[$product->group_id,$product->id])}}"
                                                           class="btn buy btn-danger">افزودن به سبد</a>

                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="main-titles no-margin">
                                            @if($product->discount->discountPercent !=0)
                                                <h4 class="title"><span class="striked">{{number_format($product->price)}}
                                                        تومان</span>
                                                    <span
                                                            class="red-clr">{{number_format(($product->price)-(($product->price)*($product->discount->discountPercent)/100))}}
                                                        تومان</span></h4>
                                            @else
                                                <h4 id="title" class="title">{{number_format($product->price )}}تومان</h4>

                                            @endif
                                            <h5 class="no-margin isotope--title">{{$product->title}}</h5>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                        <!-- /single product -->
                            <input id="group" type="hidden" value="{{$product->group_id}}">


                        </div>
                    </div>
                    <hr/>
                    <div class="text-center">
                        {{$products->links()}}
                    </div>

                </section> <!-- /main content -->
            </div>
        </div>
    </div> <!-- /container -->

    <script>
        function send() {
            var start = $('#amount_start').val();
            var end = $('#amount_end').val();
            var groupId=$('#group').val();
            $.ajax({
                type: 'get',
                url:"{{ route('subList') }}",
                data:{start:start,end:end,groupId:groupId},
                success: function (response) {
                    console.log(response)
                    $('#updateDiv').html(response);
                }

            });


        }
    </script>
@stop