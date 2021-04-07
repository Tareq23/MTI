<section id="technology">

    <div class="container-fluid mt-5 text-center">
        <h2 class="sectionTitle">technology</h2>
        <p class="subTitle">we used these technology as your requirement</p>
        <div class="row">
            <div class="col-12 d-flex flex-wrap justify-content-center">
                @foreach($technologies as $technology)
                    <div class="card">
                        <p>{{$technology->name}}</p>
                    </div>
                @endforeach
                <!-- <div class="card">
                    <img class="card-img" src="{{asset('images/html.png')}}" alt="Card image cap">
                </div>
                <div class="card">
                    <img class="card-img" src="{{asset('images/css.png')}}" alt="Card image cap">
                </div>
                <div class="card">
                    <img class="card-img" src="{{asset('images/jquery.png')}}" alt="Card image cap">
                </div>
                <div class="card">
                    <img class="card-img" src="{{asset('images/reactjs.jpeg')}}" alt="Card image cap">
                </div>
                <div class="card">
                    <img class="card-img" src="{{asset('images/laravel.png')}}" alt="Card image cap">
                </div>
                <div class="card">
                    <img class="card-img" src="{{asset('images/python.jpeg')}}" alt="Card image cap">
                </div>
                <div class="card">
                    <img class="card-img" src="{{asset('images/django.png')}}" alt="Card image cap">
                </div> -->
            </div>
        </div>
    </div>
</section>