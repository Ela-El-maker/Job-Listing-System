<section class="section-box futured_jobs mt-20">
    <div class="container">
        <div class="text-center">
            <h2 class="section-title mb-10 wow animate__animated animate__fadeInUp">Featured Jobs</h2>
            <p class="font-lg color-text-paragraph-2 wow animate__animated animate__fadeInUp">Lorem ipsum dolor sit amet
                elit, sed do eiusmod tempor</p>
            <div class="list-tabs mt-40">
                <ul class="nav nav-tabs" role="tablist">
                    @forelse ($featuredCategories as $category)
                        <li><a class="{{ $loop->index === 0 ? 'active' : '' }}" id="nav-tab-job-{{ $category?->id }}"
                                href="#tab-job-{{ $category?->id }}" data-bs-toggle="tab" role="tab"
                                aria-controls="tab-job-{{ $category?->id }}"
                                aria-selected="true">{{ Str::limit($category?->name, 20, '...') }}</a></li>

                    @empty
                    @endforelse

                </ul>
            </div>
        </div>
        <div class="mt-70">
            <div class="tab-content" id="myTabContent-1">
                @forelse ($featuredCategories as $category)
                    <div class="tab-pane fade show {{ $loop->index === 0 ? 'active' : '' }}"
                        id="tab-job-{{ $category?->id }}" role="tabpanel"
                        aria-labelledby="tab-job-{{ $category?->id }}">


                        <div class="job-listings" style="font-family: 'Arial', sans-serif; padding: 20px 0;">
                            @php
                                $featuredJobs = $category
                                    ->jobs()
                                    ->where('is_featured', true)
                                    ->where('status', 'active')
                                    ->where('deadline', '>=', now())
                                    ->latest()
                                    ->take(8)
                                    ->get();
                            @endphp

                            <div class="row" style="display: flex; flex-wrap: wrap; margin: 0 -15px;">
                                @foreach ($featuredJobs as $job)
                                    <div class="col-lg-3 col-md-6 col-sm-12"
                                        style="padding: 15px; box-sizing: border-box;">
                                        <div class="job-card"
                                            style="border: 1px solid #eee; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); overflow: hidden; height: 100%; display: flex; flex-direction: column; background-color: #fff; transition: transform 0.2s, box-shadow 0.2s;">

                                            <!-- Company Info Section -->
                                            <div class="company-info"
                                                style="display: flex; align-items: center; padding: 15px; border-bottom: 1px solid #f0f0f0;">
                                                <div class="company-logo"
                                                    style="width: 50px; height: 50px; overflow: hidden; border-radius: 6px; margin-right: 12px; display: flex; align-items: center; justify-content: center; background-color: #f9f9f9;">
                                                    <div class="image-box">
                                                        <img src="{{ asset($job?->company?->logo) }}"
                                                            alt="{{ $job?->company?->name }}">
                                                    </div>

                                                    {{-- style="max-width: 100%; max-height: 100%; object-fit: contain;"> --}}
                                                </div>
                                                <div class="company-details">
                                                    <h5 style="margin: 0 0 5px 0; font-size: 14px; font-weight: 600;">
                                                        <a class="name-job"
                                                            href="company-details.html">{{ Str::limit($job?->company?->name, 17, '...') }}</a>
                                                    </h5>
                                                    <div style="font-size: 12px; color: #777;">
                                                        <i class="fa fa-map-marker" style="margin-right: 4px;"></i>
                                                        {{ formatLocation($job?->company?->companyCountry?->name, $job?->company?->companyState?->name) }}
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Job Details Section -->
                                            <div class="job-details"
                                                style="padding: 15px; flex-grow: 1; display: flex; flex-direction: column;">
                                                <h6><a
                                                        href="job-details.html">{{ Str::limit($job?->title, 20, '...') }}</a>
                                                </h6>

                                                <div
                                                    style="margin-bottom: 12px; display: flex; flex-wrap: wrap; align-items: center; gap: 10px;">
                                                    <span
                                                        style="display: inline-block; padding: 4px 10px; background-color: #f0f7ff; color: #3086e4; border-radius: 20px; font-size: 12px; font-weight: 500;">{{ $job?->jobType?->name }}</span>
                                                    <span
                                                        style="font-size: 12px; color: #888;">{{ $job->created_at->diffForHumans() }}</span>
                                                </div>

                                                <p
                                                    style="font-size: 13px; line-height: 1.5; color: #666; margin-bottom: 15px;">
                                                    {{ Str::limit(strip_tags($job?->description), 70, '...') }}
                                                </p>

                                                <!-- Skills Section -->
                                                <div class="skills"
                                                    style="margin-top: auto; display: flex; flex-wrap: wrap; gap: 5px;">
                                                    @foreach ($job?->skills->take(2) as $jobSkill)
                                                        <span
                                                            style="display: inline-block; padding: 3px 8px; background-color: #f5f5f5; border-radius: 4px; font-size: 11px; color: #555;">
                                                            {{ $jobSkill?->skill?->name }}
                                                        </span>
                                                    @endforeach

                                                    @if ($job?->skills->count() > 2)
                                                        <span
                                                            style="display: inline-block; padding: 3px 8px; background-color: #f5f5f5; border-radius: 4px; font-size: 11px; color: #555; cursor: pointer;"
                                                            data-toggle="modal" data-target="#skillsModal">
                                                            +{{ $job?->skills->count() - 2 }} more
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Salary & Apply Section -->
                                            <div class="job-footer"
                                                style="padding: 15px; border-top: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center;">
                                                <div class="salary" style="font-weight: 600; color: #2a9d8f;">
                                                    @if ($job?->salary_mode === 'range')
                                                        <span>{{ $job?->min_salary }} - {{ $job?->max_salary }}</span>
                                                        <span
                                                            style="font-size: 12px; font-weight: normal; color: #888;">
                                                            / {{ $job?->salaryType?->name }}</span>
                                                    @else
                                                        <span>{{ $job?->custom_salary }}</span>
                                                        <span
                                                            style="font-size: 12px; font-weight: normal; color: #888;">
                                                            / {{ $job?->salaryType?->name }}</span>
                                                    @endif
                                                </div>
                                                <a href="{{ route('jobs.show', $job?->slug) }}">
                                                    <div class="btn btn-apply-now" data-bs-toggle="modal"
                                                        data-bs-target="#ModalApplyJobForm"
                                                        style="transition: background-color 0.3s ease, color 0.3s ease;"
                                                        onmouseover="this.style.backgroundColor='#2a9d8f'; this.style.color='#fff';"
                                                        onmouseout="this.style.backgroundColor=''; this.style.color='';">
                                                        View Post
                                                    </div>
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse


            </div>
        </div>
    </div>
</section>
