@extends('master')
@section('css')
    <style>
        .form-group {
            margin-top: 15px;
        }

        .help-block {
            color: red;
        }
    </style>
@stop
@section('content')
    <div class="row">

        <div class="col-8 mx-auto">
            <div class="form-group">
                <div class="w-100 text-center">
                    <h5>Person Form</h5>
                    <a href="{{route('person.list')}}" class="btn btn-primary">Person List</a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success" role="alert">{{session('success')}}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger" role="alert">{{session('error')}}</div>
            @endif

            <form method="post" action="{{route('person.post_operation')}}">
                {{csrf_field()}}

                @if(isset($detail) )
                    <input type="hidden" name="person_id" value="{{encrypt($detail->id)}}">
                @endif

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ isset($detail) ? $detail->name : '' }}">
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="form-group">
                    <label>Birth Day</label>
                    <input type="date" name="birthday" class="form-control"  value="{{ isset($detail) ? $detail->birthday : '' }}" >
                    {!! $errors->first('birthday', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <select class="form-control" name="gender">
                        <option value="Male"{{ isset($detail) ? ($detail->gender == "Male" ? 'selected' : '') : '' }} >Male</option>
                        <option value="Female" {{ isset($detail) ? ($detail->gender == "Female" ? 'selected' : '') : '' }}>Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control" name="address" rows="3">{{ isset($detail->detail) ? $detail->detail->address : '' }}</textarea>
                </div>
                <div class="form-group">
                    <label>Post Code</label>
                    <input type="text" name="post_code" value="{{ isset($detail->detail) ? $detail->detail->post_code : '' }}" class="form-control">
                </div>
                <div class="form-group">
                    <label>City Name</label>
                    <input type="text" name="city_name" value="{{ isset($detail->detail) ? $detail->detail->city_name : '' }}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Country Name</label>
                    <input type="text" name="country_name" value="{{ isset($detail->detail) ? $detail->detail->country_name : '' }}" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary mt-3 float-right">Send</button>
            </form>
        </div>
    </div>
@stop
