@extends('layout.app')
@section('title','HOME')


@section('content')
    @include('component.topNav')
    <!-- <div class="my-5"></div> -->
    @include('component.topBanner')
    <div class="my-5"></div>
    @include('component.usedTechnology')
    <div class="my-5"></div>
    @include('component.projects')
    <div class="my-5"></div>
    @include('component.teamMember')
    <div class="my-5"></div>
    @include('component.contact')
    <div class="my-5"></div>
    @include('component.footer')
@endsection




@section('script')
    <script type="text/javascript">
    
    
    </script>
@endsection

