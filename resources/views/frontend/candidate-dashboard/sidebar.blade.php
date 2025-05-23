<div class="col-lg-3 col-md-4 col-sm-12">
    <div class="box-nav-tabs nav-tavs-profile mb-5">
        <ul class="nav" role="tablist">
            <li><a class="btn btn-border mb-20 active" href="{{ route('candidate.dashboard') }}">Dashboard</a>
            </li>
            <li><a class="btn btn-border mb-20" href="{{ route('candidate.profile.index') }}">My Profile</a></li>
            <li><a class="btn btn-border mb-20" href="{{ route('candidate.applied-jobs.index') }}">Applied Jobs</a></li>
            <li><a class="btn btn-border mb-20" href="{{ route('candidate.bookmarked-jobs.index') }}">Bookmarked Jobs</a></li>
        </ul>
        <div class="mt-20">
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="link-red" onclick="event.preventDefault(); this.closest('form').submit();"
                    href="{{ route('logout') }}">Logout Account</a>
            </form>
        </div>
    </div>
</div>
