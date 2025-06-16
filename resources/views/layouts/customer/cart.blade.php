   <a href="javascript:void(0);" 
               class="d-flex align-items-center text-white px-4 py-2 mx-2 position-relative" 
               style="text-decoration: none;"
               data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas" aria-controls="cartOffcanvas">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="bi bi-cart2 me-2" viewBox="0 0 16 16" style="font-weight: bold; position: relative;">
                    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
                </svg>
                <span class="position-absolute bottom-0 end-5 translate-end badge rounded-pill bg-danger" style="font-size: 0.75rem; transform: translate(50%, 50%);">
                    <span id="cart-count">{{ collect(session('cart', []))->sum('qty') }}</span>
                </span>
                <span style="font-size: 1rem;">Giỏ hàng</span>
            </a>
