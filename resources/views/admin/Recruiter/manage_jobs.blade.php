@extends('admin.layouts.admin_layout')
@section('title')Company Details @endsection

<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('content')

		<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Manage Jobs</h3>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Dashboard</a></li>
						<li>Manage Jobs</li>
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
							<div class="row">
								<div class="col-xl-6">
									<h3><i class="icon-material-outline-business-center"></i> My Job Listings</h3>
								</div>
								<div class="col-xl-6 text-right">
									<h3><a href="{{ route('job_post') }}" class="button ripple-effect">Post a Job</a></h3>
								</div>
							</div>
						</div>

						<div class="content">
							<ul class="dashboard-box-list">
								@if(count($total_jobs)>0)
								@foreach($total_jobs as $jobs)
								<li>
									<!-- Job Listing -->
									<div class="job-listing">

										<!-- Job Listing Details -->
										<div class="job-listing-details">
											<!-- Details -->
											<div class="job-listing-description">
												<h3 class="job-listing-title"><a href="#">{{ $jobs->job_title }}</a>

												@if($jobs->is_active==1)
												 <span class="dashboard-status-button green">
												 	Pending Approval
												 </span>
												@elseif($jobs->is_active==2)
												<span class="dashboard-status-button green">
													Active
												 </span>
												 @elseif($jobs->is_active==3)
												 <span class="dashboard-status-button yellow">
												 	Expiring
												 </span>
												 @elseif($jobs->is_active==4)
												 <span class="dashboard-status-button red">
												 	Expired
												 </span>
												 @endif
												
												</h3>

												<!-- Job Listing Footer -->
												<div class="job-listing-footer">
													<ul>
														<li><i class="icon-material-outline-date-range"></i> 
															@if($jobs->publish_date!=null) Posted on {{ date('F d, Y',strtotime($jobs->publish_date)) }} @else Not Posted Yet  @endif</li>
														<li><i class="icon-material-outline-date-range"></i> @if($jobs->publish_date!=null) Expiring on {{ job_exp_date($jobs->job_id) }} @endif</li>

													</ul>
													<ul>
														<li><i class="icon-material-outline-location-on"></i> 
															{{ $jobs->street_address.','.$jobs->city.'-'.$jobs->zip.', '.$jobs->state.', '.$jobs->country }}
														</li>
													</ul>
													<ul>
														<li><i class="icon-line-awesome-thumb-tack"></i> 
															{{ Config::get('jobfinder.jobType.'.$jobs->job_type_id) }}
														</li>
														<li><i class="icon-line-awesome-thumb-tack"></i>
															{{ $jobs->job_category }}
														</li>
													</ul>
													<ul style="margin: 20px 0px;">
														<li>
															<div class="accordion js-accordion" style="box-shadow:none;">

																<!-- Accordion Item -->
																<div class="accordion__item js-accordion-item">
																	<div class="accordion-header js-accordion-header" style="background: none;color:#66676b;">Description</div> 

																	<!-- Accordtion Body -->
																	<div class="accordion-body js-accordion-body" style="display: none;background:none">

																		<!-- Accordion Content -->
																		<div class="accordion-body__contents">
																			{!! $jobs->job_description !!}
																		</div>

																	</div>
																	<!-- Accordion Body / End -->
																</div>
																<!-- Accordion Item / End -->

															</div>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>

									<!-- Buttons -->
									<div class="buttons-to-right always-visible">
										<a href="dashboard-manage-candidates.html" class="button ripple-effect"><i class="icon-material-outline-supervisor-account"></i> Manage Candidates <span class="button-info">0</span></a>
									<a href="{{ route('edit_job_post',[$jobs->job_id]) }}" class="button gray ripple-effect " title="Edit" data-tippy-placement="top" style="padding: 16px;text-align: center;"><i class="icon-feather-edit"></i></a>
									
									
									<form action="{{ route('delete_job', $jobs->job_id)}}" method="post">
											@csrf
											@method('DELETE')
											<button class="button red ripple-effect" type="submit"title="Remove" data-tippy-placement="top" style="padding: 16px;text-align: center;"><i class="icon-feather-trash-2"></i></button>
										  </form>
									</div>
								</li>
								@endforeach
								@else
								<li>
									<div class="text-center">No record found!</div>
								</li>
								@endif
							</ul>
						</div>
					</div>
				</div>

			</div>
			<!-- Row / End -->

@endsection
