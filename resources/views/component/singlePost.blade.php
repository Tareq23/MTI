<div class="container singleBlogPost">

    <div class="row">

        <div class="col-12">

            <h3>{{$title}}</h3>
            <div class="post-image">
                <img src="{{$content->image}}" alt="{{$title}}"/>
            </div>
            <div class="post-content">
                
                {!!$content->text!!}

            </div>

        </div>

    </div>

</div>