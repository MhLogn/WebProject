<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl text-white font-semibold leading-tight">Đặt lịch dịch vụ</h2>
    </x-slot>

    <style>
        /* Container chính */
        .form-wrapper {
            margin: 2rem auto;
            background-color: #fff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgb(0 0 0 / 0.1);
            transition: opacity 0.6s ease;
            opacity: 1;
        }

        /* Ẩn hiện form với fade */
        .fade-out {
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.6s ease;
        }
        .fade-in {
            opacity: 1;
            pointer-events: auto;
            transition: opacity 0.6s ease;
        }

        /* Tiêu đề */
        .form-wrapper h2 {
            font-size: 1.75rem;
            color: #222;
            margin-bottom: 2rem;
            text-align: center;
            font-weight: 700;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Nhóm input */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #2c3e50;
            font-size: 1rem;
            user-select: none;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 0.65rem 1rem;
            font-size: 1rem;
            font-family: inherit;
            border: 2px solid #d1d5db;
            border-radius: 8px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            resize: vertical;
            font-weight: 400;
            color: #1f2937;
            background-color: #fefefe;
            box-sizing: border-box;
            line-height: 1.4;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="date"]:focus,
        select:focus,
        textarea:focus {
            border-color: #3b82f6;
            outline: none;
            box-shadow: 0 0 6px #3b82f6aa;
            background-color: #fff;
        }

        textarea {
            min-height: 90px;
        }

        /* Lỗi */
        .error-message {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.3rem;
            font-weight: 600;
            font-family: monospace;
        }

        /* Thông báo thành công */
        .success-message {
            background-color: #dcfce7;
            color: #166534;
            border: 1.5px solid #22c55e;
            padding: 1rem 1.25rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-weight: 600;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-align: center;
            user-select: none;
        }

        /* Thông báo lỗi chung */
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

        /* Nút gửi */
        button.submit-btn {
            width: 100%;
            background-color: #3b82f6;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 10px;
            font-size: 1.125rem;
            font-weight: 700;
            cursor: pointer;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            user-select: none;
        }
        button.submit-btn:hover {
            background-color: #2563eb;
            box-shadow: 0 8px 20px rgb(37 99 235 / 0.5);
        }

        /* Responsive */
        @media (max-width: 520px) {
            .form-wrapper {
                margin: 1rem;
                padding: 1.5rem;
            }
        }
    </style>

    <div id="form-container" class="form-wrapper fade-in">
        @if(session('success'))
            <div class="success-message" role="alert" aria-live="polite">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error-list" role="alert" aria-live="assertive">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="schedule-form" action="{{ route('schedule.store') }}" method="POST" novalidate>
            @csrf

            <div class="form-group">
                <label for="name">Họ và tên</label>
                <input type="text" name="name" id="name" required value="{{ old('name') }}" autocomplete="name" />
                @error('name') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="phone">Số điện thoại</label>
                <input type="text" name="phone" id="phone" required value="{{ old('phone') }}" autocomplete="tel" />
                @error('phone') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="email">Email (không bắt buộc)</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" autocomplete="email" />
                @error('email') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="service">Dịch vụ</label>
                <select name="service" id="service" required>
                    <option value="">Chọn dịch vụ</option>
                    <option value="Tư vấn" {{ old('service') == 'Tư vấn' ? 'selected' : '' }}>Tư vấn</option>
                    <option value="Lái thử" {{ old('service') == 'Lái thử' ? 'selected' : '' }}>Lái thử</option>
                    <option value="Bảo dưỡng" {{ old('service') == 'Bảo dưỡng' ? 'selected' : '' }}>Bảo dưỡng</option>
                </select>
                @error('service') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="date">Ngày đặt</label>
                <input
                    type="date"
                    name="date"
                    id="date"
                    required
                    value="{{ old('date') }}"
                    min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}"
                    autocomplete="off"
                />
                @error('date') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="note">Ghi chú (không bắt buộc)</label>
                <textarea name="note" id="note" autocomplete="off">{{ old('note') }}</textarea>
            </div>

            <div class="text-right">
                <button type="submit" class="submit-btn" id="submit-btn">Đặt lịch</button>
            </div>
        </form>
    </div>

    <script>
        // Khi submit thành công hoặc load lại có session success thì bật hiệu ứng fade-in
        document.addEventListener('DOMContentLoaded', () => {
            const formContainer = document.getElementById('form-container');

            // Nếu có session success thì fade out form rồi fade in lại nhẹ nhàng
            @if(session('success'))
                formContainer.classList.remove('fade-in');
                formContainer.classList.add('fade-out');

                setTimeout(() => {
                    formContainer.classList.remove('fade-out');
                    formContainer.classList.add('fade-in');
                }, 600);
            @endif
        });

        // Có thể mở rộng thêm hiệu ứng submit hoặc validate nếu muốn
    </script>
</x-app-layout>
