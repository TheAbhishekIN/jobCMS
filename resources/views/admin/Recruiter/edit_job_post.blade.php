@extends('admin.layouts.admin_layout')
@section('title')Edit Job Details @endsection

@section('content')
		<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Edit Job Post</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Dashboard</a></li>
						<li>Edit Job</li>
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
							<h3><i class="icon-feather-folder-plus"></i> Edit Job Form</h3>
						</div>
						<?php //pr(Config::get('jobfinder.jobType')); ?>
						<div class="content with-padding padding-bottom-10">
							<form action="{{ route('update_job_post',$job_detail->id) }}" method="POST">
								@csrf
							<div class="row">
								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Select Company<span style="color:red;">*</span></h5>

										<select name="company" class="with-border" id="" style="padding:0px 20px">
											<option value="">Select Company</option>
											@foreach($company as $company)
										
											<option value="{{$company->id}}"{{ ($job_detail->company_id == $company->id ? "selected":"") }}>{{$company->company_name}}</option>
											
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
											
											<option value="1"{{ ($job_detail->is_company_name_hidden == 1 ? "selected":"") }}>Yes</option>

											<option value="2"{{ ($job_detail->is_company_name_hidden == 2 ? "selected":"") }}>No</option>
											
										</select>
										@error('is_company_name_hidden')
										<p style="color:red">{{ $message}}</p>
										@enderror

									</div>
								</div>
								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Publish Date</h5>
										<input type="date" name="publish_date" class="with-border" value="{{ $job_detail->publish_date }}">
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
										<input type="text" name="job_title" value="{{ $job_detail->job_title }}" class="with-border" placeholder="Software Developer">
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
											
											<option value="{{ $id }}" {{ ($job_detail->job_type_id == $id ? "selected":"") }}>{{ $job_type }}</option>
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
										
											<option value="{{$job_category}}"{{ ($job_detail->job_category_id == $job_category ? "selected":"") }}>{{$id}}</option>
											
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
									<input type="hidden" name="location[location_id]" value="{{ $job_detail->job_location_id }}">
										<input type="hidden" name="location[street_addr1]" id="street_number" value="{{ $job_detail->street_address }}">
										<input type="hidden" name="location[street_addr2]" id="route">
										<input type="hidden" name="location[city]" id="locality" value="{{ $job_detail->city }}">
										<input type="hidden" name="location[state]" id="administrative_area_level_1" value="{{ $job_detail->state }}">
										<input type="hidden" name="location[postal_code]" id="postal_code" value="{{ $job_detail->zip }}">
										<input type="hidden" name="location[country]" id="country" value="{{ $job_detail->country }}">


									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Salary <span>(per year)</span></h5>
										<div class="row">
											<div class="col-xl-6">
												<div class="input-with-icon">
													<input class="with-border" name="min_salary" type="text" placeholder="Min" value="{{ $job_detail->min_salary }}">
													<i class="currency">USD</i>
												</div>
												@error('min_salary')
										<p style="color:red">{{ $message}}</p>
										@enderror
											</div>
											<div class="col-xl-6">
												<div class="input-with-icon">
													<input class="with-border" name="max_salary" type="text" placeholder="Max" value="{{ $job_detail->max_salary }}">
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
										<textarea class="with-border" id="summary-ckeditor" name="job_desc">{{ $job_detail->job_description }}</textarea>

									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xl-12">
										<div class="row">
											<div class="col-xl-6">
													<button type="submit" class="button blue ripple-effect">Update</button>
											</div>
										<div class="col-xl-6 text-right">
												<a href="{{ route('manage_jobs') }}" class="button dark ripple-effect">Cancel</a>
										</div>
										
										
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
