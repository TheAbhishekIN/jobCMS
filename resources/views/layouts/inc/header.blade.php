<div class="container">
            
            <!-- Left Side Content -->
            <div class="left-side">
                <!-- Logo -->
                <div id="logo">
                    <a href=""><img src="{{asset('images/logo.png')}}" alt="logo"></a>
                </div>

                <!-- Main Navigation -->
                <nav id="navigation">
                    <ul id="responsive">

                        <li><a href="{{ route('index') }}" class="current">Home</a></li>

                        <li><a href="#">For Seekeer</a>
                            <ul class="dropdown-nav">
                                <li><a href="{{ route('job_listing') }}">Browse Jobs</a></li>
                                <li><a href="{{ route('companies_listing') }}">Browse Companies</a></li>
                            </ul>
                        </li>

                        <li><a href="#">For Recruiter</a>
                            <ul class="dropdown-nav">
                                <li><a href="#">Find a Seeker</a></li>
                                <li><a href="#">Post a Job</a></li>
                            </ul>
                        </li>
                                <li><a href="#">Blog</a></li>
                                <li><a href="#">Contact</a></li>

                    </ul>
                </nav>
                <div class="clearfix"></div>
                <!-- Main Navigation / End -->
                
            </div>
            <!-- Left Side Content / End -->
            <!-- Right Side Content / End -->
                            <div class="right-side">
                            @guest

                <div class="header-widget">
                    <a href="{{route('login')}}" class="log-in-button"><i class="icon-feather-log-in"></i> <span>Log In / Register</span></a>
                </div>

                <!-- Mobile Navigation Button -->
                <span class="mmenu-trigger">
                    <button class="hamburger hamburger--collapse" type="button">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </span>

            </div>
            @else

                <!--  User Notifications -->
                <div class="header-widget hide-on-mobile">
                    
                    <!-- Notifications -->
                    <div class="header-notifications">

                        <!-- Trigger -->
                        <div class="header-notifications-trigger">
                            <a href="#"><i class="icon-feather-bell"></i><span>4</span></a>
                        </div>

                        <!-- Dropdown -->
                        <div class="header-notifications-dropdown">

                            <div class="header-notifications-headline">
                                <h4>Notifications</h4>
                                <button class="mark-as-read ripple-effect-dark" title="Mark all as read" data-tippy-placement="left">
                                    <i class="icon-feather-check-square"></i>
                                </button>
                            </div>

                            <div class="header-notifications-content">
                                <div class="header-notifications-scroll" data-simplebar>
                                    <ul>
                                        <!-- Notification -->
                                        <li class="notifications-not-read">
                                            <a href="dashboard-manage-candidates.html">
                                                <span class="notification-icon"><i class="icon-material-outline-group"></i></span>
                                                <span class="notification-text">
                                                    <strong>Michael Shannah</strong> applied for a job <span class="color">Full Stack Software Engineer</span>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                    </div>
                    
                    <!-- Messages -->
                    <div class="header-notifications">
                        <div class="header-notifications-trigger">
                            <a href="#"><i class="icon-feather-mail"></i><span>3</span></a>
                        </div>

                        <!-- Dropdown -->
                        <div class="header-notifications-dropdown">

                            <div class="header-notifications-headline">
                                <h4>Messages</h4>
                                <button class="mark-as-read ripple-effect-dark" title="Mark all as read" data-tippy-placement="left">
                                    <i class="icon-feather-check-square"></i>
                                </button>
                            </div>

                            <div class="header-notifications-content">
                                <div class="header-notifications-scroll" data-simplebar>
                                    <ul>
                                        <!-- Notification -->
                                        <li class="notifications-not-read">
                                            <a href="dashboard-messages.html">
                                                <span class="notification-avatar status-online"><img src="images/user-avatar-small-03.jpg" alt=""></span>
                                                <div class="notification-text">
                                                    <strong>David Peterson</strong>
                                                    <p class="notification-msg-text">Thanks for reaching out. I'm quite busy right now on many...</p>
                                                    <span class="color">4 hours ago</span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <a href="dashboard-messages.html" class="header-notifications-button ripple-effect button-sliding-icon">View All Messages<i class="icon-material-outline-arrow-right-alt"></i></a>
                        </div>
                    </div>

                </div>
                <!--  User Notifications / End -->

                <!-- User Menu -->

                <div class="header-widget">

                    <!-- Messages -->
                    <div class="header-notifications user-menu">
                        <div class="header-notifications-trigger">
                            <a href="#"><div class="user-avatar status-online"><img src="{{ asset('images/user_profiles/'.Auth::user()->id.'/'.Auth::user()->user_image) }}" height="100%" alt="{{ Auth::user()->name }}"></div></a>
                        </div>

                        <!-- Dropdown -->
                        <div class="header-notifications-dropdown">

                            <!-- User Status -->
                            <div class="user-status">

                                <!-- User Name / Avatar -->
                                <div class="user-details">
                                    <div class="user-avatar status-online"><img src="{{ asset('images/user_profiles/'.Auth::user()->id.'/'.Auth::user()->user_image) }}" height="100%" alt=""></div>
                                    <div class="user-name">
                                        {{ Auth::user()->name }} 
                                        @if(Auth::user()->type==1)
                                            <span>Super Admin</span>
                                            @elseif(Auth::user()->type==2)
                                             <span>Seeker</span>
                                             @else
                                             <span>Recruiter</span>
                                             @endif
                                    </div>
                                </div>
                        </div>
                        
                        <ul class="user-menu-small-nav">
                            <li><a href="{{ route('admin') }}"><i class="icon-material-outline-dashboard"></i> Dashboard</a></li>
                            <li><a href="{{ route('account_setting') }}"><i class="icon-material-outline-settings"></i> Settings</a></li>
                            <li>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="icon-material-outline-power-settings-new"></i>
                            {{ __('Logout') }} 
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        </li>
                    </ul>

                        </div>
                    </div>

                </div>
                @endguest
                <!-- User Menu / End -->
            </div>
            <!-- Right Side Content / End -->

        </div>