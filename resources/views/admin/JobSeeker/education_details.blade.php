@extends('admin.layouts.admin_layout')
@section('title')Education Details @endsection

@section('content')

<!-- Dashboard Headline -->
<div class="dashboard-headline">
	<h3>Education Details</h3>

	<!-- Breadcrumbs -->
	<nav id="breadcrumbs" class="dark">
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">Dashboard</a></li>
			<li>Education Details</li>
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
						<h3><i class="icon-material-outline-school"></i> Education Details</h3>
					</div>
					<div class="col-xl-2">
					<a href="{{ route('add_education_details') }}" class="button ripple-effect button-sliding-icon">Add<i class="icon-material-outline-add"></i></a>
					</div>
				</div>
			</div>

			<div class="content">
				<ul class="dashboard-box-list">
				@if(count($education_details)>0)
					@foreach($education_details as $education_detail)

					<li>
						<!-- Job Listing -->
						<div class="job-listing">

							<!-- Job Listing Details -->
							<div class="job-listing-details">

								<!-- Details -->
								<div class="job-listing-description">
									<h3 class="job-listing-title"><a href="#">{{$education_detail->certificate_name}}({{$education_detail->major_stream}})</a> <span class="dashboard-status-button green">{{$education_detail->institute_name}}</span></h3>

									<!-- Job Listing Footer -->
									<div class="job-listing-footer">
										<ul>
											@if($education_detail->percentage)
											<li>
											{{$education_detail->percentage}} %
											</li>
											@endif
											<li><i class="icon-material-outline-date-range"></i> From Date :{{$education_detail->starting_date}}</li>
											<li><i class="icon-material-outline-date-range"></i>
												@if(!empty($education_detail->completion_date))
												To Date :{{$education_detail->completion_date}}
												@else
												To Date :Currently Studying
												@endif
											</li>
										</ul>
									</div>
									<div class="job-listing-footer">
										{!! $education_detail->description !!}
									</div>
								</div>
							</div>
						</div>

						<!-- Buttons -->
						<div class="buttons-to-right always-visible">
						<a href="{{ route('edit_education',$education_detail->id) }}" data-tippy-placement="top" data-tippy="" data-original-title="Edit"><i style="color:#2a41e8" class="icon-feather-edit"></i></a>
						<form action="{{ route('delete_edu', $education_detail->id)}}" method="post">
								@csrf
								@method('DELETE')
								<button type="submit"title="Remove" data-tippy-placement="top" style="padding: 16px;text-align: center;"><i class="icon-feather-trash-2"></i></button>
						</form>
						</div>
					</li>
					@endforeach
					@else
					<li>No Data found!</li>
					@endif
				</ul>
			</div>
		</div>
	</div>

</div>


@endsection
@section('additional_js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
// Get modal element
var modal = document.getElementById('simpleModal');
var modalBtn = document.getElementById('modalBtn');
var closeBtn = document.getElementsByClassName('closeBtn')[0];

modalBtn.addEventListener('click', openModal);
closeBtn.addEventListener('click', closeModal);
window.addEventListener('click', clickOutside);

function openModal(){
	modal.style.display = 'block';
	 $( "#add-form" ).load('{{route('add_education_details')}}');
}
function closeModal(){
	modal.style.display = 'none';
}
function clickOutside(e){
	if (e.target == modal) {
		
	modal.style.display = 'none';
	}
}

// modalBtn.addEventListener('click', editModal);

function edit_edu(id){
	modal.style.display = 'block';
	 $( "#add-form" ).load('http://127.0.0.1:8000/edit_education/'+id);
}
function delete_edu(id){

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
    	url: "/delete_edu/"+id,
        type: 'delete', // replaced from put
        dataType: "JSON",
        data: {
            "id": id // method and token not needed in data
        },
        success: function (response)
        {
            // location.reload();
            $("#dataDiv").load(" #dataDiv");
            Snackbar.show({
            	text: 'Data Deleted Successfully!',
            	pos: 'bottom-center',
            	showAction: false,
            	actionText: "Dismiss",
            	duration: 3000,
            	textColor: '#fff',
            	backgroundColor: '#383838'
            }); 
        },
        error: function(xhr) {
         console.log(xhr.responseText); // this line will save you tons of hours while debugging
        // do something here because of error
       }
    });
    
  }
});


	// alert(id);
	// modal.style.display = 'block';
	 // $( "#add-form" ).load('http://127.0.0.1:8000/edit_education/'+id);
}

</script>
@endsection