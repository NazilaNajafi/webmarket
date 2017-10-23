@extends('layout.panel-layout')
@section('title','دسته بندی')
@section('content')

    <h3>دسته بندی</h3>
    <hr>
    <div class="well">
        <h4>افزودن دسته</h4>
        <form action="{{ route('new_category') }}" role="form" method="post">
            {{ csrf_field() }}
            <input class="form-control w30p" type="text" name="cat" value="" placeholder="نام دسته بندی"/>
            @if ($errors->has('cat'))
                <span class="help-block error">
                                        <strong>{{ $errors->first('cat') }}</strong>
                                    </span>
            @endif

            <br>
            <button name="submitCat" type="submit" class="btn btn-primary">ارسال</button>
        </form>
        <hr>
        <h4>افزودن زیر دسته</h4>
        <form action="{{ route('new_category') }}" role="form" method="post">
            {{ csrf_field() }}
            <select name="cat" class="form-control " id="cat">
                @foreach($groups as $group)
                    <option value="{{ $group->id }}"> {{ $group->groupName }} </option>
                @endforeach
            </select>
            <input class="form-control w30p" type="text" name="subCat" value="" placeholder="نام زیردسته"/>
            @if ($errors->has('subCat'))
                <span class="help-block error">
                                        <strong>{{ $errors->first('subCat') }}</strong>
                                    </span>
            @endif

            <br>
            <button name="submitSubcat" type="submit" class="btn btn-primary">ارسال</button>
        </form>
        <hr>
        <div class="well">
            <table class="table table-striped table-condensed table-hover">
                <tr>
                    <td>نام دسته بندی</td>
                    <td>عملیات</td>
                </tr>
                <tbody>
                @foreach($groups as $group)
                    <tr>
                        <td>{{ $group->groupName }}</td>
                    </tr>
                    @if($group->subgroups->count())
                        @foreach ($group->subgroups as $subGroup)
                            <tr class="danger">
                                <td>{{$subGroup->groupName}}</td>
                                <td><a href="{{route('delete_category',['category'=>$subGroup->id])}}">حذف</a>

                            </tr>
                        @endforeach

                    @endif

                @endforeach

                </tbody>

            </table>
        </div>
    </div>
@stop