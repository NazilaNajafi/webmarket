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
                    <h4 class="title"><span class="striked">{{$product->price}}
                            تومان</span>
                        <span
                                class="red-clr">{{($product->price)-(($product->price)*($product->discount->discountPercent)/100)}}
                            تومان</span></h4>
                @else
                    <h4 id="title" class="title">{{ $product->price }}تومان</h4>

                @endif
                <h5 class="no-margin isotope--title">{{$product->title}}</h5>
            </div>
        </div>
    </div>
@endforeach
<!-- /single product -->
