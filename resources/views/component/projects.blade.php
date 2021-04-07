<section id="project">

    <div class="container-fluid text-center" style="margin-top:2rem;">
        <h2 class="sectionTitle">projects</h2>
        <p class="subTitle">we used these technology as your requirement</p>
        <div class="row px-5">
            @foreach($projects as $project)
                <div class="col-sm-12 col-md-4 col-lg-3 my-2">
                    <div class="card w-100">
                        <a target="_blank" href="{{$project->url}}"><img src="{{$project->image}}" class="card-img-top" alt="project-img"/></a>
                    </div>
                </div>
            @endforeach
            <!-- <div class="col-sm-12 col-md-4 col-lg-3 my-2">
                <div class="card w-100">
                    <img src="{{asset('images/project.jpg')}}" class="card-img-top" alt="project-img">
                    <div class="card-body">
                        <h5 class="card-title">project title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">overview</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-3 my-2">
                <div class="card w-100">
                    <img src="{{asset('images/project2.jpg')}}" class="card-img-top" alt="project-img">
                    <div class="card-body">
                        <h5 class="card-title">project title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">overview</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-3 my-2">
                <div class="card w-100">
                    <img src="{{asset('images/project3.jpg')}}" class="card-img-top" alt="project-img">
                    <div class="card-body">
                        <h5 class="card-title">project title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">overview</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-3 my-2">
                <div class="card w-100">
                    <img src="{{asset('images/project4.jpg')}}" class="card-img-top" alt="project-img">
                    <div class="card-body">
                        <h5 class="card-title">project title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">overview</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-3 my-2">
                <div class="card w-100">
                    <img src="{{asset('images/project5.jpg')}}" class="card-img-top" alt="project-img">
                    <div class="card-body">
                        <h5 class="card-title">project title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">overview</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-3 my-2">
                <div class="card w-100">
                    <img src="{{asset('images/project5.jpg')}}" class="card-img-top" alt="project-img">
                    <div class="card-body">
                        <h5 class="card-title">project title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">overview</a>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</section>