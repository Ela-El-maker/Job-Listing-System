<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset(auth()->guard('admin')->user()->image) }}"
                    class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Logged in 5 min ago</div>
                <a href="features-profile.html" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <a href="{{ route('admin.site-settings.index') }}" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                <!-- Authentication -->
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <a href="{{ route('admin.logout') }}"
                        onclick="event.preventDefault();
                               this.closest('form').submit();"
                        class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </form>
            </div>
        </li>
    </ul>
</nav>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">Ela Kali</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">Ela</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ setSidebarActive(['admin.dashboard']) }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                        class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
            </li>


            <li class="menu-header">Starter</li>
            @if (canAccess(['orders listings']))
                <li class="{{ setSidebarActive(['admin.orders.*']) }}"><a class="nav-link"
                        href="{{ route('admin.orders.index') }}"><i class="fas fa-shopping-cart"></i> <span>Orders</span></a>
                </li>
            @endif
            @if (canAccess(['job category create', 'job category update', 'job category delete']))
                <li class="{{ setSidebarActive(['admin.job-categories.*']) }}"><a class="nav-link"
                        href="{{ route('admin.job-categories.index') }}"><i class="fas fa-briefcase"></i> <span>Job
                            Category</span></a></li>
            @endif
            @if (canAccess(['job create', 'job update', 'job delete']))
                <li class="{{ setSidebarActive(['admin.jobs.*']) }}"><a class="nav-link"
                        href="{{ route('admin.jobs.index') }}"><i class="fas fa-tasks"></i> <span>Job
                            Post</span></a></li>
            @endif
            @if (canAccess(['job role']))
                <li
                    class="dropdown {{ setSidebarActive(['admin.job-type.*', 'admin.job-role.*', 'admin.job-experience.*']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-industry"></i>
                        <span>Jobs Sectors</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ setSidebarActive(['admin.job-type.*']) }}"><a class="nav-link"
                                href="{{ route('admin.job-type.index') }}"><i class="fas fa-list-alt"></i> <span>Job
                                    Type</span></a></li>
                        <li class="{{ setSidebarActive(['admin.job-role.*']) }}"><a class="nav-link"
                                href="{{ route('admin.job-role.index') }}"><i class="fas fa-user-tie"></i> <span>Job
                                    Roles</span></a></li>
                        <li class="{{ setSidebarActive(['admin.job-experience.*']) }}"><a class="nav-link"
                                href="{{ route('admin.job-experience.index') }}"><i class="fas fa-chart-line"></i> <span>Job
                                    Experiences</span></a></li>
                    </ul>
                </li>
            @endif
            @if (canAccess(['job attributes']))
                <li
                    class="dropdown {{ setSidebarActive(['admin.industry-types.*', 'admin.organization-types.*']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-tags"></i>
                        <span>Attributes</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ setSidebarActive(['admin.industry-types.*']) }}"><a class="nav-link"
                                href="{{ route('admin.industry-types.index') }}"><i class="fas fa-building"></i> Industry Type</a></li>
                        <li class="{{ setSidebarActive(['admin.organization-types.*']) }}"><a class="nav-link"
                                href="{{ route('admin.organization-types.index') }}"><i class="fas fa-sitemap"></i> Organization Type</a></li>
                        <li class="{{ setSidebarActive(['admin.languages.*']) }}"><a class="nav-link"
                                href="{{ route('admin.languages.index') }}"><i class="fas fa-language"></i> Languages</a></li>
                        <li class="{{ setSidebarActive(['admin.professions.*']) }}"><a class="nav-link"
                                href="{{ route('admin.professions.index') }}"><i class="fas fa-user-md"></i> Professions</a></li>
                        <li class="{{ setSidebarActive(['admin.skills.*']) }}"><a class="nav-link"
                                href="{{ route('admin.skills.index') }}"><i class="fas fa-lightbulb"></i> Skills</a></li>
                        <li class="{{ setSidebarActive(['admin.salary-type.*']) }}"><a class="nav-link"
                                href="{{ route('admin.salary-type.index') }}"><i class="fas fa-money-bill-wave"></i> <span>Salary
                                    Type</span></a></li>
                        <li class="{{ setSidebarActive(['admin.tag.*']) }}"><a class="nav-link"
                                href="{{ route('admin.tag.index') }}"><i class="fas fa-tag"></i> <span>Tags</span></a>
                        </li>
                        <li class="{{ setSidebarActive(['admin.educations.*']) }}"><a class="nav-link"
                                href="{{ route('admin.educations.index') }}"><i class="fas fa-graduation-cap"></i>
                                <span>Educations</span></a></li>
                    </ul>
                </li>
            @endif
            @if (canAccess(['job locations']))
                <li
                    class="dropdown {{ setSidebarActive(['admin.countries.*', 'admin.states.*', 'admin.cities.*']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-map-marker-alt"></i>
                        <span>Locations</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ setSidebarActive(['admin.countries.*']) }}"><a class="nav-link"
                                href="{{ route('admin.countries.index') }}"><i class="fas fa-globe"></i> Countries</a></li>
                        <li class="{{ setSidebarActive(['admin.states.*']) }}"><a class="nav-link"
                                href="{{ route('admin.states.index') }}"><i class="fas fa-map"></i> States</a></li>
                        <li class="{{ setSidebarActive(['admin.cities.*']) }}"><a class="nav-link"
                                href="{{ route('admin.cities.index') }}"><i class="fas fa-city"></i> Cities</a></li>
                    </ul>
                </li>
            @endif
            @if (canAccess(['sections']))
                <li
                    class="dropdown {{ setSidebarActive(['admin.hero.*', 'admin.learn-more.*', 'admin.custom-section.*', 'admin.reviews.*','admin.location.*']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-layer-group"></i>
                        <span>Sections</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ setSidebarActive(['admin.hero.*']) }}"><a class="nav-link"
                                href="{{ route('admin.hero.index') }}"><i class="fas fa-sliders-h"></i> Hero</a></li>
                        <li class="{{ setSidebarActive(['admin.learn-more.*']) }}"><a class="nav-link"
                                href="{{ route('admin.learn-more.index') }}"><i class="fas fa-info-circle"></i> Learn More Section</a></li>
                        <li class="{{ setSidebarActive(['admin.why-choose-us.*']) }}"><a class="nav-link"
                                href="{{ route('admin.why-choose-us.index') }}"><i class="fas fa-star"></i> Custom Section</a></li>
                        <li class="{{ setSidebarActive(['admin.reviews.*']) }}"><a class="nav-link"
                                href="{{ route('admin.reviews.index') }}"><i class="fas fa-comment-alt"></i> Client Reviews</a></li>
                        <li class="{{ setSidebarActive(['admin.job-location.*']) }}"><a class="nav-link"
                                href="{{ route('admin.job-location.index') }}"><i class="fas fa-map-pin"></i> <span>Job Locations</span></a></li>
                    </ul>
                </li>
            @endif
            @if (canAccess(['Site Pages']))
                <li class="dropdown {{ setSidebarActive(['admin.about-us.*', 'admin.page-builder.*']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-file-alt"></i>
                        <span>Pages</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ setSidebarActive(['admin.about-us.*']) }}"><a class="nav-link"
                                href="{{ route('admin.about-us.index') }}"><i class="fas fa-info-circle"></i> About Us</a></li>
                        <li class="{{ setSidebarActive(['admin.page-builder.*']) }}"><a class="nav-link"
                                href="{{ route('admin.page-builder.index') }}"><i class="fas fa-tools"></i> Page Builder</a></li>
                    </ul>
                </li>
            @endif
            @if (canAccess(['Site footer']))
                <li class="dropdown {{ setSidebarActive(['admin.footer.*', 'admin.social-icon.*']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-shoe-prints"></i>
                        <span>Footer Details</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ setSidebarActive(['admin.footer.*']) }}"><a class="nav-link"
                                href="{{ route('admin.footer.index') }}"><i class="fas fa-footer"></i> Footer</a></li>
                        <li class="{{ setSidebarActive(['admin.social-icon.*']) }}"><a class="nav-link"
                                href="{{ route('admin.social-icon.index') }}"><i class="fas fa-share-alt"></i> Socials</a></li>
                    </ul>
                </li>
            @endif
            @if (canAccess(['blogs']))
                <li class="{{ setSidebarActive(['admin.blogs.*']) }}"><a class="nav-link"
                        href="{{ route('admin.blogs.index') }}"><i class="fas fa-blog"></i> <span>Blogs</span></a>
                </li>
            @endif
            @if (canAccess(['price plan']))
                <li class="{{ setSidebarActive(['admin.plans.*']) }}"><a class="nav-link"
                        href="{{ route('admin.plans.index') }}"><i class="fas fa-money-check-alt"></i> <span>Price
                            Plan</span></a>
                </li>
            @endif
            @if (canAccess(['newsletter']))
                <li class="dropdown {{ setSidebarActive(['admin.newsletter.*']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-envelope"></i>
                        <span>Newsletters</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ setSidebarActive(['admin.newsletter.*']) }}"><a class="nav-link"
                                href="{{ route('admin.newsletter.index') }}"><i class="fas fa-mail-bulk"></i> Newsletters</a></li>
                    </ul>
                </li>
            @endif
            @if (canAccess(['menu builder']))
                <li class="{{ setSidebarActive(['admin.menu-builder.*']) }}"><a class="nav-link"
                        href="{{ route('admin.menu-builder.index') }}"><i class="fas fa-bars"></i> <span>Menu
                            Builder</span></a></li>
            @endif
            @if (canAccess(['access management']))
                <li class="dropdown {{ setSidebarActive(['admin.role.*', 'admin.role-user.*']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-user-shield"></i>
                        <span>Access Management</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ setSidebarActive(['admin.role.*']) }}"><a class="nav-link"
                                href="{{ route('admin.role.index') }}"><i class="fas fa-user-tag"></i> Roles</a></li>
                        <li class="{{ setSidebarActive(['admin.role-user.*']) }}"><a class="nav-link"
                                href="{{ route('admin.role-user.index') }}"><i class="fas fa-users-cog"></i> User Roles</a></li>
                    </ul>
                </li>
            @endif
            @if (canAccess(['payment settings']))
                <li class="{{ setSidebarActive(['admin.payment-settings.index']) }}"><a class="nav-link"
                        href="{{ route('admin.payment-settings.index') }}"><i class="fas fa-credit-card"></i>
                        <span>Payment Settings</span></a></li>
            @endif
            @if (canAccess(['site settings']))
                <li class="{{ setSidebarActive(['admin.site-settings.index']) }}"><a class="nav-link"
                        href="{{ route('admin.site-settings.index') }}"><i class="fas fa-cogs"></i> <span>Site
                            Settings</span></a>
                </li>
            @endif
            @if (canAccess(['database clear']))
                <li class="{{ setSidebarActive(['admin.clear-database.index']) }}"><a class="nav-link"
                        href="{{ route('admin.clear-database.index') }}"><i class="fas fa-database"></i> <span>Clear
                            Database</span></a>
                </li>
            @endif
        </ul>
    </aside>
</div>
