<style>
    .admin-navbar-link {
        font-size: 0.98rem;
        font-family: Roboto, sans-serif;
        font-weight: 400;
        color: #fff;
        text-decoration: none;
        transition: opacity 0.2s;
        display: flex;
        align-items: center;
        padding: 0 10px;
        height: 38px;
        border-radius: 6px;
        gap: 0.5rem;
    }
    .admin-navbar-link:hover {
        opacity: 0.7;
        background: rgba(0,0,0,0.03);
    }
    .admin-navbar-icon {
        background: #fff;
        color: #0284c7;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 5px;
        width: 26px;
        height: 26px;
        font-size: 1rem;
        flex-shrink: 0;
    }
    .admin-navbar-list {
        gap: 1rem;
    }
    @media (max-width: 768px) {
        .admin-navbar-list {
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        .admin-navbar-link {
            font-size: 0.92rem;
            height: 34px;
            padding: 0 8px;
        }
    }
</style>
<div class="w-100 position-fixed" style="top: 75px; height: 50px; background-color: #0284c7; overflow: hidden; z-index: 1020;">
    <div class="d-flex align-items-center h-100 admin-navbar-list" style="padding-left: 12px;">
        <!-- Các item navbar như trước -->
         <!-- Item 1 -->
        <a href="#" class="admin-navbar-link">
            <span class="admin-navbar-icon">
                <i class="fa-solid fa-boxes-stacked"></i>
            </span>
            Sản Phẩm
        </a>
        <!-- Item 2 -->
        <a href="{{ route('admin.discount-codes.index') }}" class="admin-navbar-link">
            <span class="admin-navbar-icon">
                <i class="fa-solid fa-ticket"></i>
            </span>
            Mã Giảm Giá
        </a>
        <!-- Item 3 -->
        <a href="{{ route('orders.index') }}" class="admin-navbar-link">
            <span class="admin-navbar-icon">
                <i class="bi bi-receipt"></i>
            </span>
            Đơn Hàng
        </a>
    </div>
</div>
