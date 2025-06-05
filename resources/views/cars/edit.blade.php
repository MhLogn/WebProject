<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Cập nhật thông tin xe: {{ $car->name }}
        </h2>
    </x-slot>

    <style>
        body {
            background-color: #f3f4f6;
        }

        .form-container {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
            margin: 2rem auto;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .form-container.show {
            opacity: 1;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            display: block;
            user-select: none;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            font-family: inherit;
            font-size: 1rem;
            box-sizing: border-box;
        }

        .form-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
            outline: none;
            background-color: #fff;
        }

        .form-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            background-color: #3b82f6;
            color: white;
            font-weight: 600;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            user-select: none;
            font-family: inherit;
            font-size: 1rem;
            text-decoration: none;
        }

        .form-button:hover {
            background-color: #2563eb;
            transform: translateY(-2px);
        }

        .form-button.cancel {
            background-color: #f87171;
        }

        .form-button.cancel:hover {
            background-color: #ef4444;
            transform: translateY(-2px);
        }

        .car-image {
            max-width: 300px;
            border-radius: 0.5rem;
            border: 1px solid #d1d5db;
            margin-bottom: 1rem;
            transition: transform 0.3s ease;
            user-select: none;
        }

        .car-image:hover {
            transform: scale(1.05);
        }

        .error-box {
            background-color: #fee2e2;
            color: #b91c1c;
            border: 1.5px solid #ef4444;
            padding: 1rem 1.25rem;
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
            font-family: monospace;
            user-select: none;
        }
        .error-box ul {
            list-style: inside disc;
            margin: 0;
            padding-left: 1rem;
        }

        @media (max-width: 640px) {
            .form-container {
                padding: 1.5rem;
                margin: 1rem;
            }
        }
    </style>

    <div class="form-container" id="form-container">
        @if ($errors->any())
            <div class="error-box" role="alert" aria-live="assertive">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data" id="car-form" novalidate>
            @csrf
            @method('PUT')

            <label for="image" class="form-label">Ảnh xe hiện tại</label>
            @if ($car->image)
                <img src="{{ asset('storage/' . $car->image) }}" alt="Ảnh xe" class="car-image" />
            @else
                <p class="text-gray-500 select-none">Chưa có ảnh</p>
            @endif

            <label for="image" class="form-label mt-4">Thay đổi ảnh xe</label>
            <input type="file" name="image" id="image" accept="image/*" class="form-input">

            <label for="name" class="form-label mt-4">Tên xe</label>
            <input type="text" name="name" id="name" value="{{ old('name', $car->name) }}" required class="form-input">

            <label for="brand" class="form-label mt-4">Hãng</label>
            <input type="text" name="brand" id="brand" value="{{ old('brand', $car->brand) }}" required class="form-input">

            <label for="year" class="form-label mt-4">Năm sản xuất</label>
            <input type="number" name="year" id="year" min="1900" max="{{ date('Y') }}" value="{{ old('year', $car->year) }}" required class="form-input">

            <label for="price" class="form-label mt-4">Giá</label>
            <input type="number" step="100000" name="price" id="price" min="0" value="{{ old('price', $car->price) }}" required class="form-input">

            <label for="note" class="form-label mt-4">Ghi chú</label>
            <textarea name="note" id="note" rows="3" class="form-input">{{ old('note', $car->note) }}</textarea>

            <div class="flex gap-4 mt-6">
                <button type="submit" class="form-button">Cập nhật</button>
                <a href="{{ route('cars.index') }}" class="form-button cancel">Hủy</a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('form-container');

            // Fade-in khi load trang
            setTimeout(() => {
                container.classList.add('show');
            }, 100);

            const form = document.getElementById('car-form');
            form.addEventListener('submit', e => {
                e.preventDefault();

                // Fade-out khi submit
                container.classList.remove('show');

                setTimeout(() => {
                    form.submit();
                }, 500); // delay 0.5s rồi submit form
            });
        });
    </script>
</x-app-layout>
