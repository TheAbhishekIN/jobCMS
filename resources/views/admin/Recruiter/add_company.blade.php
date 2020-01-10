@extends('admin.layouts.admin_layout')
@section('title')Add Company Details @endsection

@section('content')

<!-- Dashboard Headline -->
<div class="dashboard-headline">
	<h3>Add Company Details</h3>

	<!-- Breadcrumbs -->
	<nav id="breadcrumbs" class="dark">
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">Company</a></li>
			<li>Add Company Details</li>
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
						<h3><i class="icon-material-outline-school"></i>Add Company Details</h3>
					</div>
				</div>
			</div>


			<div class="content">
				<div class="container" style="padding:10px">
					<form enctype="multipart/form-data" action="{{route('store_company')}}" method="post">
							@csrf

							<div class="row">
								<div class="col-xl-6">
									<div class="submit-field" id="company_name">
										<h5>Company Name <span style="color:red;">*</span></h5>
										<input type="text" name="company_name" class="with-border" value="{{ old('company_name') }}" placeholder="Example, Inc.">
										@error('company_name')
										<p style="color:red">{{ $message}}</p>
										@enderror

									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field"  id="business_stream">
										<h5>Business Stream <span style="color:red;">*</span></h5>

										<select name="business_stream" class="with-border" id="" style="padding:0px 20px">
											<option value="">Select Business Stream</option>
											@foreach($biz_streams as $id => $biz_stream)
										
											<option value="{{$biz_stream}}"{{ (old("business_stream") == $biz_stream ? "selected":"") }}>{{$id}}</option>
											
											@endforeach
										</select>
										@error('business_stream')
										<p style="color:red">{{ $message}}</p>
										@enderror

									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xl-6">
									<div class="submit-field" id="contact_email_id">
										<h5>Contact Email <span style="color:red;">*</span></h5>
										<input type="email" name="contact_email_id" class="with-border" value="{{ old('contact_email_id') }}" placeholder="example@example.com">
									@error('contact_email_id')
										<p style="color:red">{{ $message}}</p>
										@enderror
									</div>
								</div>
								<div class="col-xl-6">
									<div class="submit-field" id="contact_mobile">
										<h5>Contact Number <small>with country code</small></h5>
										<input type="text" name="contact_mobile" class="with-border" value="{{ old('contact_mobile') }}" placeholder="+91-9988887788">
										@error('contact_mobile')
										<p style="color:red">{{ $message}}</p>
										@enderror
									</div>

								</div>
							</div>

							<div class="row">
								<div class="col-xl-6">
									<div class="submit-field" id="est_date">
										<h5>Establishment Date </h5>
										<input type="date" name="est_date" class="with-border" value="{{ old('est_date') }}" >
											@error('est_date')
										<p style="color:red">{{ $message}}</p>
										@enderror
									</div>
								</div>
								<div class="col-xl-6">
									<div class="submit-field"  id="website_url">
										<h5>Website URL<span style="color:red;">*</span></h5>
										<input type="url" name="website_url" class="with-border" value="{{ old('website_url') }}" placeholder="www.example.com">
											@error('website_url')
										<p style="color:red">{{ $message}}</p>
										@enderror
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-xl-6">
									<div class="submit-field">
										<h5>Location</h5>
										<div class="input-with-icon">
											<div id="autocomplete-container">
												<input id="autocomplete" class="with-border" type="text" name="location" value="" onFocus="geolocate()" placeholder="Type Address">

											</div>
											<i class="icon-material-outline-location-on"></i>
										</div>
										@error('location.country')
										<p style="color:red">The location field is required</p>
										@enderror
										
										<input type="hidden" name="location[street_addr1]" id="street_number">
										<input type="hidden" name="location[street_addr2]" id="route">
										<input type="hidden" name="location[city]" id="locality">
										<input type="hidden" name="location[state]" id="administrative_area_level_1">
										<input type="hidden" name="location[postal_code]" id="postal_code">
										<input type="hidden" name="location[country]" id="country">


									</div>
								</div>
										<div class="col-xl-6">
									<div class="submit-field"  id="company_profile">
										<h5>Upload Comapny Profile<span style="color:red;">*</span></h5>

										<div class="avatar-upload">
											<div class="avatar-edit">
												<input type='file' name="company_profile" id="imageUpload" accept=".png, .jpg, .jpeg" />
												<label for="imageUpload"></label>
											</div>
											<div class="avatar-preview">
												<div id="imagePreview" style="background-image: url('');">
												</div>
											</div>
										</div>
										@error('company_profile')
										<p style="color:red">{{ $message}}</p>
										@enderror
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xl-12">
									<div class="submit-field"  id="company_description">
										<h5>Comapny Description<span style="color:red;">*</span></h5>
										<textarea name="company_description" class="with-border" id="summary-ckeditor" cols="30" rows="4">{{ old('company_description') }}</textarea>

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
