<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Đặt lịch dịch vụ</h2>
    </x-slot>

    <div class="max-w-xl mx-auto mt-6">
        @if(session('success'))
            <div class="p-4 mb-4 text-green-700 bg-green-100 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('schedule.store') }}" method="POST" class="bg-white p-6 rounded shadow">
            @csrf

            <div class="mb-4">
                <label for="name" class="block font-medium">Họ và tên</label>
                <input type="text" name="name" id="name" required class="w-full border p-2 rounded" value="{{ old('name') }}">
                @error('name') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="phone" class="block font-medium">Số điện thoại</label>
                <input type="text" name="phone" id="phone" required class="w-full border p-2 rounded" value="{{ old('phone') }}">
                @error('phone') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block font-medium">Email (không bắt buộc)</label>
                <input type="email" name="email" id="email" class="w-full border p-2 rounded" value="{{ old('email') }}">
                @error('email') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="service" class="block font-medium">Dịch vụ</label>
                <select name="service" id="service" required class="w-full border p-2 rounded">
                    <option value="">Chọn dịch vụ</option>
                    <option value="Tư vấn" {{ old('service') == 'Tư vấn' ? 'selected' : '' }}>Tư vấn</option>
                    <option value="Lái thử" {{ old('service') == 'Lái thử' ? 'selected' : '' }}>Lái thử</option>
                    <option value="Bảo dưỡng" {{ old('service') == 'Bảo dưỡng' ? 'selected' : '' }}>Bảo dưỡng</option>
                </select>
                @error('service') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="date" class="block font-medium">Ngày đặt</label>
                <input type="date" name="date" id="date" required class="w-full border p-2 rounded" value="{{ old('date') }}">
                @error('date') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="note" class="block font-medium">Ghi chú (không bắt buộc)</label>
                <textarea name="note" id="note" class="w-full border p-2 rounded">{{ old('note') }}</textarea>
            </div>

            <button type="submit" class="bg-blue-600 px-4 py-2 rounded hover:bg-blue-700">Đặt lịch</button>
        </form>
    </div>
</x-app-layout>
