@extends('layout.main-layout')
@section('title','مشخصات محصول')
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
                            <a href="{{route('subList',[$product->group->id])}}">{{$product->group->groupName}}</a>
                        </li>
                        <li><span class="icon-chevron-right"></span></li>
                        <li>
                            <a>{{$product->title}}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!--  ==========  -->
    <!--  = Main container =  -->
    <!--  ==========  -->
    <div class="container">
        <div class="push-up top-equal blocks-spacer">

            <!--  ==========  -->
            <!--  = Product =  -->
            <!--  ==========  -->
            <div class="row blocks-spacer">

                <!--  ==========  -->
                <!--  = Preview Images =  -->
                <!--  ==========  -->
                <div class="span5">
                    <div class="product-preview">
                        <div class="picture">
                            <img src={{asset($product->photo)}} alt="" class="itemimg"
                                 id="mainPreviewImg"/>
                        </div>
                        <div class="thumbs clearfix">
                            @foreach($product->images as $image)
                                <div class="thumb active">
                                    <a href="#mainPreviewImg"><img src={{$image->imageUrl}} alt=""
                                                                   class="item"/></a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>


                <!--  ==========  -->
                <!--  = Title and short desc =  -->
                <!--  ==========  -->
                <div class="span7">
                    <div class="product-title">
                        <h1 class="name"><span class="light">{{$product->title}} </span></h1>
                        <div class="meta">
                            @if($product->discount->discountPercent !=0)
                                <span
                                        class="title">{{number_format(($product->price)-(($product->price)*($product->discount->discountPercent)/100))}}
                                    تومان</span></h4>
                            @else
                                <h4 class="title">{{ number_format($product->price )}}تومان</h4>

                            @endif
                            @if ($product->quantity != 0)
                                <span class="btn btn-success">موجود</span>
                            @else
                                <span class="btn btn-danger">اتمام موجودی</span>
                            @endif
                        </div>
                    </div>
                    <div class="product-description">
                        <p>{{str_limit($product->detail, $limit = 150, $end = '...')}}</p>

                        <hr>

                        <!--  ==========  -->
                        <!--  = Add to cart form =  -->
                        <!--  ==========  -->
                        <form action="{{ route('home') }}" method="get" class="form form-inline clearfix">
                            <div class="numbered">
                                <span>تعداد</span>
                                <input type="text" name="num" value="1" class="tiny-size"/>
                            </div>
                            &nbsp;
                            <input type="text" name="id" value="{{ $product->id }}" style="display: none"
                                   class="tiny-size"/>
                            @if ($product->quantity != 0)
                                <button class="btn btn-danger pull-right"><i class="icon-shopping-cart"></i> اضافه به
                                    سبد خرید
                                </button>
                                @endif

                                </button>
                        </form>


                        <hr/>

                        <!--  ==========  -->
                        <!--  = Share buttons =  -->
                        <!--  ==========  -->
                        <div class="share-item">
                            ثبت نظر:
                        </div>
                        <div class="well">

                            <form role="form" method="post" action="{{route('addComment',[$product->id])}}">
                                {{csrf_field()}}
                                <div class="form-group center">
                                    <input class="form-control w30p" type="text" name="author" placeholder="نام شما"/>
                                    @if ($errors->has('author'))
                                        <span class="help-block error">
                                        <strong>{{ $errors->first('author') }}</strong>
                                    </span>
                                    @endif
                                    <br>
                                    <input class="form-control w30p ltr" type="text" name="mail"
                                           placeholder="Your Email"/>
                                    @if ($errors->has('mail'))
                                        <span class="help-block error">
                                        <strong>{{ $errors->first('mail') }}</strong>
                                    </span>
                                    @endif
                                    <br>
                                    <textarea class="form-control" style="min-width: 100%" rows="4"
                                              name="body"></textarea>
                                    @if ($errors->has('body'))
                                        <span class="help-block error">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <input type="submit" name="submitComment" class="btn btn-primary" value="  ارسال  ">
                            </form>
                        </div>


                    </div>
                </div>
            </div>

            <!--  ==========  -->
            <!--  = Tabs with more info =  -->
            <!--  ==========  -->
            <div class="row">
                <div class="span12">
                    <ul id="myTab" class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab-1" data-toggle="tab">جزئیات</a>
                        </li>
                        <li>
                            <a href="#tab-3" data-toggle="tab">نظرات</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="fade in tab-pane active" id="tab-1">
                            <p>{{$product->detail}}</p>
                        </div>
                        <div class="fade tab-pane" id="tab-3">
                            <div class="media">
                                @foreach($product->comments as $comment)
                                    @if($comment->status==1)
                                        <div class="media-body">
                                            <h4 class="media-heading">
                                                {{ $comment->author }} <br>
                                                <small> {{ jDate($comment->created_at)->ago() }} </small>

                                            </h4>
                                            <p>{{ $comment->body }}</p>

                                            <div class="vote">
                                                <span class="cRate rateUp" id="{{$comment->id}}-up"><img  src="{{asset('images/like.jpg')}}"> </span>
                                                <span class="rateVal"
                                                      id="{{$comment->id}}-rate">{{$comment->rate}}</span>
                                                <span class="cRate rateDown" id="{{$comment->id}}-down"><img src="{{asset('images/dislike.jpg')}}"></span>
                                            </div>
                                        </div>
                                        <hr>
                                    @endif
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- /container -->


    <!--  ==========  -->
    <!--  = Related Products =  -->
    <!--  ==========  -->
    <div class="boxed-area no-bottom">
        <div class="container">

            <!--  ==========  -->
            <!--  = Title =  -->
            <!--  ==========  -->
            <div class="row">
                <div class="span12">
                    <div class="main-titles lined">
                        <h2 class="title"><span class="light">محصولات</span> مرتبط</h2>
                    </div>
                </div>
            </div>

            <!--  ==========  -->
            <!--  = Related products =  -->
            <!--  ==========  -->
            <div class="row popup-products">

                <!--  ==========  -->
                <!--  = Products =  -->
                <!--  ==========  -->
                @foreach($ralatedProducts as $relatedProduct)
                    <div class="span3">
                        <div class="product">
                            <div class="product-img">
                                <div class="picture">
                                    <img class="itemimg" src={{ $relatedProduct->photo }} />
                                    <div class="img-overlay">
                                        <a href="#" class="btn more btn-primary">توضیحات بیشتر</a>
                                        <a href="{{ route('detail' , [$product->id,$relatedProduct->id])}}"
                                           class="btn buy btn-danger">اضافه به سبد خرید</a>
                                    </div>
                                </div>
                            </div>
                            <div class="main-titles no-margin">
                                @if($relatedProduct->discount->discountPercent !=0)
                                    <h4 class="title"><span class="striked">{{number_format($relatedProduct->price)}} تومان</span>
                                        <span
                                                class="red-clr">{{(number_format($relatedProduct->price)-(($relatedProduct->price)*($relatedProduct->discount->discountPercent)/100))}}
                                            تومان</span></h4>
                                @else
                                    <h4 id="title" class="title">{{number_format( $relatedProduct->price) }}تومان</h4>

                                @endif

                                <h5 class="no-margin">{{$relatedProduct->title}}</h5>
                            </div>
                            <p>{{str_limit($relatedProduct->detail, $limit = 50, $end = '...')}}</p>
                        </div>
                    </div>
            @endforeach
            <!-- /product -->

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $(".cRate").click(function (e) {
                var thisElement = $(this);
                thisElement.parent().find('.rateVal').fadeIn(10).html('...');
                $.ajax({
                    type: 'POST',
                    url: '/like',
                    data: {cRateStr: thisElement.attr('id'), "_token": "{{ csrf_token() }}"},
                    success: function (response) {
                        thisElement.parent().find('.rateVal').html(response);
                        thisElement.parent().find('.rateVal').fadeIn(500);
                    },
                    error: function (xhr, status, error) {
                        thisElement.parent().find('.rateVal').html('خطا');
                        thisElement.parent().find('.rateVal').fadeIn(500);
                    }


                });
            });
        });
    </script>
    <style>
        .media {
            position: relative;
        }

        .vote {
            position: relative;
            left: 0;
        }

        .vote .rateUp, .vote .rateDown {
            font-weight: bold;
            font-size: 26px;
            cursor: pointer;
        }

        .vote .rateUp:hover, .vote .rateDown:hover {
            color: black;
        }

        .vote .rateUp {
            color: green;
        }

        .vote .rateDown {
            color: red;
        }

        .vote .rateVal {
            direction: ltr;
            font-family: sans-serif;
            display: inline-block;
            width: 30px;
            text-align: center;
            font-size: 15px;
            color: #555;
        }

    </style>


@stop
