@extends('layout.main-layout')
@section('title','جستجو')
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
                            <a> {{$key}}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="push-up">
            <div class="row">

                <!--  ==========  -->
                <!--  = Sidebar =  -->
                <!--  ==========  -->
                <aside class="span3 left-sidebar">
                    <div class="sidebar-item sidebar-filters" id="sidebarFilters">

                        <!--  ==========  -->
                        <!--  = Sidebar Title =  -->
                        <!--  ==========  -->
                        <div class="underlined">
                            <h3><span class="light"></span> فیلتر کنید</h3>
                        </div>

                        <!--  ==========  -->
                        <!--  = Categories =  -->
                        <!--  ==========  -->
                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a class="accordion-toggle" data-toggle="collapse" href="#filterOne">دسته بندی ها <b class="caret"></b></a>
                            </div>

                            @foreach($categories as $category)
                                <li style="padding-left: 150px" class="brandId"><input type="checkbox" id="brandId" value="{{$category->id}}" class="try">
                                    <a href=""><span class="pull-right">({{ App\Product::where('group_id' ,$category->id )->count() }})</span><b>{{$category->groupName}}</b></a></li>
                            @endforeach


                        </div>
                </aside> <!-- /sidebar -->

            <!--  ==========  -->
                <!--  = Main content =  -->
                <!--  ==========  -->
                <section class="span9 blocks-spacer">

                    <!--  ==========  -->
                    <!--  = Title =  -->
                    <!--  ==========  -->
                    <div class="underlined push-down-20">
                        <div class="row">
                            <div class="span5">
                                <h3><span class="light">جستجو:</span> &quot;{{$key}}&quot;</h3>
                            </div>
                            <div class="span4">
                                <div class="form-inline sorting-by">

                                    <label for="isotopeSorting" class="black-clr">چینش:</label>
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
                                        (زیاد به کم) &darr;
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /title -->
                    <div class="result">

                    </div>

                    <!--  ==========  -->
                    <!--  = Products =  -->
                    <!--  ==========  -->
                    <div class="row popup-products" id="updateDiv">
                        <div id="isotopeContainer" class="isotope-container">

                            <!--  ==========  -->
                                <!--  = Single Product =  -->
                                <!--  ==========  -->
                                @foreach($products as $product)
                                    <div class="span3 filter--sunglasses" data-price="591" data-popularity="5"
                                         data-size="xs|s|l|xxl" data-color="purple|orange" data-brand="adidas">
                                        <div class="product">
                                            <div class="product-img">
                                                <div class="picture">
                                                    <img class="itemimg" alt="" src={{$product->photo}} />
                                                    <div class="img-overlay">
                                                        <a class="btn more btn-primary"
                                                           href="/detail/{{$product->id}}">توضیحات
                                                            بیشتر</a>

                                                        @if ($product->quantity != 0)
                                                            <a class="btn buy btn-danger"
                                                               href="/search/{{$product->id}}">اضافه
                                                                به سبد خرید</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="main-titles no-margin">
                                                @if($product->discount->discountPercent !=0)
                                                    <h4 class="title"><span class="striked">{{number_format($product->price)}}
                                                            تومان</span> <span
                                                                class="red-clr">{{number_format(($product->price)-(($product->price)*($product->discount->discountPercent)/100))}}
                                                            تومان</span></h4>

                                                @else
                                                    <h4 id="title" class="title">{{number_format($product->price) }}
                                                        تومان</h4>
                                                @endif
                                                <h5 class="no-margin isotope--title">{{ $product->title }}</h5>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            <!-- /single product -->
                        </div>
                    </div>
                    <hr/>
                </section> <!-- /main content -->
            </div>
                <div class="text-center">
                    {{$products->appends(Request::input())->links()}}
                </div>

        </div>

    </div> <!-- /container -->

    <script>
        $('.try').click(function () {
            var brand = [];
            $('.try').each(function () {
                if ($(this).is(":checked")){
                    brand.push($(this).val());
                }
            });
            var key="{{\Request::get('search')}}";
            finalbrand = brand.toString();

            $.ajax({
                type: 'get',
                url:"{{route('search')}}",
                data: {search:key,"brand": + finalbrand},
                success: function (response) {
                    console.log(response);
                    $('#updateDiv').html(response);
                }
            });

        });
        </script>
@stop