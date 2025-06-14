<div class="w-100 fixed-top" style="height: 75px; background: linear-gradient(to top, #a78bfa, #2563eb); border-radius: 0 0 12px 12px; z-index: 1030;">
    <div class="d-flex align-items-center justify-content-between h-100 px-3">
        <img
            src="https://placehold.co/98x65"
            class="rounded-3"
            style="width: 98px; height: 65px;"
            alt="Logo"
        />
        <div class="d-flex align-items-center">
            @if(Auth::check())
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                       id="dropdownAdmin" data-bs-toggle="dropdown" aria-expanded="false">
                        <img
                            src="https://placehold.co/47x47"
                            class="rounded-circle me-2"
                            style="width: 47px; height: 47px;"
                            alt="Avatar"
                        />
                        <span style="font-size: 1.17rem; font-family: Inter, sans-serif; font-weight: 400;">
                    {{ Auth::user()->name }}
                </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end admin-dropdown-menu" aria-labelledby="dropdownAdmin">
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">Đăng xuất</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-light ms-2"
                   style="background: linear-gradient(to top, #a78bfa, #2563eb); color: #fff; border: none; padding: 8px 20px; border-radius: 7px; font-weight: 500; text-decoration: none; transition: opacity 0.2s;"
                   onmouseover="this.style.opacity=0.7"
                   onmouseout="this.style.opacity=1">
                   Đăng nhập
                </a>
            @endif
        </div>
    </div>
</div>
<style>
    .admin-dropdown-menu {
        background: linear-gradient(to top, #a78bfa, #2563eb);
        color: #fff;
        border: none;
        min-width: 150px;
        padding: 0.5rem 0;
        z-index: 4000 !important; /* Đảm bảo dropdown nổi lên trên */
        position: absolute !important;
    }
    .admin-dropdown-menu .dropdown-item {
        color: #fff;
        transition: background 0.15s;
    }
    .admin-dropdown-menu .dropdown-item:hover,
    .admin-dropdown-menu .dropdown-item:focus {
        background: rgba(255,255,255,0.08);
        color: #fff;
    }
</style>
