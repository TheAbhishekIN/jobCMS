@extends('admin.layouts.admin_layout')
@section('title')Add Education Details @endsection

@section('content')

<!-- Dashboard Headline -->
<div class="dashboard-headline">
	<h3>Add Education Details</h3>

	<!-- Breadcrumbs -->
	<nav id="breadcrumbs" class="dark">
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">Education</a></li>
			<li>Add Education Details</li>
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
						<h3><i class="icon-material-outline-school"></i>Add Education Details</h3>
					</div>
				</div>
			</div>
			<div class="content">
				<div class="container" style="padding:10px">
						<form action="{{ route('update_edu',$education_details->id) }}" enctype="multipart/form-data" method="POST">
							@csrf
							
							<div class="row">
								<div class="col-xl-6">
									<div class="submit-field" id="institute_name">
										<h5>University / Institute Name <span style="color:red;">*</span></h5>
										<input onkeypress="error_remove();" type="text" name="institute_name" class="with-border" placeholder="Ex. Rajasthan Technical University" value="{{$education_details->institute_name}}">
										@error('institute_name')
										<p style="color:red">{{ $message}}</p>
										@enderror
									</div>
								</div>
								<div class="col-xl-6">
									<div class="submit-field"  id="certificate_name">
										<h5>Degree <span style="color:red;">*</span></h5>
										<input onkeypress="error_remove();" type="text" name="certificate_name" class="with-border" value="{{$education_details->certificate_name}}" placeholder="Ex. B.Tech, BE etc">
										@error('certificate_name')
										<p style="color:red">{{ $message}}</p>
										@enderror
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xl-6">
									<div class="submit-field" id="major_stream">
										<h5>Stream <span style="color:red;">*</span></h5>
										<input onkeypress="error_remove();" type="text" name="major_stream" class="with-border" value="{{$education_details->major_stream}}" placeholder="Ex. Computer Science">
										@error('major_stream')
										<p style="color:red">{{ $message}}</p>
										@enderror
									</div>
								</div>
								<div class="col-xl-6">
									<div class="submit-field" id="percentage">
										<h5>Percentage / CGPA <span style="color:red;">*</span></h5>
										<input onkeypress="error_remove();" type="text" name="percentage" class="with-border" value="{{$education_details->percentage}}" placeholder="Ex. 81,8.5">
										@error('percentage')
										<p style="color:red">{{ $message}}</p>
										@enderror
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-xl-6">
									<div class="submit-field" id="starting_date">
										<h5>From Date <span style="color:red;">*</span></h5>
										<input onclick="error_remove();" type="date" name="starting_date" class="with-border" value="{{$education_details->starting_date}}" placeholder="Ex. Rajasthan Technical University">
										@error('starting_date')
										<p style="color:red">{{ $message}}</p>
										@enderror
									</div>
								</div>
								<div class="col-xl-6">
									<div class="submit-field"  id="completion_date">
										{{-- {{_date_format($education_details->completion_date)}} --}}
										<h5>To Date <span style="color:red;">*</span><small>(Leave empty for current!)</small></h5>
										<input onclick="error_remove();" type="date" name="completion_date" class="with-border" value="{{$education_details->completion_date}}" placeholder="Ex. B.Tech, BE etc">
										@error('completion_date')
										<p style="color:red">{{ $message}}</p>
										@enderror
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xl-12">
									<div class="submit-field"  id="completion_date">
										<h5>Description<span style="color:red;">*</span></h5>
									<textarea name="description" class="with-border" id="summary-ckeditor" cols="30" rows="2">{{ $education_details->description }}</textarea>

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
	
					
<!-- Add Edu Popup / End -->
					
<!-- Add Edu Popup / End -->