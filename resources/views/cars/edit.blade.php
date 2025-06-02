<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            ✨ Cập nhật thông tin xe: {{ $car->name }}
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
        }

        .form-container h2 {
            color: #3b82f6;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
            outline: none;
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
        }

        .car-image {
            max-width: 200px;
            border-radius: 0.5rem;
            border: 1px solid #d1d5db;
            margin-bottom: 1rem;
            transition: transform 0.3s ease;
        }

        .car-image:hover {
            transform: scale(1.05);
        }

        @media (max-width: 640px) {
            .form-container {
                padding: 1.5rem;
            }
        }
    </style>

    <div class="py-12 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="form-container">
            @if ($errors->any())
                <div class="mb-4 rounded-md bg-red-100 p-4 text-red-700">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <h2>Cập nhật thông tin xe</h2>

                <div>
                    <label for="image" class="form-label">Ảnh xe hiện tại</label>
                    @if ($car->image)
                        <img src="{{ asset('storage/' . $car->image) }}" alt="Ảnh xe" class="car-image">
                    @else
                        <p class="text-gray-500">Chưa có ảnh</p>
                    @endif
                </div>

                <div>
                    <label for="image" class="form-label">Thay đổi ảnh xe</label>
                    <input type="file" name="image" id="image" accept="image/*" class="form-input">
                </div>

                <div>
                    <label for="name" class="form-label">Tên xe</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $car->name) }}" required class="form-input">
                </div>

                <div>
                    <label for="brand" class="form-label">Hãng</label>
                    <input type="text" name="brand" id="brand" value="{{ old('brand', $car->brand) }}" required class="form-input">
                </div>

                <div>
                    <label for="year" class="form-label">Năm sản xuất</label>
                    <input type="number" name="year" id="year" min="1900" max="{{ date('Y') }}" value="{{ old('year', $car->year) }}" required class="form-input">
                </div>

                <div>
                    <label for="price" class="form-label">Giá</label>
                    <input type="number" step="100000" name="price" id="price" min="0" value="{{ old('price', $car->price) }}" required class="form-input">
                </div>

                <div>
                    <label for="note" class="form-label">Ghi chú</label>
                    <textarea name="note" id="note" rows="3" class="form-input">{{ old('note', $car->note) }}</textarea>
                </div>

                <div class="flex gap-4 mt-6">
                    <button type="submit" class="form-button">Cập nhật</button>
                    <a href="{{ route('cars.index') }}" class="form-button cancel">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
