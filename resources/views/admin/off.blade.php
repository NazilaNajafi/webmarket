@extends('layout.panel-layout')
@section('title','تخفیف')
@section('content')
    <div class="well">
        <h4>افزودن تخفیف</h4>
        <form action="{{ route('off') }}" role="form" method="post">
            {{ csrf_field() }}
            <input class="form-control w30p" type="text" name="off" value="" placeholder="تخفیف"/>
            @if ($errors->has('off'))
                <span class="help-block error">
                                        <strong>{{ $errors->first('off') }}</strong>
                                    </span>
            @endif
            <input type="submit" name="submit" class="btn btn-primary" value="  ارسال  ">
        </form>
    </div>
@stop