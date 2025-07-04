<div class="w-100 fixed-top" style="height: 75px; background: linear-gradient(to top, #a78bfa, #2563eb); border-radius: 0 0 12px 12px; z-index: 1030;">
    <div class="d-flex align-items-center justify-content-between h-100 px-3">
        <img
            src="{{ asset('image/logo.png') }}"
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
                            src="https://cdn2.fptshop.com.vn/small/avatar_trang_1_cd729c335b.jpg"
                            class="rounded-circle me-2"
                            style="width: 47px; height: 47px;"
                            alt="Avatar"
                        />
                        <span style="font-size: 1.17rem; font-family: Inter, sans-serif; font-weight: 400;">
                    {{ Auth::user()->name }}
                </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end admin-dropdown-menu" aria-labelledby="dropdownAdmin" style="background: linear-gradient(to top, #a78bfa, #2563eb);">
                        <li>
                            <a class="dropdown-item btn btn-light" href="#"
                               style="background: linear-gradient(to top, #a78bfa, #2563eb); color: #fff; border: none; border-radius: 7px; font-weight: 500; text-decoration: none; transition: opacity 0.2s;"
                               onmouseover="this.style.opacity=0.7"
                               onmouseout="this.style.opacity=1">
                                Đơn Hàng
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item btn btn-light" href="#"
                               style="background: linear-gradient(to top, #a78bfa, #2563eb); color: #fff; border: none; border-radius: 7px; font-weight: 500; text-decoration: none; transition: opacity 0.2s;"
                               onmouseover="this.style.opacity=0.7"
                               onmouseout="this.style.opacity=1">
                                Lịch sử mua hàng
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item btn btn-light" type="submit" style="background: linear-gradient(to top, #a78bfa, #2563eb); color: #fff; border: none; border-radius: 7px; font-weight: 500; text-decoration: none; transition: opacity 0.2s;"
                                        onmouseover="this.style.opacity=0.7"
                                        onmouseout="this.style.opacity=1">
                                    Đăng xuất
                                </button>
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
