<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Thêm xe mới
        </h2>
    </x-slot>

    <div class="py-12 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

            @if ($errors->any())
                <div class="mb-4 rounded-md bg-red-50 p-4">
                    <ul class="list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label for="image" class="block font-medium text-sm text-gray-700">Ảnh xe</label>
                    <input type="file" name="image" id="image" accept="image/*"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                </div>

                <div>
                    <label for="name" class="block font-medium text-sm text-gray-700">Tên xe</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                </div>

                <div>
                    <label for="brand" class="block font-medium text-sm text-gray-700">Hãng</label>
                    <input type="text" name="brand" id="brand" value="{{ old('brand') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                </div>

                <div>
                    <label for="year" class="block font-medium text-sm text-gray-700">Năm sản xuất</label>
                    <input type="number" name="year" id="year" min="1900" max="{{ date('Y') }}" value="{{ old('year') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                </div>

                <div>
                    <label for="price" class="block font-medium text-sm text-gray-700">Giá</label>
                    <input type="number" step="100000" name="price" id="price" min="0" value="{{ old('price') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                </div>

                <div>
                    <label for="note" class="block font-medium text-sm text-gray-700">Ghi chú</label>
                    <textarea name="note" id="note" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('note') }}</textarea>
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Lưu
                    </button>
                    <a href="{{ route('cars.index') }}" class="text-gray-600 hover:underline">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
