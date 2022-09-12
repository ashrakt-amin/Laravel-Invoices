<!-- Title -->
<title>@yield('title')</title>
<!-- Favicon -->
<link rel="icon" href="{{URL::asset('assets/img/brand/favicon.png')}}" type="image/x-icon"/>
<!-- Icons css -->
<link href="{{URL::asset('assets/css/icons.css')}}" rel="stylesheet">
<!--  Custom Scroll bar-->
<link href="{{URL::asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>
<!--  Sidebar css -->
<link href="{{URL::asset('assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">
<!-- Sidemenu css -->
<link rel="stylesheet" href="{{URL::asset('assets/css/sidemenu.css')}}">
@yield('css')

@if(App::getLocale()=='en')
<link href="{{URL::asset('assets/css/style.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/css/style-dark.css.map')}}" rel="stylesheet">
<link href="{{URL::asset('assets/css/style-dark.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/css/style.css.map')}}" rel="stylesheet">
<link href="{{URL::asset('assets/css/animate.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/css/sidemenu.css')}}" rel="stylesheet">

@else
<!--- Style css -->
<link href="{{URL::asset('assets/css-rtl/style.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/css-rtl/style-dark.css.map')}}" rel="stylesheet">
<link href="{{URL::asset('assets/css-rtl/style-dark.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/css-rtl/style.css.map')}}" rel="stylesheet">
<link href="{{URL::asset('assets/css-rtl/animate.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/css-rtl/sidemenu.css')}}" rel="stylesheet">
@endif
<!--- Dark-mode css -->
<link href="{{URL::asset('assets/css/style-dark.css')}}" rel="stylesheet">
<!---Skinmodes css-->
<link href="{{URL::asset('assets/css/skin-modes.css')}}" rel="stylesheet">