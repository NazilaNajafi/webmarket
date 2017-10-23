@extends('layout.panel-layout')
@section('title','ویرایش حساب کاربری')
@section('content')
    <div class="well">
        <form role="form" method="post" action="{{route('editPass')}}">
            {{csrf_field()}}
            <input class="form-control" type="password" name="oldPass" value="" placeholder="OldPassword"/>
            @if ($errors->has('oldPass'))
                <span class="help-block error">
                                        <strong>{{ $errors->first('oldPass') }}</strong>
                                    </span>
            @endif

            <input class="form-control" type="password" name="newPass" value="" placeholder="NewPassword"/>
            @if ($errors->has('newPass'))
                <span class="help-block error">
                                        <strong>{{ $errors->first('newPass') }}</strong>
                                    </span>
            @endif

            <input class="form-control" type="password" name="confPass" value="" placeholder="ConfirmPassword"/>
            @if ($errors->has('confPass'))
                <span class="help-block error">
                                        <strong>{{ $errors->first('confPass') }}</strong>
                                    </span>
            @endif

            <input type="submit" name="submit" class="btn btn-primary" value="  ارسال  ">
        </form>
    </div>
@stop
