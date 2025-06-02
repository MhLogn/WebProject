    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Yêu cầu tư vấn từ khách hàng {{ $data['name'] }}
    </h2>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow rounded-lg p-6">
                <p><strong>Email:</strong> {{ $data['email'] }}</p>
                <p><strong>Số điện thoại:</strong> {{ $data['phone'] ?? 'Không có' }}</p>
                <p><strong>Địa chỉ:</strong> {{ $data['address'] ?? 'Không có' }}</p>
                <p><strong>Nội dung:</strong> {{ $data['message'] ?? 'Không có' }}</p>

                <h3 class="mt-6 mb-4 text-lg font-medium text-gray-900">Chi tiết giỏ hàng:</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300 divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 border border-gray-300 text-left text-sm font-semibold text-gray-700">Ảnh</th>
                                <th class="px-4 py-2 border border-gray-300 text-left text-sm font-semibold text-gray-700">Tên xe</th>
                                <th class="px-4 py-2 border border-gray-300 text-left text-sm font-semibold text-gray-700">Hãng</th>
                                <th class="px-4 py-2 border border-gray-300 text-left text-sm font-semibold text-gray-700">Số lượng</th>
                                <th class="px-4 py-2 border border-gray-300 text-left text-sm font-semibold text-gray-700">Giá 1 xe</th>
                                <th class="px-4 py-2 border border-gray-300 text-left text-sm font-semibold text-gray-700">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($data['cartItems'] as $item)
                            <tr>
                                <td class="px-4 py-2 border border-gray-300">
                                    <img src="{{ asset('storage/cars/' . $item->car->image) }}" alt="{{ $item->car->name }}" class="w-24 h-auto object-cover rounded">
                                </td>
                                <td class="px-4 py-2 border border-gray-300">{{ $item->car->name }}</td>
                                <td class="px-4 py-2 border border-gray-300">{{ $item->car->brand }}</td>
                                <td class="px-4 py-2 border border-gray-300">{{ $item->quantity }}</td>
                                <td class="px-4 py-2 border border-gray-300">{{ number_format($item->car->price, 0, ',', '.') }} đ</td>
                                <td class="px-4 py-2 border border-gray-300">{{ number_format($item->quantity * $item->car->price, 0, ',', '.') }} đ</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <p class="mt-4 text-right font-semibold text-lg">
                    Tổng tiền: {{ number_format($data['total'], 0, ',', '.') }} đ
                </p>
            </div>
        </div>
    </div>