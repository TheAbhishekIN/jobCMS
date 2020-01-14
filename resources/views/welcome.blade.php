@extends('layouts.app')
@section('title')Home @endsection
@section('content')

<!-- Intro Banner
================================================== -->
<!-- add class "disable-gradient" to enable consistent background overlay -->
<div class="intro-banner" data-background-image="images/home-background.jpg">
    <div class="container">
        
        <!-- Intro Headline -->
        <div class="row">
            <div class="col-md-12">
                <div class="banner-headline">
                    <h3>
                        <strong>Hire experts or be hired for any job, any time.</strong>
                        <br>
                        <span>Thousands of small businesses use <strong class="color">JobFinder</strong> to turn their ideas into reality.</span>
                    </h3>
                </div>
            </div>
        </div>
        
        <!-- Search Bar -->
        <div class="row">
                <form action="{{route('job_listing')}}" method="GET">
                    {{-- @csrf --}}
            <div class="col-md-12">
                <div class="intro-banner-search-form margin-top-95">
                
                
                    <!-- Search Field -->
                    <div class="intro-search-field with-autocomplete">
                        <label for="autocomplete-input" class="field-title ripple-effect">Where?</label>
                        <div class="input-with-icon">
                            <input id="autocomplete-input" type="text" name="location" placeholder="Online Job">
                            <i class="icon-material-outline-location-on"></i>
                        </div>
                    </div>

                    <!-- Search Field -->
                    <div class="intro-search-field">
                        <label for ="intro-keywords" class="field-title ripple-effect">What job you want?</label>
                        <input id="intro-keywords" type="text" name="type" placeholder="Job Title or Keywords">
                    </div>

                    <!-- Button -->
                    <div class="intro-search-button">
                        <button class="button ripple-effect" onclick="window.location.href='jobs-list-layout-full-page-map.html'">Search</button>
                    </div>
                
                </div>
            </div>
        </form>
        </div>

        <!-- Stats -->
        <div class="row">
            <div class="col-md-12">
                <ul class="intro-stats margin-top-45 hide-under-992px">
                    <li>
                    <strong class="counter">{{$numbers['total_jobs']}}</strong>
                        <span>Jobs Posted</span>
                    </li>
                    <li>
                        <strong class="counter">{{$numbers['total_seeker']}}</strong>
                        <span>Job Seeker Registred</span>
                    </li>
                    <li>
                        <strong class="counter">{{$numbers['total_companies']}}</strong>
                        <span>Companies Registred</span>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>


<!-- Content
================================================== -->
<!-- Category Boxes -->
<div class="section margin-top-65">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">

                <div class="section-headline centered margin-bottom-15">
                    <h3>Popular Job Categories</h3>
                </div>

                <!-- Category Boxes Container -->
                <div class="categories-container">

                    <!-- Category Box -->
                    @foreach ($job_categories as $job_category)
                        
                    <a href="#" class="category-box">
                        <div class="category-box-icon">
                            <i class="{{$job_category['icon']}}"></i>
                        </div>
                    <div class="category-box-counter">{{$job_category['total_jobs']}}</div>
                        <div class="category-box-content">
                            <h3>{{$job_category['title']}}</h3>
                            <p>{{$job_category['desc']}}</p>
                        </div>
                    </a>
                    @endforeach
                 
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Category Boxes / End -->


<!-- Features Jobs -->
<div class="section gray margin-top-45 padding-top-65 padding-bottom-75">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                
                <!-- Section Headline -->
                <div class="section-headline margin-top-0 margin-bottom-35">
                    <h3>Featured Jobs</h3>
                    <a href="{{ route('job_listing') }}" class="headline-link">Browse All Jobs</a>
                </div>
                
                <!-- Jobs Container -->
                <div class="listings-container compact-list-layout margin-top-35">
                    @foreach ($jobs as $job)
                   
                    <!-- Job Listing -->
                    <a href="#" class="job-listing with-apply-button">

                        <!-- Job Listing Details -->
                        <div class="job-listing-details">

                            <!-- Logo -->
                            <div class="job-listing-company-logo">
                            <img src="{{asset($job->company_profile)}}" alt="">
                            </div>

                            <!-- Details -->
                            <div class="job-listing-description">
                            <h3 class="job-listing-title">{{$job->job_title}}</h3>

                                <!-- Job Listing Footer -->
                                <div class="job-listing-footer">
                                    <ul>
                                        <li><i class="icon-material-outline-business"></i> {{$job->company_name}} <div class="verified-badge" title="Verified Employer" data-tippy-placement="top"></div></li>
                                        <li><i class="icon-material-outline-location-on"></i> {{$job->city.', '.$job->country}}</li>
                                        <li><i class="icon-material-outline-business-center"></i>{{ Config::get('jobfinder.jobType.'.$job->job_type_id) }}</li>
                                        <li><i class="icon-material-outline-access-time"></i> {{$job->publish_date}}</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Apply Button -->
                            <span class="list-apply-button ripple-effect">Apply Now</span>
                        </div>
                    </a>    
     
                    @endforeach

                </div>
                <!-- Jobs Container / End -->

            </div>
        </div>
    </div>
</div>
<!-- Featured Jobs / End -->


