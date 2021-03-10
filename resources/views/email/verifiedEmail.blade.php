
@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p>Thanks for register</p>
                <button><a target="_blank" href="{{url('/blog',[$token])}}">Click Here</a></button>
            </div>
        </div>
    </div>
@endsection



