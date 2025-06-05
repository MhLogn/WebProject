<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Thêm xe mới
        </h2>
    </x-slot>

    <style>
        /* Container */
        #form-container {
            margin: 2rem auto;
            background: #fff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgb(0 0 0 / 0.1);
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }
        #form-container.show {
            opacity: 1;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #374151; /* gray-700 */
            user-select: none;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 0.6rem 1rem;
            font-size: 1rem;
            border: 2px solid #d1d5db; /* gray-300 */
            border-radius: 8px;
            outline: none;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            font-family: inherit;
            font-weight: 400;
            background-color: #fefefe;
            box-sizing: border-box;
            line-height: 1.4;
            resize: vertical;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="file"]:focus,
        textarea:focus {
            border-color: #3b82f6; /* blue-500 */
            box-shadow: 0 0 6px #3b82f6aa;
            background-color: #fff;
        }

        textarea {
            min-height: 90px;
        }

        button[type="submit"] {
            width: 90%;
            padding: 0.75rem;
            background-color: #3b82f6; /* blue-500 */
            color: white;
            font-weight: 700;
            font-size: 1.125rem;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            user-select: none;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            font-family: inherit;
        }
        button[type="submit"]:hover {
            background-color: #2563eb; /* blue-600 */
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.5);
        }

        .cancel-link {
            padding: 0.75rem;
            background-color: #ff0f0f;
            color: white;
            font-weight: 700;
            font-size: 1.125rem;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            user-select: none;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            font-family: inherit;
        }
        .cancel-link:hover {
            color: #374151; /* gray-700 */
        }

        .error-list {
            background-color: #fee2e2;
            color: #b91c1c;
            border: 1.5px solid #ef4444;
            padding: 1rem 1.25rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-weight: 600;
            font-family: monospace;
            user-select: none;
        }
        .error-list ul {
            list-style: inside disc;
            margin: 0;
            padding-left: 1rem;
        }

        /* Responsive */
        @media (max-width: 520px) {
            #form-container {
                margin: 1rem;
                padding: 1.5rem;
            }
        }
    </style>

    <div id="form-container">
        @if ($errors->any())
            <div class="error-list" role="alert" aria-live="assertive">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="car-form" action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf

            <label for="image">Ảnh xe</label>
            <input type="file" name="image" id="image" accept="image/*" />

            <label for="name">Tên xe</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required />

            <label for="brand">Hãng</label>
            <input type="text" name="brand" id="brand" value="{{ old('brand') }}" required />

            <label for="year">Năm sản xuất</label>
            <input type="number" name="year" id="year" min="1900" max="{{ date('Y') }}" value="{{ old('year') }}" required />

            <label for="price">Giá</label>
            <input type="number" step="100000" name="price" id="price" min="0" value="{{ old('price') }}" required />

            <label for="note">Ghi chú</label>
            <textarea name="note" id="note" rows="3">{{ old('note') }}</textarea>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1.5rem;">
                <button type="submit">Lưu</button>
                <a href="{{ route('cars.index') }}" class="cancel-link">Hủy</a>
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
                }, 500); // chờ 0.5s rồi submit form
            });
        });
    </script>
</x-app-layout>