<!-- Features Cities -->
<div class="section margin-top-65 margin-bottom-65">
    <div class="container">
        <div class="row">

            <!-- Section Headline -->
            <div class="col-xl-12">
                <div class="section-headline centered margin-top-0 margin-bottom-45">
                    <h3>Featured Cities</h3>
                </div>
            </div>

            @foreach ($featured_city as $key=> $city)
            <div class="col-xl-3 col-md-6">
                <a href="#" class="photo-box" data-background-image="images/featured-city-0{{$key+1}}.jpg">
                    <div class="photo-box-content">
                    <h3>{{ $city['city']}}</h3>
                        <span>{{ $city['jobs'] }} Jobs</span>
                    </div>
                </a>
            </div>
              
            @endforeach
            
        </div>
    </div>
</div>
<!-- Features Cities / End -->


<!-- Highest Rated Freelancers -->
<div class="section gray padding-top-65 padding-bottom-70 full-width-carousel-fix">
    <div class="container">
        <div class="row">

            <div class="col-xl-12">
                <!-- Section Headline -->
                <div class="section-headline margin-top-0 margin-bottom-25">
                    <h3>Highest Rated Companies</h3>
                    <a href="{{ route('companies_listing') }}" class="headline-link">Browse All Companies</a>
                </div>
            </div>

            <div class="col-xl-12">
                    <div class="companies-list">
                    @foreach ($companies as $company )
                       
                        <a href="#" class="company">
                            <div class="company-inner-alignment">
                                <span class="company-logo"><img src="{{asset($company->company_profile)}}" alt=""></span>
                                <h4>{{$company->company_name}}</h4>
                                <div><i class="icon-material-outline-location-on"></i> {{ $company->city }}, {{ $company->country }}</div>
                                
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>

        </div>
    </div>
</div>
<!-- Highest Rated Freelancers / End-->


<!-- Membership Plans -->
<div class="section padding-top-60 padding-bottom-75">
    <div class="container">
        <div class="row">

            <div class="col-xl-12">
                <!-- Section Headline -->
                <div class="section-headline centered margin-top-0 margin-bottom-35">
                    <h3>Membership Plans</h3>
                </div>
            </div>


            <div class="col-xl-12">

                <!-- Billing Cycle  -->
                <div class="billing-cycle-radios margin-bottom-70">
                    <div class="radio billed-monthly-radio">
                        <input id="radio-5" name="radio-payment-type" type="radio" checked>
                        <label for="radio-5"><span class="radio-label"></span> Billed Monthly</label>
                    </div>

                    <div class="radio billed-yearly-radio">
                        <input id="radio-6" name="radio-payment-type" type="radio">
                        <label for="radio-6"><span class="radio-label"></span> Billed Yearly <span class="small-label">Save 10%</span></label>
                    </div>
                </div>

                <!-- Pricing Plans Container -->
                <div class="pricing-plans-container">

                    <!-- Plan -->
                    <div class="pricing-plan">
                        <h3>Basic Plan</h3>
                        <p class="margin-top-10">One time fee for one listing or task highlighted in search results.</p>
                        <div class="pricing-plan-label billed-monthly-label"><strong>$19</strong>/ monthly</div>
                        <div class="pricing-plan-label billed-yearly-label"><strong>$205</strong>/ yearly</div>
                        <div class="pricing-plan-features">
                            <strong>Features of Basic Plan</strong>
                            <ul>
                                <li>1 Listing</li>
                                <li>30 Days Visibility</li>
                                <li>Highlighted in Search Results</li>
                            </ul>
                        </div>
                        <a href="#" class="button full-width margin-top-20">Buy Now</a>
                    </div>

                    <!-- Plan -->
                    <div class="pricing-plan recommended">
                        <div class="recommended-badge">Recommended</div>
                        <h3>Standard Plan</h3>
                        <p class="margin-top-10">One time fee for one listing or task highlighted in search results.</p>
                        <div class="pricing-plan-label billed-monthly-label"><strong>$49</strong>/ monthly</div>
                        <div class="pricing-plan-label billed-yearly-label"><strong>$529</strong>/ yearly</div>
                        <div class="pricing-plan-features">
                            <strong>Features of Standard Plan</strong>
                            <ul>
                                <li>5 Listings</li>
                                <li>60 Days Visibility</li>
                                <li>Highlighted in Search Results</li>
                            </ul>
                        </div>
                        <a href="#" class="button full-width margin-top-20">Buy Now</a>
                    </div>

                    <!-- Plan -->
                    <div class="pricing-plan">
                        <h3>Extended Plan</h3>
                        <p class="margin-top-10">One time fee for one listing or task highlighted in search results.</p>
                        <div class="pricing-plan-label billed-monthly-label"><strong>$99</strong>/ monthly</div>
                        <div class="pricing-plan-label billed-yearly-label"><strong>$1069</strong>/ yearly</div>
                        <div class="pricing-plan-features">
                            <strong>Features of Extended Plan</strong>
                            <ul>
                                <li>Unlimited Listings Listing</li>
                                <li>90 Days Visibility</li>
                                <li>Highlighted in Search Results</li>
                            </ul>
                        </div>
                        <a href="#" class="button full-width margin-top-20">Buy Now</a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<!-- Membership Plans / End-->
@endsection