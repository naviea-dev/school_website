<div class="top-content">
    <div class="email-link">
        নোটিশ: </a>
    </div>
    <div class="marquee-container">
        <marquee scrollamount="5" direction="left" class="marquee-text">
            <span>
            @foreach ($commonData['latestupdate'] as $update)
            <a href="#/notices/অভিযোগ"
                    class="text-decoration-none">
                    {!! $update->details !!}
                </a>
            @endforeach
            </span>
        </marquee>
    </div>
    <div class="user-content">
        <div class="auth-buttons">
            @if (Auth::guard('user')->check())
            <a href="{{ route('user.profile') }}">আমার&nbsp;অ্যাকাউন্ট</a>
            <a href="{{ route('user.logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form-user').submit();">লগআউট</a>
                <form id="logout-form-user" action="{{ route('user.logout') }}" method="POST" style="display:none;">{{ csrf_field() }}</form>
            
            @else
            <a href="{{ route('user.login') }}" class="btn btn-login bengali">
                <i class="fas fa-sign-in-alt"></i> লগইন
            </a>
            <a href="{{ route('user.register') }}" class="btn btn-register bengali">
                <i class="fas fa-user-plus"></i> রেজিস্টার
            </a>
            @endif

        </div>
    </div>
</div>