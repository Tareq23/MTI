@extends('layout.app')
@section('title','MTI | BLOG')

@section('content')

    @include('component.topNav')
    @include('component.blogTopBanner')
   
    @include('component.singlePost')

    @include('component.footer')

@endsection

@section('script')

    <script>

        $(document).ready(function(){
            //scroll top
            window.onbeforeunload = function () {
                window.scrollTo(0,0);
            };
            const posts = {!!$posts!!}
            $.each(posts,function(idx,post){
                $('<li class="list-group-item">').html(
                    '<a target="_blank" href="'+post.slug+'">'+post.title+'</a>'
                ).appendTo("#footer_post_link");
            })

        });

    </script>

@endsection
