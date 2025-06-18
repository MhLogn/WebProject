<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold leading-tight text-center fade-in">
            Yêu cầu tư vấn - Thanh toán
        </h1>
    </x-slot>

    <style>
        /* Fade-in animation */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s ease-out forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Wrapper */
        .form-wrapper {
            margin: auto;
            padding: 2rem 1rem;
        }

        /* Form sections */
        .form-section {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            animation: fadeInUp 1s ease-out forwards;
        }

        label {
            font-weight: 600;
            margin-bottom: 0.25rem;
            display: block;
            color: #1f2937;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.75rem;
            font-size: 1rem;
            background-color: #f9fafb;
            transition: border 0.2s, background 0.3s;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #3b82f6;
            background-color: #fff;
        }

        textarea {
            resize: vertical;
        }

        .error-msg {
            color: #dc2626;
            font-size: 0.9rem;
        }

        .car-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 1rem;
        }

        .car-item {
            display: flex;
            gap: 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            padding: 1rem;
            align-items: center;
            background-color: #f1f5f9;
            transition: box-shadow 0.3s, transform 0.3s;
        }

        .car-item:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .car-item img {
            width: 350px;
            height: px;
            object-fit: cover;
            border-radius: 0.5rem;
        }

        .submit-btn {
            background-color: #3b82f6;
            color: white;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 0.75rem;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 1.5rem;
            align-self: flex-end;
        }

        .submit-btn:hover {
            background-color: #2563eb;
        }

        .total-price {
            font-weight: bold;
            font-size: 1.2rem;
            margin-top: 1.2rem;
            text-align: right;
        }

        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            padding: 1rem;
            border-radius: 0.75rem;
            margin-bottom: 1rem;
            text-align: center;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .car-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .car-item img {
                width: 100%;
                height: auto;
            }

            .submit-btn {
                width: 100%;
                text-align: center;
            }

            h1 {
                font-size: 1.25rem;
            }

            .total-price {
                text-align: left;
            }
        }
    </style>

    <div class="form-wrapper">
        @if(session('error'))
            <div class="alert-error fade-in">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('cart.checkout.submit') }}" method="POST" class="form-section">
            @csrf

            <div class="fade-in">
                <label>Họ và tên <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required>
                @error('name') <p class="error-msg">{{ $message }}</p> @enderror
            </div>

            <div class="fade-in">
                <label>Email <span class="text-red-500">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="Nhập email nếu có">
                @error('email') <p class="error-msg">{{ $message }}</p> @enderror
            </div>

            <div class="fade-in">
                <label>Số điện thoại</label>
                <input type="text" name="phone" value="{{ old('phone') }}">
                @error('phone') <p class="error-msg">{{ $message }}</p> @enderror
            </div>

            <div class="fade-in">
                <label>Địa chỉ</label>
                <input type="text" name="address" value="{{ old('address') }}" placeholder="Nhập rõ địa chỉ nhà của bạn">
                @error('address') <p class="error-msg">{{ $message }}</p> @enderror
            </div>

            <div class="fade-in">
                <label>Nội dung yêu cầu tư vấn</label>
                <textarea name="message" rows="4" placeholder="Bạn cần chúng tôi tư vấn về mẫu xe nào hãy cho chúng tôi biết cụ thể ?">{{ old('message') }}</textarea>
                @error('message') <p class="error-msg">{{ $message }}</p> @enderror
            </div>

            <h2 class="text-xl font-semibold mt-6 fade-in">Mẫu xe cần tư vấn</h2>

            <div class="car-list">
                @foreach ($cartItems as $item)
                    <div class="car-item fade-in">
                        <img src="{{ asset('storage/' . $item->car->image) }}" alt="{{ $item->car->name }}">
                        <div>
                            <div class="font-bold">{{ $item->car->name }} ({{ $item->car->brand }})</div>
                            <div>Số lượng: {{ $item->quantity }}</div>
                            <div>Giá: {{ number_format($item->car->price, 0, ',', '.') }} USĐ</div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="total-price fade-in">
                Tổng tiền: {{ number_format($total, 0, ',', '.') }} USĐ
            </div>

            <button type="submit" class="submit-btn fade-in">Gửi yêu cầu tư vấn</button>
        </form>
    </div>
</x-app-layout>
