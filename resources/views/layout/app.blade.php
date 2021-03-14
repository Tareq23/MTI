<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
</head>
<body>
    
    @yield('content')

    <script src="{{asset('js/app.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            let url = $(location).attr('href');
            let reverseUrl = url.split("/");
            if(reverseUrl[reverseUrl.length-1]=="blog")
            {
                $("#topMenu-dropdown").removeClass("d-none");
            }
        });
    </script>
    @yield('script')
</body>
</html>