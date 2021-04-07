<section id="topBanner">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-md-11">
                <div class="topBannerOverlay">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-7 col-sm-12">
                                    <img class="card-img" src="{!!$data[0]->image!!}">
                                </div>
                                <div class="col-md-5 col-sm-12 my-auto">
                                    <div class="myShortInfo p-1">
                                        <p>Hello Everybody, I am</p>
                                        <h3>{!!$data[0]->name!!}</h3>
                                        <h4>{!!$data[0]->work_position!!}</h4>
                                        <p>{!!$data[0]->short_description!!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>