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
                    <h4 class="title"><span class="striked">{{($product->price)}}
                            تومان</span> <span
                                class="red-clr">{{number_format(($product->price)-(($product->price)*($product->discount->discountPercent)/100))}}
                            تومان</span></h4>

                @else
                    <h4 id="title" class="title">{{( $product->price) }}
                        تومان</h4>
                @endif
                <h5 class="no-margin isotope--title">{{ $product->title }}</h5>
            </div>

        </div>
    </div>
@endforeach