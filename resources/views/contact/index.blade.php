<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Thông tin liên hệ của chúng tôi') }}
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

        .contact-container {
            background-color: #f9fafb;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: 0 auto;
            display: flex;
            gap: 2rem;
        }

        .left-column {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 220px;
        }

        .contact-avatar {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 9999px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            margin-bottom: 1rem;
        }

        .contact-name {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .contact-info-text {
            font-size: 1.125rem;
            color: #4b5563;
            margin-bottom: 0.5rem;
        }

        .contact-links a {
            display: inline-flex;
            align-items: center;
            color: #4f46e5;
            margin-top: 0.5rem;
            text-decoration: none;
        }

        .contact-links a:hover {
            text-decoration: underline;
            color: #4338ca;
        }

        .contact-links img {
            width: 1.5rem;
            height: 1.5rem;
            margin-right: 0.5rem;
        }

        .right-column {
            flex: 1;
        }

        .contact-form label {
            font-weight: 600;
            color: #374151;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 0.5rem;
            border-radius: 0.375rem;
            border: 1px solid #d1d5db;
            margin-top: 0.25rem;
            margin-bottom: 1rem;
        }

        .contact-form input:focus,
        .contact-form textarea:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.3);
        }

        .contact-form button {
            background-color: #4f46e5;
            color: #fff;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .contact-form button:hover {
            background-color: #4338ca;
        }

        @media (max-width: 768px) {
            .contact-container {
                flex-direction: column;
                padding: 1rem;
                max-width: 100%;
            }

            .left-column {
                width: 100%;
                align-items: center;
                text-align: center;
            }

            .contact-avatar {
                width: 120px;
                height: 120px;
                margin-bottom: 0.75rem;
            }

            .contact-name {
                font-size: 1.5rem;
                margin-bottom: 0.25rem;
            }

            .contact-info-text {
                font-size: 1rem;
                margin-bottom: 1rem;
            }

            .contact-links a {
                justify-content: center;
                margin-top: 0.3rem;
            }

            .right-column {
                width: 100%;
                margin-top: 2rem;
            }

            .contact-form button {
                width: 100%;
            }
        }
    </style>

    <div class="py-12 fade-in">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="contact-container">

                {{-- Left Column --}}
                <div class="left-column">
                    <img src="{{ asset('storage/logo/avt-img.png') }}" alt="Avatar" class="contact-avatar">
                    <h2 class="contact-name">Hà Mạnh Long</h2>
                    <p class="contact-info-text">Bạn có thể liên hệ với tôi qua địa chỉ:</p>
                    <div class="contact-links">
                        <a href="mailto:hamanhlong39@gmail.com" target="_blank">📧hamanhlong39@gmail.com</a>
                        <a href="https://www.facebook.com/hamanhlong.2206" target="_blank">
                            <img src="{{ asset('storage/logo/facebook-icon.png') }}" alt="Facebook">
                            Facebook: Hà Mạnh Long
                        </a>
                        <a href="https://zalo.me/0377191508" target="_blank">
                            <img src="{{ asset('storage/logo/zalo-icon.png') }}" alt="Zalo">
                            Zalo: Hà Mạnh Long
                        </a>
                    </div>
                </div>

                {{-- Right Column --}}
                <div class="right-column">
                    @if (session('success'))
                        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <p class="text-gray-600 mb-4">Hoặc gửi tin nhắn cho tôi qua form:</p>

                    <form class="contact-form" method="POST" action="{{ route('contact.send') }}">
                        @csrf

                        <label for="name">Họ và tên</label>
                        <input type="text" id="name" name="name" required>

                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>

                        <label for="subject">Chủ đề</label>
                        <input type="text" id="subject" name="subject" required>

                        <label for="message">Nội dung</label>
                        <textarea id="message" name="message" rows="5" required></textarea>

                        <div class="flex justify-end">
                            <button type="submit">Gửi liên hệ</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
