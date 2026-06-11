<nav class="navbar">
    <div class="logo">
        UniSync
    </div>

    <ul class="nav-links">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('exam') }}">Exam</a></li>
        <li><a href="{{ route('student.notices') }}">Notice</a></li>
        <li><a href="{{ route('about') }}">About Us</a></li>
        <li><a href="{{ route('contact') }}">Contact Us</a></li>

        @auth
        <li>
            <a href="{{ route('profile') }}" class="nav-profile-link">
                @if(Auth::user()->profile_image)
                <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="Profile" class="nav-avatar">
                @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=60a5fa&color=fff" alt="Profile" class="nav-avatar">
                @endif
                Profile
            </a>
        </li>
        <li>
            <a href="{{ route('logout') }}" class="logout-btn"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Log Out
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
        @else
        <li><a href="{{ route('login') }}">Login</a></li>
        @endauth
    </ul>
</nav>

<style>
    .navbar {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        width: 90%;
        max-width: 1300px;
        padding: 15px 35px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 20px;
        z-index: 1000;
    }

    .logo {
        font-size: 28px;
        font-weight: 800;
        background: linear-gradient(90deg, #60a5fa, #a855f7, #ec4899);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .nav-links {
        display: flex;
        gap: 30px;
        list-style: none;
        align-items: center;
    }

    .nav-links a {
        text-decoration: none;
        color: white;
        font-weight: 500;
        transition: .3s;
        position: relative;
    }

    .nav-links a:hover {
        color: #60a5fa;
    }

    .nav-links a::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        left: 0;
        bottom: -5px;
        background: #ec4899;
        transition: .3s;
    }

    .nav-links a:not(.logout-btn):hover::after {
        width: 100%;
    }

    .nav-profile-link {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .nav-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #a855f7;
        transition: 0.3s;
    }

    .nav-links a:hover .nav-avatar {
        border-color: #60a5fa;
    }

    /* Pink-Translucent Pill Logout Styling Button */
    .logout-btn {
        background: rgba(236, 72, 153, 0.15);
        border: 1px solid rgba(236, 72, 153, 0.4);
        padding: 6px 16px;
        border-radius: 10px;
        color: #f472b6 !important;
        font-weight: 600 !important;
        transition: all 0.3s ease;
    }

    .logout-btn:hover {
        background: #ec4899;
        color: white !important;
        box-shadow: 0 0 15px rgba(236, 72, 153, 0.5);
        border-color: transparent;
        transform: translateY(-2px);
    }

    @media(max-width:768px) {
        .navbar {
            flex-direction: column;
            gap: 15px;
            top: 10px;
        }

        .nav-links {
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
        }
    }
</style>