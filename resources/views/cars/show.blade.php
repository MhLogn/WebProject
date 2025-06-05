<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Chi tiết xe: {{ $car->name }}
        </h2>
    </x-slot>

    <style>
        .car-detail-container {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .car-detail-container.show {
            opacity: 1;
        }

        .car-detail-img {
            max-width: 100%;
            border-radius: 0.75rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            margin-bottom: 1.5rem;
        }

        .car-detail-info p {
            margin: 0.75rem 0;
            font-size: 1.125rem;
        }

        .car-detail-info p strong {
            color: #111827;
        }

        .car-detail-buttons {
            margin-top: 2rem;
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .car-detail-buttons a,
        .car-detail-buttons button {
            padding: 0.6rem 1.25rem;
            font-weight: 600;
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: background-color 0.3s, transform 0.2s;
            cursor: pointer;
        }

        .car-detail-buttons a.edit-link {
            background-color: #3b82f6;
            color: white;
        }

        .car-detail-buttons a.edit-link:hover {
            background-color: #2563eb;
            transform: translateY(-2px);
        }

        .car-detail-buttons button.delete-btn {
            background-color: #ef4444;
            color: white;
            border: none;
        }

        .car-detail-buttons button.delete-btn:hover {
            background-color: #dc2626;
            transform: translateY(-2px);
        }

        .car-detail-buttons a.back-link {
            background-color: #f3f4f6;
            color: #374151;
            text-decoration: none;
        }

        .car-detail-buttons a.back-link:hover {
            background-color: #e5e7eb;
        }

        @media (max-width: 640px) {
            .car-detail-buttons {
                flex-direction: column;
                align-items: stretch;
            }

            .car-detail-buttons a,
            .car-detail-buttons button {
                width: 100%;
                text-align: center;
            }
        }
    </style>

    <div class="py-10">
        <div class="car-detail-container" id="car-detail-box">

            <div class="mb-6 text-center">
                @if ($car->image)
                    <img src="{{ asset('storage/' . $car->image) }}" alt="Ảnh xe" class="car-detail-img w-72 mx-auto">
                @else
                    <p class="text-gray-500">Chưa có ảnh xe</p>
                @endif
            </div>

            <div class="car-detail-info text-gray-800">
                <p><strong>Tên xe:</strong> {{ $car->name }}</p>
                <p><strong>Hãng:</strong> {{ $car->brand }}</p>
                <p><strong>Năm sản xuất:</strong> {{ $car->year }}</p>
                <p><strong>Giá:</strong> {{ number_format($car->price, 0, ',', '.') }} USĐ</p>
                <p><strong>Ghi chú:</strong> {{ $car->note ?? '-' }}</p>
            </div>

            <div class="car-detail-buttons">
                @if (Auth::user() && Auth::user()->is_admin)
                    <a href="{{ route('cars.edit', $car->id) }}" class="edit-link"> Sửa</a>

                    <form action="{{ route('cars.destroy', $car->id) }}" method="POST" id="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn">Xóa</button>
                    </form>
                @endif

                <a href="{{ route('cars.index') }}" class="back-link">Quay lại danh sách</a>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const box = document.getElementById('car-detail-box');
            box.classList.add('show');

            const deleteForm = document.getElementById('delete-form');
            if (deleteForm) {
                deleteForm.addEventListener('submit', (e) => {
                    if (!confirm('Bạn có chắc muốn xóa xe này?')) {
                        e.preventDefault();
                        return;
                    }

                    // Fade out animation
                    box.classList.remove('show');
                });
            }
        });
    </script>
</x-app-layout>
