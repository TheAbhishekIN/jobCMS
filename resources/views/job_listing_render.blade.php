                    @foreach ($data as $job)
                   
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
                    

{!! $data->render() !!}