@extends('admin.layouts.admin_layout')
@section('title')Comanies @endsection
@section('content')
<script>
	$(document).ready(function() {
    $('#companies').DataTable();
} );
</script>
	<!-- Dashboard Headline -->
<div class="dashboard-headline">
	<h3>Companies</h3>

	<!-- Breadcrumbs -->
	<nav id="breadcrumbs" class="dark">
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">Dashboard</a></li>
			<li>Companies</li>
		</ul>
	</nav>
</div>


<div class="row" id="dataDiv">

	<!-- Dashboard Box -->
	<div class="col-xl-12">
		<div class="dashboard-box margin-top-0">
			<div class="content" style="padding:10px">
				<table id="companies" class="table table-striped table-bordered" style="width:100%">
					<thead>
						<tr>
							<th width="5%">#</th>
							<th width="15%">Title</th>
							<th width="25%">Description</th>
							<th width="20%">Created By</th>
							<th width="20%">Location</th>
							<th width="5%">Status</th>
							<th width="10%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; if(count($companies)>0){?>
						@foreach($companies as $company)
						<tr>
							<td>{{ $i }}</td>
							<td>{{ $company->company_name }}</td>
							<td><div class="desc"></div>{{substr($company->company_description,0,50)}}</td>
							<td>{{ $company->name }}</td>
							<td>{{ $company->city.', '.$company->country }}</td>
							<td>
								@if($company->status==1)	
									<span style="background-color: green;padding:2px;margin:10px;color:#fff;border-radius: 5px">Approved</span>
								@elseif($company->status==2)
									<span style="background-color: #e45050;padding:2px;margin:10px;color:#fff;border-radius: 5px">UnApproved</span>
								@endif
							</td>
							<td>
								@if($company->status!=1)
										<a href="#" class=" ico" data-tippy-placement="top" style="margin-right:2px" data-tippy="" data-original-title="Approve" title="Approve"><i class="icon-material-outline-check"></i></a>
								@endif
										<a href="javascript:;" class=" ico" data-tippy-placement="top" style="margin-right:2px" data-tippy="" data-original-title="Reject" title="Reject"><i class="icon-feather-x"></i></a>
							</td>
						</tr>
						<?php $i++; ?>
						@endforeach
						<?php } ?>
					</tbody>
					<tfoot>
						<tr>
								<th width="5%">#</th>
							<th width="15%">Title</th>
							<th width="25%">Description</th>
							<th width="20%">Created By</th>
							<th width="20%">Location</th>
							<th width="5%">Status</th>
							<th width="10%">Action</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>

</div>

@endsection
@section('extra-footer-content')
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<script>
	$( document ).ready(function() {
		bootbox.prompt({
			title: "Explain reason for rejection.",
			inputType: 'textarea',
			callback: function (result) {
				console.log(result);
			}
		});
	});
	

</script>
@endsection