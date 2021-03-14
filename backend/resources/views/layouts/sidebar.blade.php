<aside class="aside aside-fixed">
    <div class="aside-header">
        <a href="{{ url('') }}" class="aside-logo">Depok<span>Bersih</span></a>
        <a href="" class="aside-menu-link">
            <i data-feather="menu"></i>
            <i data-feather="x"></i>
        </a>
    </div>
    <div class="aside-body">
        <div class="aside-loggedin">
            <div class="d-flex align-items-center justify-content-start">
                <a href="" class="avatar"><img
                        src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}?format=svg?bold=true?rounded=true"
                        class="rounded-circle" alt=""></a>
                <div class="aside-alert-link">
                    <a href="" class="new" data-toggle="tooltip" title="You have 2 unread messages"><i
                            data-feather="message-square"></i></a>
                    <a href="" class="new" data-toggle="tooltip" title="You have 4 new notifications"><i
                            data-feather="bell"></i></a>
                    <a href="#logout-modal" title="Click here to logout" data-toggle="modal"
                        data-animation="effect-super-scaled"><i data-feather="log-out"></i></a>
                </div>
            </div>
            <div class="aside-loggedin-user">
                <a href="#loggedinMenu" class="d-flex align-items-center justify-content-between mg-b-2"
                    data-toggle="collapse">
                    <h6 class="tx-semibold mg-b-0">{{ auth()->user()->name }}</h6>
                    <i data-feather="chevron-down"></i>
                </a>
                <p class="tx-color-03 tx-12 mg-b-0">{{ auth()->user()->groups[0]['description'] }}</p>
            </div>
            <div class="collapse" id="loggedinMenu">
                <ul class="nav nav-aside mg-b-0">
                    <li class="nav-item"><a href="#" data-toggle="modal" data-target="#changePasswordModal"
                            class="nav-link"><i data-feather="lock"></i> <span>Ganti Password</span></a></li>
                    <li class="nav-item"><a href="#logout-modal" title="Sign out" data-toggle="modal"
                            data-animation="effect-super-scaled" class="nav-link"><i data-feather="log-out"></i>
                            <span>Sign Out</span></a></li>
                </ul>
            </div>
        </div><!-- aside-loggedin -->
        <ul class="nav nav-aside">
            @if (auth()->user()->hasAnyGroup(['administrator','supervisor']))
            <li class="nav-label">Dashboard</li>
            <li class="nav-item"><a href="{{ url('dashboard') }}" class="nav-link"><i
                        data-feather="shopping-bag"></i>
                    <span>Monitoring Pelaporan</span></a></li>
            <li class="nav-item"><a href="{{ url('user') }}" class="nav-link"><i data-feather="shopping-bag"></i>
                    <span>User</span></a></li>
            @endif
            <li class="nav-label {{ auth()->user()->hasAnyGroup(['administrator','supervisor']) ? 'mg-t-25' : '' }}">Utama</li>
            @if (auth()->user()->hasAnyGroup(['administrator','supervisor']))
            <li class="nav-item"><a href="{{ url('oil-collector') }}" class="nav-link"><i
                data-feather="shopping-bag"></i>
            <span>Oil Collector</span></a></li>
            @endif
            @if (auth()->user()->hasAnyGroup(['administrator','supervisor','user']))
            <li class="nav-item"><a href="{{ url('letter') }}" class="nav-link"><i data-feather="shopping-bag"></i>
                    <span>Letter</span></a></li>
            @endif
            @if (auth()->user()->hasAnyGroup(['administrator','supervisor','user','anthusias']))
            <li class="nav-item"><a href="{{ url('posts') }}" class="nav-link"><i data-feather="shopping-bag"></i>
                    <span>Post</span></a></li>
            @endif
        </ul>
    </div>
</aside>