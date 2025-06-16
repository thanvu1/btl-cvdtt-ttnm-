@extends('layouts.admin.app')

@section('content')
    <style>
        .discount-filter-col {
            min-width: 240px;
            max-width: 280px;
        }
        @media (max-width: 991.98px) {
            .discount-filter-col {
                max-width: 100%;
                min-width: unset;
                margin-bottom: 20px;
            }
        }
    </style>
    <div class="container-fluid py-3">
        <div class="row justify-content-center">
            <!-- Bộ lọc bên trái -->
            <div class="col-lg-3 discount-filter-col">
                <div class="mb-3">
                    <div class="card">
                        <div class="card-header fw-bold py-2">Thời Gian</div>
                        <div class="card-body">
                            <form id="dateForm" method="get">
                                <div class="mb-2">
                                    <label for="start_date" class="form-label mb-1">Ngày bắt đầu</label>
                                    <input type="date" class="form-control form-control-sm" id="start_date" name="start_date" value="{{ request('start_date') }}">
                                </div>
                                <div>
                                    <label for="end_date" class="form-label mb-1">Ngày kết thúc</label>
                                    <input type="date" class="form-control form-control-sm" id="end_date" name="end_date" value="{{ request('end_date') }}">
                                </div>
                                @foreach(request()->except(['start_date', 'end_date', 'page']) as $key => $value)
                                    @if(is_array($value))
                                        @foreach($value as $v)
                                            <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                                        @endforeach
                                    @else
                                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                    @endif
                                @endforeach
                            </form>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="card">
                        <div class="card-header fw-bold py-2">Trạng Thái</div>
                        <div class="card-body">
                            <form id="stateForm" method="get">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="state[]" value="inactive"
                                           id="state_inactive"
                                        {{ is_array(request('state')) && in_array('inactive', request('state')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="state_inactive">Chưa kích hoạt</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="state[]" value="active"
                                           id="state_active"
                                        {{ is_array(request('state')) && in_array('active', request('state')) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="state_active">Kích hoạt</label>
                                </div>
                                @foreach(request()->except('state', 'page') as $key => $value)
                                    @if(is_array($value))
                                        @foreach($value as $v)
                                            <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                                        @endforeach
                                    @else
                                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                    @endif
                                @endforeach
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bảng bên phải -->
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="fw-bold flex-grow-1 text-center mb-0">QUẢN LÝ GIẢM GIÁ</h3>
                </div>
                <!-- Thanh tìm kiếm: full width ngang bảng -->
                <div class="d-flex align-items-center mb-3" style="gap: 1rem;">
                    <!-- Search input -->
                    <form method="get" class="input-group" style="width: 340px;">
                        <input type="text" class="form-control" name="search" placeholder="Hãy nhập tên mã giảm giá" value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                        @foreach(request()->except('search', 'page') as $key => $value)
                            @if(is_array($value))
                                @foreach($value as $v)
                                    <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                                @endforeach
                            @else
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endif
                        @endforeach
                    </form>
                    <!-- Nút thêm mới -->
                    <a href="{{ route('admin.discount-codes.create') }}" class="btn btn-success ms-auto" style="white-space:nowrap; min-width:170px;">
                        <i class="fa fa-plus"></i> Thêm mã giảm giá
                    </a>
                </div>

                <!-- Thông báo -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle mb-0">
                        <thead class="table-light">
                        <tr>
                            <th>Tên mã giảm giá</th>
                            <th>Loại khuyến mãi</th>
                            <th>Giảm giá</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Mô tả</th>
                            <th>Trạng thái</th>
                            <th class="text-end">Tác vụ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($list as $comp)
                            <tr>
                                <td>{{ $comp->code }}</td>
                                <td>Giảm theo phần trăm</td>
                                <td>{{ number_format($comp->discount_amount, 2) }}%</td>
                                <td>{{ \Carbon\Carbon::parse($comp->started_at)->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($comp->expires_at)->format('d/m/Y') }}</td>
                                <td>{{ $comp->description }}</td>
                                <td>
                                    @if($comp->state === 'active')
                                        <span class="badge bg-success">Kích hoạt</span>
                                    @else
                                        <span class="badge bg-secondary">Chưa kích hoạt</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.discount-codes.edit', $comp->id) }}" class="btn btn-outline-dark btn-sm" title="Sửa">
                                        <i class="fa fa-pen-to-square fa-lg"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Không có dữ liệu</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    {{ $list->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        // Debounce function cho search input
        function debounce(func, delay) {
            let timer;
            return function(...args) {
                clearTimeout(timer);
                timer = setTimeout(() => func.apply(this, args), delay);
            }
        }

        const searchInput = document.getElementById('searchInput');
        const searchForm = document.getElementById('searchForm');

        if (searchInput && searchForm) {
            searchInput.addEventListener('input', debounce(function () {
                searchForm.submit();
            }, 5000)); // 1 giây, chỉnh tùy ý
        }

        // Auto submit form trạng thái
        document.querySelectorAll('#stateForm .form-check-input').forEach(function(el) {
            el.addEventListener('change', function() {
                document.getElementById('stateForm').submit();
            });
        });

        // Auto submit form ngày
        document.querySelectorAll('#dateForm input[type="date"]').forEach(function(el) {
            el.addEventListener('change', function() {
                document.getElementById('dateForm').submit();
            });
        });
    </script>

@endsection
