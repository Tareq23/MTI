
@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <p>Thanks for register</p>
                <button class="btn btn-primary"><a target="_blank" href="{{url('/blog',[$token])}}">Click Here</a></button>
            </div>
        </div>
    </div>
@endsection



