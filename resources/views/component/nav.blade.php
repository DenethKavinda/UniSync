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
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 20px;

        z-index: 1000;
    }

    .logo {
        font-size: 28px;
        font-weight: 800;

        background: linear-gradient(90deg,
                #60a5fa,
                #a855f7,
                #ec4899);

        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .nav-links {
        display: flex;
        gap: 30px;
        list-style: none;
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

    .nav-links a:hover::after {
        width: 100%;
    }

    @media(max-width:768px) {
        .navbar {
            flex-direction: column;
            gap: 15px;
        }

        .nav-links {
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
        }
    }
</style>