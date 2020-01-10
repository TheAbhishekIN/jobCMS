	<div class="dashboard-sidebar">
		<div class="dashboard-sidebar-inner" data-simplebar>
			<div class="dashboard-nav-container">

				<!-- Responsive Navigation Trigger -->
				<a href="#" class="dashboard-responsive-nav-trigger">
					<span class="hamburger hamburger--collapse" >
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</span>
					<span class="trigger-title">Dashboard Navigation</span>
				</a>
				
				<!-- Navigation -->
				<div class="dashboard-nav">
					<div class="dashboard-nav-inner">

						<ul data-submenu-title="Start">
							<li class="{{ (Route::currentRouteName()=='admin') ? 'active' : '' }}"><a href="{{url('/admin')}}"><i class="icon-material-outline-dashboard"></i> Dashboard</a></li>
							<li class="{{ (Route::currentRouteName()=='messages') ? 'active' : '' }}"><a href="{{url('/messages')}}"><i class="icon-material-outline-question-answer"></i> Messages <span class="nav-tag">2</span></a></li>
							</ul>
						@if(Auth::user()->user_type_id==2)
					
							<ul data-submenu-title="Resume">
							<li class="{{ (Route::currentRouteName()=='resume') ? 'active' : '' }}"><a href="{{url('/resume')}}"><i class="icon-feather-file"></i> Resume </a></li>
							<li class="{{ (Route::currentRouteName()=='education_details') ? 'active' : '' }}"><a href="{{route('education_details')}}"><i class="icon-material-outline-school"></i> Education</a></li>
							<li class="{{ (Route::currentRouteName()=='experience_details') ? 'active' : '' }}"><a href="{{route('experience_details')}}"><i class="icon-material-outline-business-center"></i> Experience</a></li>
						</ul>
						<ul data-submenu-title="Job">
							<li><a href="#"><i class="icon-material-outline-loyalty"></i> Saved Job(s)</a></li>
							<li><a href="#"><i class="icon-feather-check-square"></i> Applied Job</a></li>
						</ul>
						@elseif(Auth::user()->user_type_id==3)
						
						<ul data-submenu-title="Organize and Manage">
							<li class="{{ (Route::currentRouteName()=='company_details') ? 'active' : '' }}"><a href="{{route('company_details')}}"><i class="icon-material-outline-business-center"></i> Company</a></li>
							<li  class="{{ (Route::currentRouteName()=='manage_jobs') ? 'active-submenu' : '' }}"><a href="#"><i class="icon-material-outline-business-center"></i> Jobs</a>
								<ul>
									<li class="{{ (Route::currentRouteName()=='manage_jobs') ? 'active' : '' }}"><a href="{{ route('manage_jobs') }}">Manage Jobs <span class="nav-tag">3</span></a></li>
									<li><a href="{{ route('manage_condidates') }}">Manage Candidates</a></li>
								</ul>	
							</li>
						</ul>
						@elseif(Auth::user()->user_type_id==1)
						
						<ul data-submenu-title="Organize and Manage">
							<li class="{{ (Route::currentRouteName()=='companies') ? 'active' : '' }}"><a href="{{route('companies')}}"><i class="icon-material-outline-business-center"></i> Companies</a></li>
							<li  class="{{ (Route::currentRouteName()=='manage_jobs') ? 'active-submenu' : '' }}"><a href="#"><i class="icon-material-outline-business-center"></i> Jobs</a>
								<ul>
									<li class="{{ (Route::currentRouteName()=='manage_jobs') ? 'active' : '' }}"><a href="{{ route('manage_jobs') }}">Manage Jobs <span class="nav-tag">3</span></a></li>
									<li><a href="{{ route('manage_condidates') }}">Manage Candidates</a></li>
								</ul>	
							</li>
						</ul>
						@else
					</ul>

						@endif
					

						<ul data-submenu-title="Account">
							<li  class="{{ (Route::currentRouteName()=='account_setting') ? 'active' : '' }}"><a href="{{route('account_setting')}}"><i class="icon-material-outline-settings"></i> Settings</a></li>
							<li class="{{ (Route::currentRouteName()=='logout') ? 'active' : '' }}"> <a href="{{ route('logout') }}"
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
				<!-- Navigation / End -->

			</div>
		</div>
	</div>