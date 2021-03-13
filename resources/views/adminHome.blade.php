@extends('layout.app')


@section('content')

    @include('component.admin.topNav')
    @include('component.admin.sideNav')


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