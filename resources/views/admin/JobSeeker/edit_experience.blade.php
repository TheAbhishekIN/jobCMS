@extends('admin.layouts.admin_layout')
@section('title')Edit Experience Details @endsection

@section('content')

<!-- Dashboard Headline -->
<div class="dashboard-headline">
	<h3>Edit Experience Details</h3>

	<!-- Breadcrumbs -->
	<nav id="breadcrumbs" class="dark">
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">Experiance</a></li>
			<li>Edit Experience Details</li>
		</ul>
	</nav>
</div>

<div class="row" id="dataDiv">

	<!-- Dashboard Box -->
	<div class="col-xl-12">
		<div class="dashboard-box margin-top-0">

			<!-- Headline -->
			<div class="headline">
				<div class="row">
					<div class="col-xl-10">
						<h3><i class="icon-material-outline-school"></i>Edit Experience Details</h3>
					</div>
				</div>
			</div>
			<div class="content">
				<div class="container" style="padding:10px">
						{{-- <form method="POST" action="{{ route('save_education') }}"> --}}
						<form method="POST" action="{{ route('update_experience',$experience_details->exp_id) }}" enctype="multipart/form-data">
							@csrf
							
							<div class="row">
								<div class="col-xl-6">
									<div class="submit-field"  id="job_title">
										<h5>Job Title <span style="color:red;">*</span></h5>
										<input onkeypress="error_remove();" type="text" name="job_title" class="with-border" value="{{ $experience_details->job_title }}" placeholder="Software Engineer">
										@error('job_title')
										<p style="color:red">{{ $message}}</p>
										@enderror
									</div>
								</div>
								<div class="col-xl-6">
									<div class="submit-field"  id="company_name">
										<h5>Company Name <span style="color:red;">*</span></h5>
										<input onkeypress="error_remove();" type="text" name="company_name" class="with-border" value="{{ $experience_details->company_name }}" placeholder="ACME">
										@error('company_name')
										<p style="color:red">{{ $message}}</p>
										@enderror
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xl-4">
									<div class="submit-field" id="start_date">
										<h5>Start Date <span style="color:red;">*</span></h5>
										<input onclick="error_remove();" type="date" name="start_date" class="with-border" value="{{ $experience_details->start_date }}">
										@error('start_date')
										<p style="color:red">{{ $message}}</p>
										@enderror
									</div>
								</div>
								<div class="col-xl-4">
									<div class="submit-field"  id="end_date">
										<h5>End Date <span style="color:red;">*</span></h5>
										<input onclick="error_remove();" type="date" name="end_date" class="with-border" value="{{ $experience_details->end_date }}">
										@error('end_date')
										<p style="color:red">{{ $message}}</p>
										@enderror
									</div>
								</div>
								<div class="col-xl-4">
										<div class="submit-field">
											<h5>Location <span style="color:red;">*</span></h5>
											<div class="input-with-icon">
												<div id="autocomplete-container">
													<input id="autocomplete" class="with-border" type="text" name="location" value="" onFocus="geolocate()" placeholder="Type Address">
	
												</div>
												<i class="icon-material-outline-location-on"></i>
											</div>
											@error('location.country')
											<p style="color:red">The location field is required</p>
											@enderror
											
										<input type="hidden" name="location[location_id]" value="{{ $experience_details->location_id }}">
											<input type="hidden" name="location[street_addr1]" id="street_number" value="{{ $experience_details->street_address }}">
											<input type="hidden" name="location[street_addr2]" id="route">
											<input type="hidden" name="location[city]" id="locality" value="{{ $experience_details->city }}">
											<input type="hidden" name="location[state]" id="administrative_area_level_1" value="{{ $experience_details->state }}">
											<input type="hidden" name="location[postal_code]" id="postal_code" value="{{ $experience_details->zip }}">
											<input type="hidden" name="location[country]" id="country" value="{{ $experience_details->country }}">
	
	
										</div>
									</div>
							</div>
							<div class="row">
									<div class="col-xl-12">
									<div class="submit-field" id="description">
										<h5>Description</h5>
									<textarea name="description" id="summary-ckeditor" class="with-border" cols="30" rows="1">{{ $experience_details->description }}</textarea>
										
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xl-3">
									<input id="submitBtn" class="button ripple-effect big margin-top-30" type="submit" value="Save"></div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	
	</div>
	
	@endsection
	@section('extra-footer-content')
	<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'summary-ckeditor' );
</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0WryOTFtOZSP_YbrTXz3fySobs2GTB9Y&libraries=places&callback=initAutocomplete"
	async defer></script>
<script src="{{asset('js/maps.js')}}"></script>
	@endsection