<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            Giỏ hàng của bạn
        </h2>
    </x-slot>

    <div class="py-12 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg border border-green-300">
                    {{ session('success') }}
                </div>
            @endif

            @if($cartItems->isEmpty())
                <p class="text-gray-600 italic text-center">Giỏ hàng đang trống.</p>
            @else
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-indigo-100 text-indigo-700">
                            <th class="px-4 py-2 text-left">Ảnh</th>
                            <th class="px-4 py-2 text-left">Tên xe</th>
                            <th class="px-4 py-2 text-left">Hãng</th>
                            <th class="px-4 py-2 text-center">Số lượng</th>
                            <th class="px-4 py-2 text-center">Hành động</th> 
                            <th class="px-4 py-2 text-right">Giá</th>
                            <th class="px-4 py-2 text-right">Thành tiền</th>
                            <th class="px-4 py-2 text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($cartItems as $item)
                            @php
                                $subtotal = $item->quantity * $item->car->price;
                                $total += $subtotal;
                            @endphp
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2">
                                    @if($item->car->image)
                                        <img src="{{ asset('storage/' . $item->car->image) }}" alt="Ảnh xe" class="w-24 h-16 object-cover rounded">
                                    @else
                                        <span class="text-gray-400 italic">Không ảnh</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 font-medium text-gray-900">{{ $item->car->name }}</td>
                                <td class="px-4 py-2 text-gray-700">{{ $item->car->brand }}</td>
                                <td class="px-4 py-2 text-center">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" id="update-form-{{ $item->id }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                                            class="w-16 border border-gray-300 rounded px-2 py-1 text-center focus:outline-none focus:ring focus:border-indigo-400">
                                    </form>
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <!-- Nút cập nhật riêng biệt, gọi submit form cập nhật -->
                                    <button type="submit" form="update-form-{{ $item->id }}" 
                                        class="text-red-600 hover:text-red-800 font-semibold border border-gray-300 rounded px-3 py-1 transition">
                                        Cập nhật
                                    </button>
                                </td>
                                <td class="px-4 py-2 text-right">{{ number_format($item->car->price, 0, ',', '.') }} USĐ</td>
                                <td class="px-4 py-2 text-right text-indigo-700 font-semibold">
                                    {{ number_format($subtotal, 0, ',', '.') }} USĐ
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Xóa xe này khỏi giỏ hàng?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 font-semibold border border-gray-300 rounded px-3 py-1 transition">
                                            Xóa
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="bg-indigo-50 font-bold">
                            <td colspan="6" class="text-right px-4 py-3">Tổng cộng:</td>
                            <td class="text-right px-4 py-3 text-indigo-800">
                                {{ number_format($total, 0, ',', '.') }} USĐ
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            @endif
            
            @if(!$cartItems->isEmpty())
            <div class="mt-6 text-right">
                <a href="{{ route('cart.checkout.form') }}" 
                class="bg-green-600 px-4 py-2 rounded-lg hover:bg-green-700 shadow-lg transition">
                Tư Vấn
            </a>
        </div>
        @endif
        </div>
    </div>
</x-app-layout>
