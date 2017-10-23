<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/dropzone.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.2.0/dropzone.js"></script>
    <link rel="stylesheet" href="{{asset('/css/sweetalert.css')}}">
    <style>
        .error{
            color: red;
        }


    </style>
    <title>@yield('title')</title>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{route('home')}}">وبمارکت</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="{{route('dashboard')}}">داشبورد</a></li>
            <li><a href="{{route('new_product')}}"> افزودن محصول</a></li>
            <li><a href="{{route('product_list')}}"> نمایش محصولات</a></li>
            <li><a href="{{route('new_category')}}"> دسته بندی</a></li>
            <li><a href="{{route('off')}}">تخفیف</a></li>
            <li><a href="{{route('comments')}}"> نظرات</a></li>
            <li><a href="{{route('orders')}}"> سفارشات</a></li>
            <li><a href="{{route('editPass')}}"> ویرایش حساب</a></li>
            <li><a href="{{ route('exit')}}"> خروج از پنل</a></li>


        </ul>
    </div>

</nav>

<div class="container">
    <div class="col-md-12" style="direction: rtl">

        @yield('content')
    </div>
</div> <!-- /container -->
<script>
    Dropzone.options.addPhotosForm = {
        paramName: "file",
        maxFiles: 3,
        maxFilesize: 3,
        acceptedFiles: '.jpg,.jpeg,.png,.bmp'
    }
</script>
<script src="{{asset('/js/app.js')}}"></script>
<script src="{{asset('/js/sweetalert.js')}}"></script>
@include('flash')

</body>

</body>
</html>
