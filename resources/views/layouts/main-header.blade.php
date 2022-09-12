<!-- main-header opened -->
<div class="main-header sticky side-header nav nav-item">
	<div class="container-fluid">
		<div class="main-header-left ">
			<div class="responsive-logo">
				<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo.png')}}" class="logo-1" alt="logo"></a>
				<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="dark-logo-1" alt="logo"></a>
				<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-2" alt="logo"></a>
				<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="dark-logo-2" alt="logo"></a>
			</div>
			<div class="app-sidebar__toggle" data-toggle="sidebar">
				<a class="open-toggle" href="#"><i class="header-icon fe fe-align-left"></i></a>
				<a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
			</div>
			<div class="main-header-center mr-3 d-sm-none d-md-none d-lg-block">
				<input class="form-control" placeholder="Search for anything..." type="search"> <button class="btn"><i class="fas fa-search d-none d-md-block"></i></button>
			</div>
		</div>
		<div class="main-header-right">
			<ul class="nav">
				<li class="">
					<div class="dropdown  nav-itemd-none d-md-flex">
					<a href="#" class="d-flex  nav-item nav-link pl-0 country-flag1" data-toggle="dropdown"
                                       aria-expanded="false">
                                        @if (App::getLocale() == 'en')
                                            <span class="avatar country-Flag mr-0 align-self-center bg-transparent"><img
                                                        src="{{URL::asset('assets/img/flags/us_flag.jpg')}}" alt="img"></span>
                                            <strong
                                                    class="mr-2 ml-2 my-auto">{{ LaravelLocalization::getCurrentLocaleName() }}</strong>
                                        @else
                                            <span class="avatar country-Flag mr-0 align-self-center bg-transparent"><img
                                                        src="{{URL::asset('assets/img/flags/egypt_flag.jpg')}}" alt="img"></span>
                                            <strong
                                                    class="mr-2 ml-2 my-auto">{{ LaravelLocalization::getCurrentLocaleName() }}</strong>
                                        @endif
                                       
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow" x-placement="bottom-end">
                                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                            <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                @if($properties['name'] == "English")
                                                    <i class="flag-icon flag-icon-us"></i>
                                                @elseif($properties['name'] == "Arabic")
                                                    <i class="flag-icon flag-icon-eg"></i>
                                                @endif
                                                {{ $properties['native'] }}
                                            </a>
                                        @endforeach
                                    </div>
									
						</div>
					</div>
				</li>
			</ul>
			<div class="nav nav-item  navbar-nav-right ml-auto">
				<div class="nav-link" id="bs-example-navbar-collapse-1">
					<form class="navbar-form" role="search">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search">
							<span class="input-group-btn">
								<button type="reset" class="btn btn-default">
									<i class="fas fa-times"></i>
								</button>
								<button type="submit" class="btn btn-default nav-link resp-btn">
									<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
										<circle cx="11" cy="11" r="8"></circle>
										<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
									</svg>
								</button>
							</span>
						</div>
					</form>
				</div>
				@can('notifications')
				<div class="dropdown nav-item main-header-notification">
					<a class="new nav-link" href="#">
						<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
							<path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
							<path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
						</svg>
						@if (auth()->user()->unreadNotifications->count() == 0)
						<span class=" pulse"></span>
						@else <span class="pulse">{{ auth()->user()->unreadNotifications->count() }}</span></a>
						@endif
					<div class="dropdown-menu">
						<div class="menu-header-content bg-primary text-right">
								<span class="badge badge-pill badge-warning  float-left"><a
                                            href="{{route('markAzRecord')}}">Mark All Read</a></span>
						</div>

						
						<div class="main-notification-list Notification-scroll" id="unreadNotifications">
						@foreach (auth()->user()->unreadNotifications as $notification)

							<a href="{{route('details.show',$notification->data['invoice_id'])}}">
								<h4 style="margin-left:4px" class="notification-label mb-1">{{ $notification->data['title'] }}</h4>

								<h4 style="margin-left:4px" class="notification-label mb-1"> created by : {{$notification->data['user']}}</h4>
								<h5 style="margin-left:4px" class="notification-label mb-1">{{$notification->created_at}}</h5>
							</a>
							@endforeach

						</div>

						


						<div class="dropdown-footer">
							<a href="">VIEW ALL</a>
						</div>
					</div>
				</div>
				@endcan
				<div class="nav-item full-screen fullscreen-button">
					<a class="new nav-link full-screen-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize">
							<path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path>
						</svg></a>
				</div>
				<div class="dropdown main-profile-menu nav nav-item nav-link">
					<a class="profile-user d-flex" href=""><img alt="" src="{{URL::asset('assets/img/faces/6.jpg')}}"></a>
					<div class="dropdown-menu">
						<div class="main-header-profile bg-primary p-3">
							<div class="d-flex wd-100p">
								<div class="main-img-user"><img alt="" src="{{URL::asset('assets/img/faces/6.jpg')}}" class=""></div>
								<div class="mr-3 my-auto">
									<h6>{{auth::user()->name}}</h6>
								</div>
							</div>
						</div>
						<a class="dropdown-item" href=""><i class="bx bx-user-circle"></i>Profile</a>
						<a class="dropdown-item" href=""><i class="bx bx-cog"></i> Edit Profile</a>
						<a class="dropdown-item" href=""><i class="bx bxs-inbox"></i>Inbox</a>
						<a class="dropdown-item" href=""><i class="bx bx-envelope"></i>Messages</a>
						<a class="dropdown-item" href=""><i class="bx bx-slider-alt"></i> Account Settings</a>
						<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
							<i class="bx bx-log-out"></i> log Out</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>



					</div>
				</div>
				<div class="dropdown main-header-message right-toggle">
					<a class="nav-link pr-0" data-toggle="sidebar-left" data-target=".sidebar-left">
						<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
							<line x1="3" y1="12" x2="21" y2="12"></line>
							<line x1="3" y1="6" x2="21" y2="6"></line>
							<line x1="3" y1="18" x2="21" y2="18"></line>
						</svg>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /main-header -->