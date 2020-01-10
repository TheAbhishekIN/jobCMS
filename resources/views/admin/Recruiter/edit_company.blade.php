@extends('admin.layouts.admin_layout')
@section('title')Company Details @endsection

@section('content')

<!-- Dashboard Headline -->
<div class="dashboard-headline">
	<h3>Edit Company Details</h3>

	<!-- Breadcrumbs -->
	<nav id="breadcrumbs" class="dark">
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">Company</a></li>
			<li>Edit Company Details</li>
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
						<h3><i class="icon-material-outline-school"></i>Edit Company Details</h3>
					</div>
				</div>
			</div>


			<div class="content">
				<div class="container" style="padding:10px">
					<form enctype="multipart/form-data" action="{{route('update_company',[$company_detail->id])}}" method="post">
							@csrf

							<input type="hidden" name="old_file" value="{{$company_detail->company_profile}}">
							<input type="hidden" name="user_id" value="{{$company_detail->id}}">
							
							<div class="row">
								<div class="col-xl-6">
									<div class="submit-field" id="company_name">
										<h5>Company Name <span style="color:red;">*</span></h5>
										<input type="text" name="company_name" class="with-border" value="{{$company_detail->company_name}}" placeholder="Example, Inc.">
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
												@if($biz_stream==$company_detail->business_stream_id)
											<option value="{{$biz_stream}}" selected="selected">{{$id}}</option>
												@else
											<option value="{{$biz_stream}}">{{$id}}</option>
												@endif
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
										<input type="email" name="contact_email_id" class="with-border" value="{{$company_detail->contact_mail_id}}" placeholder="example@example.com">
									@error('contact_email_id')
										<p style="color:red">{{ $message}}</p>
										@enderror
									</div>
								</div>
								<div class="col-xl-6">
									<div class="submit-field" id="contact_mobile">
										<h5>Contact Number <small>with country code</small></h5>
										<input type="text" name="contact_mobile" class="with-border" value="{{$company_detail->contact_number}}" placeholder="+91-9988887788">
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
										<input type="date" name="est_date" class="with-border" value="{{_date_ymd($company_detail->establishment_date)}}" >
											@error('est_date')
										<p style="color:red">{{ $message}}</p>
										@enderror
									</div>
								</div>
								<div class="col-xl-6">
									<div class="submit-field"  id="website_url">
										<h5>Website URL<span style="color:red;">*</span></h5>
										<input type="url" name="website_url" class="with-border" value="{{$company_detail->website_url}}" placeholder="www.example.com">
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
												<input id="autocomplete" class="with-border" type="text" name="location" value="" onFocus="geolocate()" placeholder="Type Address" value="{{ $company_detail->street_address.','.$company_detail->city.'-'.$company_detail->zip.', '.$company_detail->state.', '.$company_detail->country }}">

											</div>
											<i class="icon-material-outline-location-on"></i>
										</div>
										@error('location.country')
										<p style="color:red">The location field is required</p>
										@enderror
										
										<input type="hidden" name="location[location_id]" value="{{ $company_detail->location_id }}">
										<input type="hidden" name="location[street_addr1]" id="street_number" value="{{ $company_detail->street_address }}">

										<input type="hidden" name="location[street_addr2]" id="route">
										<input type="hidden" name="location[city]" id="locality" value="{{ $company_detail->city }}">
										<input type="hidden" name="location[state]" id="administrative_area_level_1" value="{{ $company_detail->state }}">
										<input type="hidden" name="location[postal_code]" id="postal_code" value="{{ $company_detail->zip }}">
										<input type="hidden" name="location[country]" id="country" value="{{ $company_detail->country }}">


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
												<div id="imagePreview" style="background-image: url('{{asset($company_detail->company_profile)}}');">
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
										<textarea name="company_description" id="summary-ckeditor" class="with-border" id="" cols="30" rows="4">{{$company_detail->company_description}}</textarea>

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
