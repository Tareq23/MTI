<section id="blogPost">
    <div class="container-fluid">
        <div class="row">
            @foreach($all_posts as $post)
                @php
                    $content = json_decode($post->content);
                    $text = substr($content->text,0,300);
                @endphp
                <div class="col-md-6 col-sm-12 mt-5">
                    <div class="card">
                        <img src="{{$content->image}}" class="card-img-top" alt="blog post">
                        <div class="card-body p-0 pt-3">
                            <h4 class="card-title"><a target="_blank" href="{{'/blog/post/'.$post->slug}}">{{$post->title}}</a></h4>
                            <p class="post-author"><span>posted date</span> Created By: {{$post->name}}</p>
                            <p class="card-text">{!!$content->text!!}</p></br>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>