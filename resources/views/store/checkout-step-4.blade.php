@extends('layout.checkout-layout')
@section('title','پرداخت')
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
                    		    		<a href="index.html"><img src={{asset("images/logo-bw.png")}} alt="Webmarket Logo" width="48" height="48" /></a>
                    		    	</div>
                    		    	<div class="span6">
                    		    	    <div class="center-align">
                    		    	        <h1><span class="light">پرداخت</span></h1>
                    		    	    </div>
                    		    	</div>
                    		    	<div class="span2">
                    		    	    <div class="right-align">
                    		    	    	<img src="{{asset('images/buttons/security.jpg')}}" alt="Security Sign" width="92" height="65" />
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
                                    <div class="step done">
                                        <div class="step-badge"><i class="icon-ok"></i></div>
                                        <a href="checkout-step-4.blade.php">بازبینی اطلاعات</a>
                                    </div>
                                    <div class="step active">
                                        <div class="step-badge">4</div>
                                        تاييد و پرداخت
                                    </div>
                                </div>
                            </div> <!-- /steps -->


                    		
						    <!--  ==========  -->
							<!--  = Payment =  -->
							<!--  ==========  -->
							<div class="shifted-left-45 clearfix">
							    <h3 class="no-margin"><span class="light">کارت</span> اعتباري</h3>
                                <form action="#" method="post" class="form-horizontal form-checkout">
                                    <div class="control-group">
                                        <label class="control-label">مبلغ کل <span class="red-clr bold"></span></label>
                                        <div class="controls">
                                            <input type="text"  value="{{ number_format($sum) }}" disabled class="span4" >
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="firstName">نام<span class="red-clr bold">*</span></label>
                                        <div class="controls">
                                            <input type="text" id="firstName" class="span4" required>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="lastName">نام خانوادگي<span class="red-clr bold">*</span></label>
                                        <div class="controls">
                                            <input type="text" id="lastName" class="span4" required>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="cardNum">شماره کارت اعتباري<span class="red-clr bold">*</span></label>
                                        <div class="controls">
                                            <input type="text" id="cardNum" class="span1 card-num-input center-align" maxlength="4">
                                            <input type="text" class="span1 card-num-input center-align" maxlength="4">
                                            <input type="text" class="span1 card-num-input center-align" maxlength="4">
                                            <input type="text" class="span1 card-num-input center-align add-tooltip" maxlength="4" >
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="cvc">CVC or CVS<span class="red-clr bold">*</span></label>
                                        <div class="controls">
                                            <input id="cvc" type="text" class="span1 center-align add-tooltip" maxlength="3"  required>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="exp">تاريخ انقضا<span class="red-clr bold">*</span></label>
                                        <div class="controls">
                                            <select id="exp" class="input-small month-push-right">
                                                <option value="-1">ماه</option>
                                                                                                <option value="1">01</option>     
                                                                                                <option value="2">02</option>     
                                                                                                <option value="3">03</option>     
                                                                                                <option value="4">04</option>     
                                                                                                <option value="5">05</option>     
                                                                                                <option value="6">06</option>     
                                                                                                <option value="7">07</option>     
                                                                                                <option value="8">08</option>     
                                                                                                <option value="9">09</option>     
                                                                                                <option value="10">10</option>     
                                                                                                <option value="11">11</option>     
                                                                                                <option value="12">12</option>     
                                                 
                                            </select>
                                            <select id="exp" class="input-small">
                                                <option value="-1">سال</option>
                                                                                                <option value="2013">2013</option>     
                                                                                                <option value="2014">2014</option>     
                                                                                                <option value="2015">2015</option>     
                                                                                                <option value="2016">2016</option>     
                                                                                                <option value="2017">2017</option>     
                                                                                                <option value="2018">2018</option>     
                                                                                                <option value="2019">2019</option>     
                                                 
                                            </select>
                                        </div>
                                    </div>
                                </form>
							</div>
							
							<hr />
							

                            
                            <hr />
						    
						    <p class="right-align">
                                &nbsp; &nbsp;
						        <a href="{{route('payment')}}" class="btn btn-primary higher bold">پرداخت</a>
						    </p>
							    
							    
                    	</div>
                    </div>
                </div>
                
                
            </section> <!-- /main content -->
        
        </div>
    </div> <!-- /container -->
       @stop