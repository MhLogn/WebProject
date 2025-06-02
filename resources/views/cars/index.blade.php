<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Danh sách xe đang được giao bán
        </h2>
    </x-slot>

    <style>
        /* --- Bảng danh sách xe --- */
        .car-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px; /* tạo khoảng cách giữa các hàng */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            box-shadow: 0 4px 12px rgb(0 0 0 / 0.05);
            border-radius: 12px;
            overflow: hidden;
            background-color: #fff;
        }

        .car-table thead th {
            background-color: #4338ca;
            color: white;
            padding: 14px 20px;
            text-transform: uppercase;
            font-weight: 700;
            font-size: 0.9rem;
            letter-spacing: 0.1em;
            border: none;
            text-align: left; /* mặc định trái */
        }

        /* Căn giữa header cột Hành động */
        .car-table thead th.text-center {
            text-align: center !important;
        }

        .car-table tbody tr {
            background-color: #f9fafb;
            transition: background-color 0.3s ease;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgb(0 0 0 / 0.1);
        }

        .car-table tbody tr:hover {
            background-color: #eef2ff;
            box-shadow: 0 4px 12px rgb(67 56 202 / 0.15);
        }

        .car-table th,
        .car-table td {
            padding: 12px 20px;
            vertical-align: middle;
            border: none;
        }

        /* Căn giữa nội dung cột hành động */
        .car-table tbody td.text-center {
            text-align: center;
            vertical-align: middle;
        }

        /* Ảnh xe */
        .car-table img {
            width: 220px;
            height: 120px;
            border-radius: 8px;
            object-fit: cover;
            display: block;
            box-shadow: 0 2px 8px rgb(0 0 0 / 0.1);
        }

        /* Nút thao tác */
        .action-buttons a,
        .action-buttons button {
            margin: 2px 4px;
            padding: 7px 14px;
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            text-align: center;
            transition: all 0.25s ease;
            border: none;
            box-shadow: 0 1px 4px rgb(0 0 0 / 0.1);
        }

        /* Các kiểu nút */
        .btn-view {
            background-color: #c7d2fe;
            color: #4338ca;
        }

        .btn-view:hover {
            background-color: #a5b4fc;
        }

        .btn-edit {
            background-color: #fde68a;
            color: #b45309;
        }

        .btn-edit:hover {
            background-color: #fcd34d;
        }

        .btn-delete {
            background-color: #fecaca;
            color: #b91c1c;
        }

        .btn-delete:hover {
            background-color: #fca5a5;
        }

        .btn-cart {
            background-color: #a7f3d0;
            color: #047857;
        }

        .btn-cart:hover {
            background-color: #6ee7b7;
        }

        .btn-contact {
            background-color: #3b82f6;
            color: white;
            font-weight: 700;
            padding: 8px 16px;
            border-radius: 8px;
            box-shadow: 0 3px 8px rgb(59 130 246 / 0.4);
            display: inline-block;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-contact:hover {
            background-color: #2563eb;
            box-shadow: 0 5px 14px rgb(37 99 235 / 0.6);
            text-decoration: none;
            color: white;
        }

        /* Responsive đơn giản cho màn hình nhỏ */
        @media (max-width: 768px) {
            .car-table thead {
                display: none;
            }

            .car-table tbody tr {
                display: block;
                margin-bottom: 12px;
                box-shadow: 0 1px 6px rgb(0 0 0 / 0.1);
                border-radius: 12px;
                background-color: #fff;
                padding: 12px 16px;
            }

            .car-table tbody tr td {
                display: flex;
                justify-content: space-between;
                border-bottom: 1px solid #eee;
                font-size: 0.9rem;
            }

            .car-table tbody tr td:last-child {
                border-bottom: none;
            }

            .car-table tbody tr td:before {
                content: attr(data-label);
                font-weight: 600;
                color: #4338ca;
            }

            .car-table img {
                width: 100px;
                height: 60px;
            }

            .action-buttons {
                display: flex;
                flex-wrap: wrap;
                gap: 6px;
            }
        }
    </style>

    <div class="py-10 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg rounded-lg p-6">
            @if(session('success'))
                <div
                    class="mb-6 p-4 bg-green-100 text-green-800 rounded border border-green-300 flex items-center space-x-2">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="mb-6 flex justify-between items-center">
                @if(Auth::user() && Auth::user()->is_admin)
                    <a href="{{ route('cars.create') }}"
                        class="bg-indigo-600 px-4 py-2 rounded-lg shadow hover:bg-indigo-700">
                        + Thêm xe mới
                    </a>
                @endif

                <form method="GET" action="{{ route('cars.index') }}" class="flex items-center space-x-2">
                    <input type="text" name="search" placeholder="Tìm theo tên hoặc hãng xe"
                        value="{{ request('search') }}"
                        class="border border-gray-300 px-3 py-2 focus:ring focus:border-indigo-400">
                    <button type="submit" class="px-4 py-2 border border-gray-800">
                        Tìm kiếm
                    </button>
                </form>
            </div>

            @if($cars->count())
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-lg border border-gray-200 shadow car-table">
                        <thead>
                            <tr>
                                <th class="text-center">Ảnh</th>
                                <th class="text-center">Tên xe</th>
                                <th class="text-center">Hãng</th>
                                <th class="text-center">Năm</th>
                                <th class="text-center">Giá</th>
                                <th class="text-center">Ghi chú</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cars as $car)
                                <tr>
                                    <td>
                                        @if($car->image)
                                            <img src="{{ asset('storage/' . $car->image) }}" alt="Ảnh xe">
                                        @else
                                            <span class="text-gray-400 italic">Không có ảnh</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $car->name }}</td>
                                    <td class="text-center">{{ $car->brand }}</td>
                                    <td class="text-center">{{ $car->year }}</td>
                                    <td class="text-center">{{ number_format($car->price, 0, ',', '.') }} USĐ</td>
                                    <td class="text-center">{{ $car->note }}</td>
                                    <td class="text-center action-buttons">
                                        <a href="{{ route('cars.show', $car->id) }}" class="btn-view">Xem</a>

                                        @if(Auth::user() && Auth::user()->is_admin)
                                            <a href="{{ route('cars.edit', $car->id) }}" class="btn-edit">Sửa</a>
                                            <form action="{{ route('cars.destroy', $car->id) }}" method="POST"
                                                class="inline-block"
                                                onsubmit="return confirm('Bạn có chắc muốn xóa xe này?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete">Xóa</button>
                                            </form>
                                        @endif

                                        <form action="{{ route('cart.add', $car->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            <button type="submit" class="btn-cart">Mua Bán</button>
                                        </form>

                                        <a href="{{ route('contact') }}" class="btn-contact px-3 py-1 rounded ml-1">
                                            Liên hệ
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $cars->appends(['search' => request('search')])->links() }}
                </div>
            @else
                <p class="text-center text-gray-500 italic mt-8">Chưa có xe nào trong danh sách.</p>
            @endif
        </div>
    </div>
</x-app-layout>
