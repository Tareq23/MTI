@extends('layout.app')


@section('content')
        @include('component.admin.topNav')
        @include('component.admin.sideNav')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos, beatae!</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque eum adipisci sint soluta inventore qui et pariatur rem, doloremque omnis repellendus nostrum, sapiente perferendis nobis distinctio, amet dolorem numquam nesciunt!</p>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        let sideNavToggleCount = 0;
        $("#menuBarBtn").click(function(){
            sideNavToggleCount++;
            if(sideNavToggleCount%2==1){
                $("#sideNav").removeClass("d-none");
            }
            else{
                $("#sideNav").addClass("d-none");
            }
        })
    </script>
@endsection