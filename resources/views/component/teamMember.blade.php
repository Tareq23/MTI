<section id="teamMember">

    <div class="container-fluid text-center">
        <h2 class="sectionTitle">valuable team members</h2>
        <div class="row px-5  my-2 d-flex justify-content-center flex-wrap">

            @if(count($team_members))
                @foreach($team_members as $member)
                    <div class="col-sm-12 col-md-4 my-5">
                        <div class="card w-100">
                            <div class="card-body p-0 d-flex flex-column">
                                <img class="align-self-center pb-2" src="{{$member->image}}"  alt="project-img">
                                <div class="d-flex  mt-3 justify-content-between">
                                    <h5 class="card-title h3">{{$member->name}}</h5>
                                    @php
                                        $social_links = json_decode($member->social_link)
                                    @endphp
                                    <ul class="list-group list-group-horizontal">
                                        @if(isset($social_links->facebook))
                                        <li class="list-group-item"><a target="_blank" href="{{$social_links->facebook}}"><i class="fab fa-facebook fa-2x"></i></a></li>
                                        @endif
                                        @if(isset($social_links->linkedin))
                                        <li class="list-group-item"><a href="{{$social_links->linkedin}}"><i class="fab fa-linkedin fa-2x"></i></a></li>
                                        @endif
                                        @if(isset($social_links->github))
                                        <li class="list-group-item"><a href="{{$social_links->github}}"><i class="fab fa-github-square fa-2x"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                                <p class="mt-2">{{$member->description}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            <!-- <div class="col-sm-12 col-md-4 my-5">
                <div class="card w-100">
                    <div class="card-body p-0 d-flex flex-column">
                        <img class="align-self-center pb-2" src="{{asset('images/project.jpg')}}"  alt="project-img">
                        <div class="d-flex  mt-3 justify-content-between">
                            <h5 class="card-title h3">Member Name</h5>
                            <ul class="list-group list-group-horizontal">
                                <li class="list-group-item"><a href="#"><i class="fab fa-facebook fa-2x"></i></a></li>
                                <li class="list-group-item"><a href="#"><i class="fab fa-linkedin fa-2x"></i></a></li>
                                <li class="list-group-item"><a href="#"><i class="fab fa-github-square fa-2x"></i></a></li>
                            </ul>
                        </div>
                        <p class="mt-2">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div> 
            <div class="col-sm-12 col-md-4 my-5">
                <div class="card w-100">
                    <div class="card-body p-0 d-flex flex-column">
                        <img class="align-self-center pb-2" src="{{asset('images/project.jpg')}}"  alt="project-img">
                        <div class="d-flex  mt-3 justify-content-between">
                            <h5 class="card-title h3">Member Name</h5>
                            <ul class="list-group list-group-horizontal">
                                <li class="list-group-item"><a href="#"><i class="fab fa-facebook fa-2x"></i></a></li>
                                <li class="list-group-item"><a href="#"><i class="fab fa-linkedin fa-2x"></i></a></li>
                                <li class="list-group-item"><a href="#"><i class="fab fa-github-square fa-2x"></i></a></li>
                            </ul>
                        </div>
                        <p class="mt-2">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div> 
            <div class="col-sm-12 col-md-4 my-5">
                <div class="card w-100">
                    <div class="card-body p-0 d-flex flex-column">
                        <img class="align-self-center pb-2" src="{{asset('images/project.jpg')}}"  alt="project-img">
                        <div class="d-flex  mt-3 justify-content-between">
                            <h5 class="card-title h3">Member Name</h5>
                            <ul class="list-group list-group-horizontal">
                                <li class="list-group-item"><a href="#"><i class="fab fa-facebook fa-2x"></i></a></li>
                                <li class="list-group-item"><a href="#"><i class="fab fa-linkedin fa-2x"></i></a></li>
                                <li class="list-group-item"><a href="#"><i class="fab fa-github-square fa-2x"></i></a></li>
                            </ul>
                        </div>
                        <p class="mt-2">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div> 
            <div class="col-sm-12 col-md-4 my-5">
                <div class="card w-100">
                    <div class="card-body p-0 d-flex flex-column">
                        <img class="align-self-center pb-2" src="{{asset('images/project.jpg')}}"  alt="project-img">
                        <div class="d-flex  mt-3 justify-content-between">
                            <h5 class="card-title h3">Member Name</h5>
                            <ul class="list-group list-group-horizontal">
                                <li class="list-group-item"><a href="#"><i class="fab fa-facebook fa-2x"></i></a></li>
                                <li class="list-group-item"><a href="#"><i class="fab fa-linkedin fa-2x"></i></a></li>
                                <li class="list-group-item"><a href="#"><i class="fab fa-github-square fa-2x"></i></a></li>
                            </ul>
                        </div>
                        <p class="mt-2">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>        -->
        </div>

    </div>

</section>