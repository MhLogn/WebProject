<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Chi tiết xe: {{ $car->name }}
        </h2>
    </x-slot>
    
    <style>
        .car-detail-container {
            background-color: #f9fafb;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .car-detail-img {
            max-width: 100%;
            border-radius: 0.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            margin-bottom: 1rem;
        }

        .car-detail-info p {
            margin: 0.5rem 0;
            font-size: 1.125rem;
        }

        .car-detail-info p strong {
            color: #1f2937;
        }

        .car-detail-buttons a,
        .car-detail-buttons button {
            padding: 0.5rem 1rem;
            font-weight: 600;
            border-radius: 0.375rem;
            transition: background-color 0.3s;
        }

        .car-detail-buttons a {
            background-color: #4f46e5;
            color: white;
        }

        .car-detail-buttons a:hover {
            background-color: #4338ca;
        }

        .car-detail-buttons button {
            background-color: #dc2626;
            color: white;
            margin-left: 0.5rem;
        }

        .car-detail-buttons button:hover {
            background-color: #b91c1c;
        }

        .car-detail-buttons .back-link {
            background-color: transparent;
            color: #374151;
            text-decoration: underline;
            margin-left: 1rem;
        }

        .car-detail-buttons .back-link:hover {
            color: #1f2937;
        }
    </style>

    <div class="py-12 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="car-detail-container">

            <div class="mb-6 text-center">
                @if ($car->image)
                    <img src="{{ asset('storage/' . $car->image) }}" alt="Ảnh xe" class="car-detail-img w-64 mx-auto">
                @else
                    <p class="text-gray-500">Chưa có ảnh xe</p>
                @endif
            </div>

            <div class="car-detail-info text-gray-700">
                <p><strong>Tên xe:</strong> {{ $car->name }}</p>
                <p><strong>Hãng:</strong> {{ $car->brand }}</p>
                <p><strong>Năm sản xuất:</strong> {{ $car->year }}</p>
                <p><strong>Giá:</strong> {{ number_format($car->price, 0, ',', '.') }} USĐ</p>
                <p><strong>Ghi chú:</strong> {{ $car->note ?? '-' }}</p>
            </div>

            <div class="mt-6 car-detail-buttons flex items-center flex-wrap">
                @if (Auth::user() && Auth::user()->is_admin)
                    <a href="{{ route('cars.edit', $car->id) }}">Sửa</a>
                    <form action="{{ route('cars.destroy', $car->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa xe này?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Xóa</button>
                    </form>
                @endif
                <a href="{{ route('cars.index') }}" class="back-link">Quay lại danh sách</a>
            </div>

        </div>
    </div>
</x-app-layout>
