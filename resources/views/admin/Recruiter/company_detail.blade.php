@extends('admin.layouts.admin_layout')
@section('title')Company Details @endsection

<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('content')

<!-- Dashboard Headline -->
<div class="dashboard-headline">
	<h3>Company Details</h3>

	<!-- Breadcrumbs -->
	<nav id="breadcrumbs" class="dark">
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">Dashboard</a></li>
			<li>Company Details</li>
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
						<h3><i class="icon-material-outline-school"></i> Company Details</h3>
					</div>
					<div class="col-xl-2">
						<a href="{{ route('add_company') }}"  id="modalBtn" class="button ripple-effect button-sliding-icon">Add<i class="icon-material-outline-add"></i></a>
					</div>
				</div>
			</div>

			<div class="content">
				<ul class="dashboard-box-list">

					@if(count($company_detail)>0)
					@foreach($company_detail as $company_detail)
					<li>
						<!-- Job Listing -->
						<div class="job-listing">
							<!-- Job Listing Details -->
							<div class="job-listing-details">

								<!-- Details -->
								<div class="job-listing-description">
									<h3 class="job-listing-title"><a href="#">{{$company_detail->company_name}}</a> <span class="dashboard-status-button green">@if($company_detail->status==1) Active @else Deactive @endif</span></h3>
									<hr>
									<!-- Job Listing Footer -->
									<div class="job-listing-footer">
										<div class="row">
											<div class="col-xl-4">
												<ul class="list-group">
													<li>
														<i class="icon-feather-hash"></i>
										<?php 
											$_biz_stream = _field_val('business_streams','id',$company_detail->business_stream_id,'business_stream_name');
										?>
										{{$_biz_stream}}
													</li>
													<li>
														<i class="icon-feather-mail"></i>
												{{$company_detail->contact_mail_id}}
													</li>
													<li>
														@if($company_detail->contact_number!='')
												<li>
												<i class="icon-feather-phone-call"></i>
													{{$company_detail->contact_number}}
												</li>
											@endif
													</li>
												</ul>
											</div>
											<div class="col-xl-4">
												<ul class="list-group">
													<li><i class="icon-material-outline-date-range"></i> Est.: {{$company_detail->establishment_date}}</li>
											<li><i class="icon-feather-link"></i>
												{{$company_detail->website_url}}
											</li>
											<li>
												<i class="icon-material-outline-location-on"></i>
												{{ $company_detail->street_address.','.$company_detail->city.'-'.$company_detail->zip.', '.$company_detail->state.', '.$company_detail->country }}
											</li>
												</ul>
											</div>
											<div class="col-xl-4">
												<div class="avatar-upload" >
								
											<div class="avatar-preview" >
												<div id="imagePreview" style="background-image: url('{{asset($company_detail->company_profile)}}');">
												</div>
											</div>
										</div>
											</div>
										</div>

										
									</div>
									<hr>
									<div class="job-listing-footer text-justify">
										{!! $company_detail->company_description !!}
									</div>
								</div>
							</div>
						</div>

						<!-- Buttons -->
						<div class="buttons-to-right always-visible">
						<a href="{{ route('edit_company',$company_detail->id) }}" data-tippy-placement="top" data-tippy="Edit" data-original-title="Edit" title="Edit"><i style="color:#2a41e8" class="icon-feather-edit"></i></a>
							<a href="#" data-tippy-placement="top" onclick="delete_company('{{$company_detail->id}}');" data-tippy="Delete" data-original-title="Remove" title="Delete"><i style="color:red" class="icon-feather-trash-2"></i></a>
						</div>
					</li>
					@endforeach
					@else
					<li>Please Add A Company!</li>
					@endif
				</ul>
			</div>
		</div>
	</div>
</div>

@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>

function delete_company(id){

	Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.value==true) {
  		 $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax(
    {
        url: "/delete_company/"+id,
        type: 'delete', // replaced from put
        dataType: "JSON",
        data: {
            "id": id // method and token not needed in data
        },
        success: function (response)
        {
            location.reload();
        },
        error: function(xhr) {
         console.log(xhr.responseText); // this line will save you tons of hours while debugging
        // do something here because of error
       }
    });
    
  }
});
}

</script>
@endsection