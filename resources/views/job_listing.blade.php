@extends('layouts.app')
@section('title')Job Listing @endsection
@section('content')

<!-- Spacer -->
<div class="margin-top-90"></div>
    <!-- Page Content
================================================== -->
<div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="sidebar-container">
                    <form action="{{route('job_listing')}}" method="GET">

                        <!-- Location -->
                        <div class="sidebar-widget">
                            <h3>Location</h3>
                            <div class="input-with-icon">
                                <div id="autocomplete-container">
                                    <input id="autocomplete-input" type="text" placeholder="Location" name="location">
                                </div>
                                <i class="icon-material-outline-location-on"></i>
                            </div>
                        </div>

                        <!-- Keywords -->
                        <div class="sidebar-widget">
                            <h3>Keywords</h3>
                            <div class="keywords-container">
                                <div class="keyword-input-container">
                                    <input type="text" class="keyword-input" placeholder="e.g. job title"/>
                                    <button class="keyword-input-button ripple-effect"><i class="icon-material-outline-add"></i></button>
                                </div>
                                <div class="keywords-list"><!-- keywords go here --></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="sidebar-widget">
                            <h3>Category</h3>
                            <select class="selectpicker default" multiple data-selected-text-format="count" data-size="7" title="All Categories" name="cat">

                                @foreach ($job_categories as $category )
                                <option value="{{$category->id}}">{{$category->job_category}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Job Types -->
                        <div class="sidebar-widget">
                            <h3>Job Type</h3>

                            <div class="switches-list">
                                <div class="switch-container">
                                    <label class="switch"><input type="checkbox" name="type[]"><span class="switch-button"></span> Freelance</label>
                                </div>

                                <div class="switch-container">
                                    <label class="switch"><input type="checkbox" name="type[]"><span class="switch-button"></span> Full Time</label>
                                </div>

                                <div class="switch-container">
                                    <label class="switch"><input type="checkbox" name="type[]"><span class="switch-button"></span> Part Time</label>
                                </div>

                                <div class="switch-container">
                                    <label class="switch"><input type="checkbox" name="type[]"><span class="switch-button"></span> Internship</label>
                                </div>
                                <div class="switch-container">
                                    <label class="switch"><input type="checkbox" name="type[]"><span class="switch-button"></span> Temporary</label>
                                </div>
                            </div>

                        </div>

                        <!-- Salary -->
                        <div class="sidebar-widget">
                            <h3>Salary</h3>
                            <div class="margin-top-55"></div>

                            <!-- Range Slider -->
                            <input class="range-slider" type="text" value="" data-slider-currency="$" data-slider-min="1500" data-slider-max="15000" data-slider-step="100" data-slider-value="[1500,15000]" name="salary" />
                        </div>
                        <div class="sidebar-widget">
                            <button class="button ripple-effect" type="submit">Apply</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 content-left-offset">
    
                <h3 class="page-title">Search Results</h3>
    
                <div class="notify-box margin-top-15">
                    <div class="switch-container">
                        <label class="switch"><input type="checkbox"><span class="switch-button"></span><span class="switch-text">Turn on email alerts for this search</span></label>
                    </div>
    
                    <div class="sort-by">
                        <span>Sort by:</span>
                        <select class="selectpicker hide-tick">
                            <option>Relevance</option>
                            <option>Newest</option>
                            <option>Oldest</option>
                            <option>Random</option>
                        </select>
                    </div>
                </div>
    
                <div class="listings-container margin-top-35">

                    @foreach ($jobs as $job)
                   
                    <!-- Job Listing -->
                    <a href="{{route('single_job',$job->id)}}" class="job-listing">
    
                        <!-- Job Listing Details -->
                        <div class="job-listing-details">
                            <!-- Logo -->
                            <div class="job-listing-company-logo">
                                <img src="{{$job->company_profile}}" alt="">
                            </div>
    
                            <!-- Details -->
                            <div class="job-listing-description">
                            <h4 class="job-listing-company">{{$job->company_name}}<span class="verified-badge" title="Verified Employer" data-tippy-placement="top"></span></h4>
                                <h3 class="job-listing-title">{{$job->job_title}}</h3>
                                <p class="job-listing-text">{{substr($job->job_description,0,200)}} <strong class="color">Read More..</strong></p>
                            </div>
    
                            <!-- Bookmark -->
                            <span class="bookmark-icon"></span>
                        </div>
    
                        <!-- Job Listing Footer -->
                        <div class="job-listing-footer">
                            <ul>
                                <li><i class="icon-material-outline-location-on"></i> {{$job->city.', '.$job->country}}</li>
                                <li><i class="icon-material-outline-business-center"></i>{{ Config::get('jobfinder.jobType.'.$job->job_type_id) }}</li>
                            <li><i class="icon-material-outline-account-balance-wallet"></i>{{'$'.$job->min_salary.' - $'.$job->max_salary}}</li>
                                <li><i class="icon-material-outline-access-time"></i>{{_get_days(time(),strtotime($job->publish_date))}} days ago</li>
                            </ul>
                        </div>
                    </a>
                    @endforeach
                    
                    <!-- Pagination -->
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Pagination -->
                            <div class="pagination-container margin-top-30 margin-bottom-60">
                                <nav class="pagination">
                                        {{ $jobs->onEachSide(5)->links() }}
                                    {{-- <ul>
                                        <li class="pagination-arrow"><a href="#"><i class="icon-material-outline-keyboard-arrow-left"></i></a></li>
                                        <li><a href="#">1</a></li>
                                        <li><a href="#" class="current-page">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li class="pagination-arrow"><a href="#"><i class="icon-material-outline-keyboard-arrow-right"></i></a></li>
                                    </ul> --}}
                                </nav>
                            </div>
                        </div>
                    </div>
                    <!-- Pagination / End -->
    
                </div>
    
            </div>
        </div>
    </div>
    
@endsection