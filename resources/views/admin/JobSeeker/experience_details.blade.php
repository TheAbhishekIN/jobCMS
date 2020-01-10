@extends('admin.layouts.admin_layout')
@section('title')Education Details @endsection

@section('content')

<!-- Dashboard Headline -->
<div class="dashboard-headline">
	<h3>Experiance Details</h3>

	<!-- Breadcrumbs -->
	<nav id="breadcrumbs" class="dark">
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">Dashboard</a></li>
			<li>Experiance Details</li>
		</ul>
	</nav>
</div>

<!-- Dashboard Box -->

<div class="row" id="dataDiv">

	<!-- Dashboard Box -->
	<div class="col-xl-12">
		<div class="dashboard-box margin-top-0">

			<!-- Headline -->
			<div class="headline">
				<div class="row">
					<div class="col-xl-10">
						<h3><i class="icon-material-outline-business-center"></i> Experience Details</h3>
					</div>
					<div class="col-xl-2">
					<a href="{{ route('add_experience') }}" class="button ripple-effect button-sliding-icon">Add<i class="icon-material-outline-add"></i></a>
					</div>
				</div>
			</div>

			<div class="content">
				<ul class="dashboard-box-list">
					@if(count($experience_details)>0)
					@foreach($experience_details as $experience_detail)
					<li>
						<!-- Job Listing -->
						<div class="job-listing">

							<!-- Job Listing Details -->
							<div class="job-listing-details">

								<!-- Details -->
								<div class="job-listing-description">
									<h3 class="job-listing-title"><a href="#">{{$experience_detail->job_title}}</a> <span class="dashboard-status-button green">{{$experience_detail->company_name}}</span></h3>

									<!-- Job Listing Footer -->
									<div class="job-listing-footer">
										<ul>
											<li><i class="icon-material-outline-date-range"></i> From Date :{{$experience_detail->start_date}}</li>
											<li><i class="icon-material-outline-date-range"></i>
												@if(!empty($experience_detail->end_date))
												To Date :{{$experience_detail->end_date}}
												@else
												To Date :Current Job
												@endif
											</li>
											<li><i class="icon-material-outline-location-on"></i> {{$experience_detail->city.', '.$experience_detail->country}} </li>
										</ul>
									</div>
									<div class="job-listing-footer">
										{!! $experience_detail->description!!}
									</div>
								</div>
							</div>
						</div>

						<!-- Buttons -->
						<div class="buttons-to-right always-visible">
						<a href="{{ route('edit_experience',$experience_detail->exp_id) }}" data-tippy-placement="top" data-tippy="" data-original-title="Edit"><i style="color:#2a41e8" class="icon-feather-edit"></i></a>
							
						<form action="{{ route('delete_experience', $experience_detail->exp_id)}}" method="post">
								@csrf
								@method('DELETE')
								<button class="red ripple-effect" type="submit"title="Remove" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></button>
							  </form>
						</div>
					</li>
					@endforeach
					@else
					<li class="text-center">No Data Found!</li>
					@endif
				</ul>
			</div>
		</div>
	</div>
</div>

@endsection