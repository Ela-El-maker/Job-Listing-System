<section class="section-box category_section mt-35">
    <div class="section-box wow animate__animated animate__fadeIn">
        <div class="container">
            <div class="text-center">
                <h2 class="section-title mb-10 wow animate__animated animate__fadeInUp">Popular Job Categories</h2>
                <p class="font-lg color-text-paragraph-2 wow animate__animated animate__fadeInUp">{{ $jobCount }}
                    Jobs Available</p>
            </div>
            <div class="box-swiper mt-50">
                <div class="swiper-container swiper-group-5 swiper">
                    <div class="swiper-wrapper pb-70 pt-5">
                        @forelse ($popularJobCategories->chunk(2) as $pair)
                            <div class="swiper-slide hover-up">
                                @foreach ($pair as $category)
                                    <a href="{{ route('jobs.index', ['category' => $category?->slug]) }}">
                                        <div class="item-logo">
                                            <div class="image-left">
                                                <i class="{{ $category?->icon }}"></i>
                                            </div>
                                            <div class="text-info-right">
                                                <h4>{{ Str::limit($category?->name, 15, '...') }}</h4>
                                                <p class="font-xs">{{ $category?->jobs_count }}<span> Jobs
                                                        Available</span></p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach

                            </div>
                        @empty
                            <div class="col-12">
                                <div class="empty-category-state text-center py-5"
                                    style="
                                    background: rgba(245, 245, 245, 0.5);
                                    border-radius: 12px;
                                    padding: 40px;
                                    margin: 20px 0;
                                ">
                                    <div
                                        style="
                                        width: 120px;
                                        height: 120px;
                                        background: #f0f7ff;
                                        border-radius: 50%;
                                        display: inline-flex;
                                        align-items: center;
                                        justify-content: center;
                                        margin-bottom: 25px;
                                    ">
                                        <i class="fa fa-folder-open" style="font-size: 50px; color: #38b2ac;"></i>
                                    </div>
                                    <h4
                                        style="
                                        font-size: 1.5rem;
                                        color: #05264e;
                                        margin-bottom: 15px;
                                        font-weight: 600;
                                    ">
                                        No Job Categories Found</h4>
                                    <p
                                        style="
                                        color: #66789c;
                                        font-size: 1rem;
                                        max-width: 500px;
                                        margin: 0 auto 25px;
                                        line-height: 1.6;
                                    ">
                                        We couldn't find any popular job categories right now. Check back later or
                                        browse all available jobs.</p>
                                    <div>
                                        <a href="{{ route('jobs.index') }}"
                                            style="
                                            display: inline-block;
                                            padding: 12px 24px;
                                            background: #38b2ac;
                                            color: white;
                                            border-radius: 6px;
                                            text-decoration: none;
                                            font-weight: 500;
                                            transition: all 0.3s ease;
                                        "
                                            onmouseover="this.style.background='#2d928c'"
                                            onmouseout="this.style.background='#38b2ac'">
                                            Browse All Jobs
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
</section>
