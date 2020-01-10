@extends('admin.layouts.admin_layout')
@section('title')Account Setting @endsection
@section('content')

			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Settings</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Dashboard</a></li>
						<li>Settings</li>
					</ul>
				</nav>
			</div>
			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-account-circle"></i> My Account</h3>
						</div>
						<form action="{{route('update_user')}}" method="POST" enctype="multipart/form-data">
							@csrf
						<div class="content with-padding padding-bottom-0">

							<div class="row">
								<div class="col-auto">
									<div class="avatar-wrapper" data-tippy-placement="bottom" title="Change Avatar">
										<img class="profile-pic" src="{{ asset('images/user_profiles/'.Auth::user()->id.'/'.Auth::user()->user_image) }}" alt="" />
										<div class="upload-button"></div>
										<input class="file-upload" type="file" name="user_profile" accept="image/*"/>
									</div>
								</div>

								<div class="col">
									<div class="row">

										<div class="col-xl-6">
											<div class="submit-field">
												<h5>Full Name</h5>
												<input type="text" name="name" class="with-border" value="{{$user_details->name}}">
											</div>
										</div>

										<div class="col-xl-6">
											<div class="submit-field">
												<h5>Contact Number</h5>
												<input type="text" name="contact_number" class="with-border" value="{{$user_details->contact_number}}" disabled>
											</div>
										</div>

										<div class="col-xl-6">
											<!-- Account Type -->
											<div class="submit-field">
												<h5>Account Type</h5>
												<div class="account-type">
											
												@if(Auth::user()->user_type_id==1)

													<div>
														<input type="radio" name="user_type_id" id="freelancer-radio" class="account-type-radio" checked/>
														<label for="freelancer-radio" class="ripple-effect-dark"><i class="icon-material-outline-account-circle"></i> Super Admin</label>
													</div>
												@elseif(Auth::user()->user_type_id==2)
													<div>
														<input type="radio" name="user_type_id" id="employer-radio" class="account-type-radio"/>
														<label for="employer-radio" class="ripple-effect-dark"><i class="icon-material-outline-business-center"></i> Seeker</label>
													</div>
												@elseif(Auth::user()->user_type_id==3)
												
													<div>
														<input type="radio" name="user_type_id" id="employer-radio" class="account-type-radio"/>
														<label for="employer-radio" class="ripple-effect-dark"><i class="icon-material-outline-business-center"></i> Recruiter</label>
													</div>

												@endif

												</div>
											</div>
										</div>

										<div class="col-xl-6">
											<div class="submit-field">
												<h5>Email</h5>
												<input type="text" name="email" class="with-border" value="{{Auth::user()->email}}" disabled>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
				<!-- Button -->
				<div class="col-xl-12">
					<input type="submit" value="Save Changes" class="button ripple-effect big margin-top-30" >
					{{-- <a href="#" class="button ripple-effect big margin-top-30">Save Changes</a> --}}
				</div>
			</form>

			</div>
			<!-- Row / End -->

@endsection