@extends('admin.layouts.admin_layout')
@section('title')Dashboard @endsection
@section('content')

			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Howdy,  {{ Auth::user()->name }}!</h3>
				<span>We are glad to see you again!</span>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li>Dashboard</li>
					</ul>
				</nav>
			</div>
	
			<!-- Fun Facts Container -->
			<div class="fun-facts-container">
				<div class="fun-fact" data-fun-fact-color="#36bd78">
					<div class="fun-fact-text">
						<span>Active Ads</span>
						<h4>{{ $active_jobs }}</h4>
					</div>
					<div class="fun-fact-icon"><i class="icon-material-baseline-notifications-none"></i></div>
				</div>
				<div class="fun-fact" data-fun-fact-color="#b81b7f">
					<div class="fun-fact-text">
						<span>New Ads</span>
						<h4>{{ $new_jobs }}</h4>
					</div>
					<div class="fun-fact-icon"><i class="icon-material-outline-info"></i></div>
				</div>
				<div class="fun-fact" data-fun-fact-color="#efa80f">
					<div class="fun-fact-text">
						<span>Total Users</span>
						<h4>{{ $total_users }}</h4>
					</div>
					<div class="fun-fact-icon"><i class="icon-material-outline-group"></i></div>
				</div>

				<!-- Last one has to be hidden below 1600px, sorry :( -->
					<div class="fun-fact" data-fun-fact-color="#2a41e6">
					<div class="fun-fact-text">
						<span>Total Income</span>
						<h4>987</h4>
					</div>
					<div class="fun-fact-icon"><i class="icon-feather-trending-up"></i></div>
				</div>
			</div>
			
			<!-- Row -->
			<div class="row">

				<div class="col-xl-8">
					<!-- Dashboard Box -->
					<div class="dashboard-box main-box-in-row">
						<div class="headline">
							<h3><i class="icon-feather-bar-chart-2"></i> Your Profile Views</h3>
							<div class="sort-by">
								<select class="selectpicker hide-tick">
									<option>Last 6 Months</option>
									<option>This Year</option>
									<option>This Month</option>
								</select>
							</div>
						</div>
						<div class="content">
							<!-- Chart -->
							<div class="chart">
								<canvas id="chart" width="100" height="45"></canvas>
							</div>
						</div>
					</div>
					<!-- Dashboard Box / End -->
				</div>
				<div class="col-xl-4">

					<!-- Dashboard Box -->
					<!-- If you want adjust height of two boxes 
						 add to the lower box 'main-box-in-row' 
						 and 'child-box-in-row' to the higher box -->
					<div class="dashboard-box child-box-in-row"> 
						<div class="headline">
							<h3><i class="icon-material-outline-note-add"></i> Notes</h3>
						</div>	

						<div class="content with-padding">
							<!-- Note -->
							<div class="dashboard-note">
								<p>Meeting with candidate at 3pm who applied for Bilingual Event Support Specialist</p>
								<div class="note-footer">
									<span class="note-priority high">High Priority</span>
									<div class="note-buttons">
										<a href="#" title="Edit" data-tippy-placement="top"><i class="icon-feather-edit"></i></a>
										<a href="#" title="Remove" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
									</div>
								</div>
							</div>
							<!-- Note -->
							<div class="dashboard-note">
								<p>Extend premium plan for next month</p>
								<div class="note-footer">
									<span class="note-priority low">Low Priority</span>
									<div class="note-buttons">
										<a href="#" title="Edit" data-tippy-placement="top"><i class="icon-feather-edit"></i></a>
										<a href="#" title="Remove" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
									</div>
								</div>
							</div>
							<!-- Note -->
							<div class="dashboard-note">
								<p>Send payment to David Peterson</p>
								<div class="note-footer">
									<span class="note-priority medium">Medium Priority</span>
									<div class="note-buttons">
										<a href="#" title="Edit" data-tippy-placement="top"><i class="icon-feather-edit"></i></a>
										<a href="#" title="Remove" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
									</div>
								</div>
							</div>
						</div>
							<div class="add-note-button">
								<a href="#small-dialog" class="popup-with-zoom-anim button full-width button-sliding-icon">Add Note <i class="icon-material-outline-arrow-right-alt"></i></a>
							</div>
					</div>
					<!-- Dashboard Box / End -->
				</div>
			</div>
			<!-- Row / End -->

			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-6">
					<div class="dashboard-box">
						<div class="headline">
							<h3><i class="icon-material-baseline-notifications-none"></i> Notifications</h3>
							<button class="mark-as-read ripple-effect-dark" data-tippy-placement="left" title="Mark all as read">
									<i class="icon-feather-check-square"></i>
							</button>
						</div>
						<div class="content">
							<ul class="dashboard-box-list">
								<li>
									<span class="notification-icon"><i class="icon-material-outline-group"></i></span>
									<span class="notification-text">
										<strong>Michael Shannah</strong> applied for a job <a href="#">Full Stack Software Engineer</a>
									</span>
									<!-- Buttons -->
									<div class="buttons-to-right">
										<a href="#" class="button ripple-effect ico" title="Mark as read" data-tippy-placement="left"><i class="icon-feather-check-square"></i></a>
									</div>
								</li>
								<li>
									<span class="notification-icon"><i class=" icon-material-outline-gavel"></i></span>
									<span class="notification-text">
										<strong>Gilber Allanis</strong> placed a bid on your <a href="#">iOS App Development</a> project
									</span>
									<!-- Buttons -->
									<div class="buttons-to-right">
										<a href="#" class="button ripple-effect ico" title="Mark as read" data-tippy-placement="left"><i class="icon-feather-check-square"></i></a>
									</div>
								</li>
								<li>
									<span class="notification-icon"><i class="icon-material-outline-autorenew"></i></span>
									<span class="notification-text">
										Your job listing <a href="#">Full Stack Software Engineer</a> is expiring
									</span>
									<!-- Buttons -->
									<div class="buttons-to-right">
										<a href="#" class="button ripple-effect ico" title="Mark as read" data-tippy-placement="left"><i class="icon-feather-check-square"></i></a>
									</div>
								</li>
								<li>
									<span class="notification-icon"><i class="icon-material-outline-group"></i></span>
									<span class="notification-text">
										<strong>Sindy Forrest</strong> applied for a job <a href="#">Full Stack Software Engineer</a>
									</span>
									<!-- Buttons -->
									<div class="buttons-to-right">
										<a href="#" class="button ripple-effect ico" title="Mark as read" data-tippy-placement="left"><i class="icon-feather-check-square"></i></a>
									</div>
								</li>
								<li>
									<span class="notification-icon"><i class="icon-material-outline-rate-review"></i></span>
									<span class="notification-text">
										<strong>David Peterson</strong> left you a <span class="star-rating no-stars" data-rating="5.0"></span> rating after finishing <a href="#">Logo Design</a> task
									</span>
									<!-- Buttons -->
									<div class="buttons-to-right">
										<a href="#" class="button ripple-effect ico" title="Mark as read" data-tippy-placement="left"><i class="icon-feather-check-square"></i></a>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>

				<!-- Dashboard Box -->
				<div class="col-xl-6">
					<div class="dashboard-box">
						<div class="headline">
							<h3><i class="icon-material-outline-assignment"></i> Orders</h3>
						</div>
						<div class="content">
							<ul class="dashboard-box-list">
								<li>
									<div class="invoice-list-item">
									<strong>Professional Plan</strong>
										<ul>
											<li><span class="unpaid">Unpaid</span></li>
											<li>Order: #326</li>
											<li>Date: 12/08/2018</li>
										</ul>
									</div>
									<!-- Buttons -->
									<div class="buttons-to-right">
										<a href="pages-checkout-page.html" class="button">Finish Payment</a>
									</div>
								</li>
								<li>
									<div class="invoice-list-item">
									<strong>Professional Plan</strong>
										<ul>
											<li><span class="paid">Paid</span></li>
											<li>Order: #264</li>
											<li>Date: 10/07/2018</li>
										</ul>
									</div>
									<!-- Buttons -->
									<div class="buttons-to-right">
										<a href="pages-invoice-template.html" class="button gray">View Invoice</a>
									</div>
								</li>
								<li>
									<div class="invoice-list-item">
									<strong>Professional Plan</strong>
										<ul>
											<li><span class="paid">Paid</span></li>
											<li>Order: #211</li>
											<li>Date: 12/06/2018</li>
										</ul>
									</div>
									<!-- Buttons -->
									<div class="buttons-to-right">
										<a href="pages-invoice-template.html" class="button gray">View Invoice</a>
									</div>
								</li>
								<li>
									<div class="invoice-list-item">
									<strong>Professional Plan</strong>
										<ul>
											<li><span class="paid">Paid</span></li>
											<li>Order: #179</li>
											<li>Date: 06/05/2018</li>
										</ul>
									</div>
									<!-- Buttons -->
									<div class="buttons-to-right">
										<a href="pages-invoice-template.html" class="button gray">View Invoice</a>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>

			</div>
			<!-- Row / End -->

			<!-- Footer -->
			{{-- <div class="dashboard-footer-spacer"></div>
			<div class="small-footer margin-top-15">
				<div class="small-footer-copyrights">
					© 2018 <strong>FindFreelancer</strong>. All Rights Reserved.
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
			</div> --}}
			<!-- Footer / End -->

	<!-- Dashboard Content / End -->
@endsection

@section('additional_js')
<script>
	Chart.defaults.global.defaultFontFamily = "Nunito";
	Chart.defaults.global.defaultFontColor = '#888';
	Chart.defaults.global.defaultFontSize = '14';

	var ctx = document.getElementById('chart').getContext('2d');

	var chart = new Chart(ctx, {
		type: 'line',

		// The data for our dataset
		data: {
			labels: ["January", "February", "March", "April", "May", "June"],
			// Information about the dataset
	   		datasets: [{
				label: "Views",
				backgroundColor: 'rgba(42,65,232,0.08)',
				borderColor: '#2a41e8',
				borderWidth: "3",
				data: [196,132,215,362,210,252],
				pointRadius: 5,
				pointHoverRadius:5,
				pointHitRadius: 10,
				pointBackgroundColor: "#fff",
				pointHoverBackgroundColor: "#fff",
				pointBorderWidth: "2",
			}]
		},

		// Configuration options
		options: {

		    layout: {
		      padding: 10,
		  	},

			legend: { display: false },
			title:  { display: false },

			scales: {
				yAxes: [{
					scaleLabel: {
						display: false
					},
					gridLines: {
						 borderDash: [6, 10],
						 color: "#d8d8d8",
						 lineWidth: 1,
	            	},
				}],
				xAxes: [{
					scaleLabel: { display: false },  
					gridLines:  { display: false },
				}],
			},

		    tooltips: {
		      backgroundColor: '#333',
		      titleFontSize: 13,
		      titleFontColor: '#fff',
		      bodyFontColor: '#fff',
		      bodyFontSize: 13,
		      displayColors: false,
		      xPadding: 10,
		      yPadding: 10,
		      intersect: false
		    }
		},


});

</script>
@endsection