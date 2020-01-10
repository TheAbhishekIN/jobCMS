@extends('admin.layouts.admin_layout')
@section('title')Add Company Details @endsection

@section('content')

		<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Post a Job</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Dashboard</a></li>
						<li>Post a Job</li>
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
							<h3><i class="icon-feather-folder-plus"></i> Job Submission Form</h3>
						</div>
						<?php //pr(Config::get('jobfinder.jobType')); ?>
						<div class="content with-padding padding-bottom-10">
							<form action="{{ route('store_job') }}" method="POST">
								@csrf
							<div class="row">
								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Select Company<span style="color:red;">*</span></h5>

										<select name="company" class="with-border" id="" style="padding:0px 20px">
											<option value="">Select Company</option>
											@foreach($company as $company)
										
											<option value="{{$company->id}}"{{ (old("company") == $company->id ? "selected":"") }}>{{$company->company_name}}</option>
											
											@endforeach
										</select>
										@error('company')
										<p style="color:red">{{ $message}}</p>
										@enderror

									</div>
								</div>
								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Hide Company Name ?</h5>

										<select name="is_company_name_hidden" class="with-border" id="" style="padding:0px 20px">
											<option value="">Select Yes / No</option>
											
											<option value="1"{{ (old("is_company_name_hidden") == 1 ? "selected":"") }}>Yes</option>

											<option value="2"{{ (old("is_company_name_hidden") == 1 ? "selected":"") }}>No</option>
											
										</select>
										@error('is_company_name_hidden')
										<p style="color:red">{{ $message}}</p>
										@enderror

									</div>
								</div>
								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Publish Date</h5>
										<input type="date" name="publish_date" class="with-border" value="{{ old('publish_date') }}">
										@error('publish_date')
										<p style="color:red">{{ $message}}</p>
										@enderror

									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Job Title</h5>
										<input type="text" name="job_title" value="{{ old('job_title') }}" class="with-border" placeholder="Software Developer">
									</div>
										@error('job_title')
										<p style="color:red">{{ $message}}</p>
										@enderror
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Job Type</h5>

										<select name="job_type" class="with-border" style="padding:0px 20px">
											<option value="">Select Job Type</option>
											
											@foreach (Config::get('jobfinder.jobType') as $id => $job_type)
											
											<option value="{{ $id }}" {{ (old("job_type") == $id ? "selected":"") }}>{{ $job_type }}</option>
											@endforeach
										</select>
											@error('job_type')
										<p style="color:red">{{ $message}}</p>
										@enderror
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Job Category <span style="color:red;">*</span></h5>

										<select name="job_category" class="with-border" id="" style="padding:0px 20px">
											<option value="">Select Job Category</option>
											@foreach($job_category as $id => $job_category)
										
											<option value="{{$job_category}}"{{ (old("job_category") == $job_category ? "selected":"") }}>{{$id}}</option>
											
											@endforeach
										</select>
										@error('job_category')
										<p style="color:red">{{ $message}}</p>
										@enderror

									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Location</h5>
										<div class="input-with-icon">
											<div id="autocomplete-container">
												<input id="autocomplete" class="with-border" type="text" name="location" value="" onFocus="geolocate()" placeholder="Type Address">

											</div>
											<i class="icon-material-outline-location-on"></i>
										</div>
										@error('location.country')
										<p style="color:red">The Location Field is required</p>
										@enderror
										
										<input type="hidden" name="location[street_addr1]" id="street_number">
										<input type="hidden" name="location[street_addr2]" id="route">
										<input type="hidden" name="location[city]" id="locality">
										<input type="hidden" name="location[state]" id="administrative_area_level_1">
										<input type="hidden" name="location[postal_code]" id="postal_code">
										<input type="hidden" name="location[country]" id="country">


									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Salary <span>(per year)</span></h5>
										<div class="row">
											<div class="col-xl-6">
												<div class="input-with-icon">
													<input class="with-border" name="min_salary" type="text" placeholder="Min" value="{{ old('min_salary') }}">
													<i class="currency">USD</i>
												</div>
												@error('min_salary')
										<p style="color:red">{{ $message}}</p>
										@enderror
											</div>
											<div class="col-xl-6">
												<div class="input-with-icon">
													<input class="with-border" name="max_salary" type="text" placeholder="Max" value="{{ old('max_salary') }}">
													<i class="currency">USD</i>
												</div>
												@error('max_salary')
										<p style="color:red">{{ $message}}</p>
										@enderror
											</div>
										</div>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Tags <span>(optional)</span>  <i class="help-icon" data-tippy-placement="right" title="Maximum of 10 tags"></i></h5>
										<div class="keywords-container">
											<div class="keyword-input-container">
												<input type="text" name="tags" class="keyword-input with-border" placeholder="e.g. job title, responsibilites"/>
												<a class="keyword-input-button ripple-effect"><i class="icon-material-outline-add"></i></a>
												<div class="keywords-list"><!-- keywords go here -->
												{{ old('tags') }}
											</div>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xl-12">
										<div class="submit-field">
										<h5>Description</h5>
										<textarea class="with-border" id="summary-ckeditor" name="job_desc">{{ old('job_desc') }}</textarea>

									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xl-12">
										<div class="submit-field">
										<input type="submit" class="ripple-effect button-sliding-icon" value="Post">
									</div>
								</div>
							</div>

							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- Row / End -->
@endsection
@section('extra-footer-content')
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
CKEDITOR.replace( 'summary-ckeditor' );
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0WryOTFtOZSP_YbrTXz3fySobs2GTB9Y&libraries=places&callback=initAutocomplete"
async defer></script>
<script src="{{asset('js/maps.js')}}"></script>

<script>
	function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});
</script>
@endsection
