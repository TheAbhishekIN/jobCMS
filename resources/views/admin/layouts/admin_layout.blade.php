<!doctype html>
<html lang="en">
<head>

@include('admin.include.head')

@yield('extra-head-content')

</head>
<body class="gray">

<!-- Wrapper -->
<div id="wrapper">

<!-- Header Container
================================================== -->
@include('admin.include.header')

<!-- Header Container / End -->


<!-- Dashboard Container -->
<div class="dashboard-container">
@include('admin.include.sidebar')


		<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >

@yield('content')
	<!-- Footer -->
			<div class="dashboard-footer-spacer"></div>
			<div class="small-footer margin-top-15">
				<div class="small-footer-copyrights">
					© 2019 <strong>Find Freelancer</strong>. All Rights Reserved. A Project made with <i class="icon-material-outline-favorite" style="color: #f51212;"></i> By <a href="https://softprogrammers.com" target="_blank">SoftProgrammers</a>
				</div>
				<ul class="footer-social-links">
					<li>
						<a href="#" title="Facebook" data-tippy-placement="top">
							<i class="icon-brand-facebook-f"></i>
						</a>
					</li>
					<li>
						<a href="#" title="Twitter" data-tippy-placement="top">
							<i class="icon-brand-twitter"></i>
						</a>
					</li>
					<li>
						<a href="#" title="Google Plus" data-tippy-placement="top">
							<i class="icon-brand-google-plus-g"></i>
						</a>
					</li>
					<li>
						<a href="#" title="LinkedIn" data-tippy-placement="top">
							<i class="icon-brand-linkedin-in"></i>
						</a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<!-- Footer / End -->

		</div>
	</div>
</div>
<!-- Dashboard Container / End -->

</div>
<!-- Wrapper / End -->

@include('admin.include.footer')


	@if(Session::has('message'))
	
	<script>
// Snackbar for user status switcher
$('#snackbar-user-status label').click(function() { 
    Snackbar.show({
        text: '{{ Session::get('message') }}',
        pos: 'bottom-center',
        showAction: false,
        actionText: "Dismiss",
        duration: 3000,
        textColor: '#fff',
        backgroundColor: '#383838'
    }); 
}); 
</script>

{{-- <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p> --}}
@endif

@yield('scripts')

</body>
</html>