@extends('layout.checkout-layout')
@section('title','تایید')
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
                    		    		<a href="{{route('home')}}"><img src="{{asset('images/logo-bw.png')}}" alt="Webmarket Logo" width="48" height="48" /></a>
                    		    	</div>
                    		    	<div class="span6">
                    		    	    <div class="center-align">
                    		    	        <h1><span class="light">تاييد</span> </h1>
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
										<div class="step-badge"><i class="icon-ok"></i></div>
										<a href="checkout-step-1.blade.php">سبد خريد</a>
									</div>
									<div class="step done">
										<div class="step-badge"><i class="icon-ok"></i></div>
										<a href="checkout-step-2.blade.php">آدرس ارسال</a>
									</div>
									<div class="step active">
										<div class="step-badge">2</div>
										بازبینی اطلاعات
									</div>
									<div class="step">
										<div class="step-badge">4</div>
										تاييد و پرداخت
									</div>
								</div>
							</div> <!-- /steps -->

                    		<!--  ==========  -->
							<!--  = Selected Items =  -->
							<!--  ==========  -->
							<h4>اطلاعات سبد خرید:</h4>
							<table class="table table-items">
							    <thead>
							    	<tr>
							    		<th colspan="2">آيتم</th>
							    		<th><div class="align-center">تعداد</div></th>
							    		<th><div class="align-right">قيمت</div></th>
							    	</tr>
							    </thead>
							    <tbody>
								@if($order != Null)
									@foreach($order as $key => $value)
							        <tr>
							        	<td class="image"><img src="images/dummy/cart-items/cart-item-1.jpg" alt="" width="124" height="124" /></td>
							        	<td class="desc">{{ $value->name }}</td>
							        	<td class="qty">
											{{ $value->qty }}
										</td>
							        	<td class="price">
											@foreach($new as $index=>$amount)
												@foreach($amount as $in=>$am)
													@foreach($am as $i=>$a)
														@if($in == $value->id)
															{{number_format($a) }}تومان
															@break
														@endif
													@endforeach
												@endforeach
											@endforeach
							        	</td>
							        </tr>
									@endforeach
									@endif
							    </tbody>
							</table>

							<!--  ==========  -->
							<!--  = BuyerInfo =  -->
							<!--  ==========  -->
							<h4>اطلاعات خریدار:</h4>
							<table class="table table-items">
								<thead>
								<tr>
									<th><div class="align-right">نام خریدار</div></th>
									<th><div class="align-right">شهر</div></th>
									<th><div class="align-right">آدرس</div></th>
									<th><div class="align-right">تلفن همراه</div></th>
									<th><div class="align-right">تلفن ثابت</div></th>
								</tr>
								</thead>
								<tbody>
										<tr>
											<td class="align-center">{{$user->name}}</td>
											<td class="align-center">{{$user->buyer->city}}</td>
											<td class="align-center">{{$user->buyer->address}}</td>
											<td class="align-center">{{$user->buyer->cellphone}}</td>
											<td class="align-center">{{$user->buyer->phone}}</td>
										</tr>
								</tbody>
							</table>

							<p class="right-align">
							    <a href="{{route('checkoutStep4')}}" name="nextStep" class="btn btn-primary higher bold" >تاييد</a>
								{{--<button href="{{route('checkoutStep4')}}" type="button" class="btn btn-primary higher bold"  name="nextStep">ادامه{{route('checkoutStep4')}}</button>--}}
							</p>
                    	</div>
                    </div>
                </div>
                
                
            </section> <!-- /main content -->
        
        </div>
    </div> <!-- /container -->
    
     
    @stop
     
