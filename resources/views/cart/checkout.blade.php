<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold leading-tight">
            Yêu cầu tư vấn - Thanh toán
        </h1>
    </x-slot>

    <div class="container mx-auto p-6 max-w-3xl">
        @if(session('error'))
            <div class="bg-red-200 text-red-800 p-3 mb-4 rounded">{{ session('error') }}</div>
        @endif

        <form action="{{ route('cart.checkout.submit') }}" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label class="block font-semibold">Họ và tên <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2">
                @error('name') <p class="text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold">Email <span class="text-red-500">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Nhập email nếu có">
                @error('email') <p class="text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold">Số điện thoại</label>
                <input type="text" name="phone" value="{{ old('phone') }}"
                    class="w-full border border-gray-300 rounded px-3 py-2">
                @error('phone') <p class="text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold">Địa chỉ</label>
                <input type="text" name="address" value="{{ old('address') }}"
                    class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Nhập rõ địa chỉ nhà của bạn">
                @error('address') <p class="text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold">Nội dung yêu cầu tư vấn</label>
                <textarea name="message" rows="4" class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Bạn cần chúng tôi tư vấn về mẫu xe nào hãy cho chúng tôi biết cụ thể ?">{{ old('message') }}</textarea>
                @error('message') <p class="text-red-600">{{ $message }}</p> @enderror
            </div>

            <h2 class="text-xl font-semibold mt-8 mb-4">Mẫu xe cần tư vấn</h2>
            <ul class="space-y-3">
                @foreach ($cartItems as $item)
                    <li class="flex items-center space-x-4 border border-gray-200 rounded p-3">
                        <img src="{{ asset('storage/' . $item->car->image) }}" alt="{{ $item->car->name }}" class="w-20 h-12 object-cover rounded">
                        <div>
                            <div class="font-bold">{{ $item->car->name }} ({{ $item->car->brand }})</div>
                            <div>Số lượng: {{ $item->quantity }}</div>
                            <div>Giá: {{ number_format($item->car->price, 0, ',', '.') }} đ</div>
                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="mt-6 font-bold text-lg">
                Tổng tiền: {{ number_format($total, 0, ',', '.') }} đ
            </div>

            <button type="submit" class="mt-6 bg-blue-600 px-5 py-2 rounded hover:bg-blue-700">
                Gửi yêu cầu tư vấn
            </button>
        </form>
    </div>
</x-app-layout>
