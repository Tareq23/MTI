@extends('layout.app')
@section('title','MTI | BLOG')

@section('content')

    @include('component.topNav')
    @include('component.blogTopBanner')
    @include('component.blogPost')

    @include('component.footer')

@endsection


@section('script')
    <script type="text/javascript">
    
    </script>
@endsection