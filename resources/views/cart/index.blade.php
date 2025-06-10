<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight text-center">
            Giỏ hàng của bạn
        </h2>
    </x-slot>

    <style>
        .fade-in {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .cart-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 0.75rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .cart-table th,
        .cart-table td {
            padding: 0.75rem 1rem;
            vertical-align: middle;
            text-align: center;
        }

        .cart-table thead tr {
            background-color: #4338ca;
            color: #fff;
            text-transform: uppercase;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .cart-table tbody tr {
            background: #fff;
            border-radius: 0.75rem;
            box-shadow: 0 4px 8px rgb(0 0 0 / 0.08);
            transition: background-color 0.25s ease, box-shadow 0.3s ease;
        }

        .cart-table tbody tr:hover {
            background-color: #e0e7ff;
        }

        .cart-table td.font-semibold {
            font-weight: 600;
            color: #1f2937;
        }

        .cart-table td.text-indigo-700 {
            color: #4338ca;
            font-weight: 700;
        }

        .cart-table tr.bg-indigo-100 {
            background-color: #e0e7ff;
            font-weight: 700;
            color: #312e81;
            font-size: 1.1rem;
        }

        .car-image {
            width: 240px;
            height: 130px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.12);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .car-image:hover {
            transform: scale(1.08);
        }

        input[type="number"] {
            width: 60px;
            padding: 0.4rem;
            border: 1.5px solid #cbd5e1;
            border-radius: 8px;
            font-size: 1rem;
            text-align: center;
        }

        input[type="number"]:focus {
            border-color: #4338ca;
            outline: none;
            box-shadow: 0 0 0 3px rgba(67, 56, 202, 0.3);
        }

        .btn-update {
            background-color: #4338ca;
            color: white;
            font-weight: 600;
            border-radius: 0.5rem;
            padding: 0.35rem 1.1rem;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .btn-remove {
            background-color: #dc2626;
            color: white;
            font-weight: 600;
            border-radius: 0.5rem;
            padding: 0.35rem 1.1rem;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .btn-consult {
            background-color: #16a34a;
            color: white;
            padding: 0.85rem 1.8rem;
            border-radius: 0.75rem;
            font-weight: 700;
            font-size: 1.1rem;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
            user-select: none;
        }

        .btn-consult:hover {
            background-color: #15803d;
        }

        .success-message {
            background-color: #dcfce7;
            color: #166534;
            border: 1.5px solid #4ade80;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
            font-size: 1rem;
            animation: fadeIn 0.4s ease-in-out;
        }

        .empty-cart-text {
            font-style: italic;
            color: #6b7280;
            text-align: center;
            font-size: 1rem;
            padding: 2rem 0;
        }

        @media (max-width: 768px) {
            .cart-table th, .cart-table td {
                font-size: 0.8rem;
                padding: 0.5rem;
            }

            .car-image {
                width: 100px;
                height: 60px;
            }

            .btn-consult {
                font-size: 1rem;
                padding: 0.6rem 1.4rem;
            }

            input[type="number"] {
                width: 45px;
                font-size: 0.9rem;
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <div class="py-10 fade-in">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4 md:p-6">

            @if(session('success'))
                <div class="success-message text-center">
                    {{ session('success') }}
                </div>
            @endif

            @if($cartItems->isEmpty())
                <p class="empty-cart-text">Giỏ hàng đang trống.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full cart-table">
                        <thead>
                            <tr>
                                <th>Ảnh</th>
                                <th>Tên xe</th>
                                <th>Hãng</th>
                                <th>Số lượng</th>
                                <th>Cập nhật</th>
                                <th>Giá</th>
                                <th>Thành tiền</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach($cartItems as $item)
                                @php
                                    $subtotal = $item->quantity * $item->car->price;
                                    $total += $subtotal;
                                @endphp
                                <tr>
                                    <td>
                                        @if($item->car->image)
                                            <img src="{{ asset('storage/' . $item->car->image) }}" alt="Ảnh xe" class="car-image mx-auto">
                                        @else
                                            <span class="text-gray-400 italic">Không ảnh</span>
                                        @endif
                                    </td>
                                    <td class="font-semibold text-gray-900">{{ $item->car->name }}</td>
                                    <td class="text-gray-700">{{ $item->car->brand }}</td>
                                    <td>
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" id="update-form-{{ $item->id }}">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1">
                                        </form>
                                    </td>
                                    <td>
                                        @if ($item->status === 'active')
                                            <button type="submit" form="update-form-{{ $item->id }}" class="btn-update">
                                                Cập nhật
                                            </button>
                                        @endif
                                    </td>
                                    <td>{{ number_format($item->car->price, 0, ',', '.') }} USĐ</td>
                                    <td class="text-indigo-700 font-bold">
                                        {{ number_format($subtotal, 0, ',', '.') }} USĐ
                                    </td>
                                    <td>
                                        @if ($item->status === 'active')
                                            <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Xóa xe này khỏi giỏ hàng?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-remove">
                                                    Xóa
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="bg-indigo-100 font-bold text-lg">
                                <td colspan="6">Tổng cộng:</td>
                                <td class="text-indigo-900">
                                    {{ number_format($total, 0, ',', '.') }} USĐ
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif

            @if(!$cartItems->isEmpty())
                <div class="mt-8 flex justify-end">
                        <a href="{{ route('cart.checkout.form') }}" class="btn-consult">
                            Tư Vấn
                        </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
