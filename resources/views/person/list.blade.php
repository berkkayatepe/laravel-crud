@extends('master')
@section('content')
    <div class="row">
        <div class="col-10 mx-auto">
            <div class="form-group">
                <div class="w-100 text-center">
                    <h5>Person List</h5>
                    <a href="{{route('person.create')}}" class="btn btn-primary">Person Add</a>
                </div>
            </div>
            @if(session('success'))
                <div class="alert alert-success" role="alert">{{session('success')}}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger" role="alert">{{session('error')}}</div>
            @endif
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Birth Day</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Address</th>
                    <th scope="col">Post Code</th>
                    <th scope="col">City Name</th>
                    <th scope="col">Country Name</th>
                    <th scope="col">Operation</th>
                </tr>
                </thead>
                <tbody>
                @if(count($persons) >0)
                    @foreach($persons as $person)
                        <tr>
                            <th scope="row">{{ $loop->index + 1}}</th>
                            <td>{{$person->name}}</td>
                            <td>{{$person->birthday}}</td>
                            <td>{{$person->gender ?? '-'}}</td>
                            <td>{{$person->detail->address ?? '-'}}</td>
                            <td>{{$person->detail->post_code ?? '-'}}</td>
                            <td>{{$person->detail->city_name ?? '-'}}</td>
                            <td>{{$person->detail->country_name ?? '-'}}</td>
                            <td>
                                <a href="{{route('person.edit',['id' => encrypt($person->id)])}}">Edit</a> | <a href="{{route('person.delete',['id' => encrypt($person->id)])}}">Remove</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            <div class="clearfix"></div>
            <div class="d-flex justify-content-center">
                {{$persons->links("pagination::bootstrap-4")}}
            </div>
        </div>
    </div>
@stop
