@extends('layout.app')
@section('title','MTI | BLOG')

@section('content')

    @include('component.topNav')
    @include('component.blogTopBanner')
   
    @include('component.singlePost')

    @include('component.footer')

@endsection
