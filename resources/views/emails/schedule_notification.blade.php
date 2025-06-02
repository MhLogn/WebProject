<h2>Thông tin đặt lịch mới:</h2>
<ul>
    <li><strong>Họ tên:</strong> {{ $scheduleData['name'] }}</li>
    <li><strong>Số điện thoại:</strong> {{ $scheduleData['phone'] }}</li>
    <li><strong>Email:</strong> {{ $scheduleData['email'] ?? 'Không có' }}</li>
    <li><strong>Dịch vụ:</strong> {{ $scheduleData['service'] }}</li>
    <li><strong>Ngày hẹn:</strong> {{ $scheduleData['date'] }}</li>
    <li><strong>Ghi chú:</strong> {{ $scheduleData['note'] ?? 'Không có' }}</li>
</ul>
