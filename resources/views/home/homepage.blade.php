<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            CarZone – Khởi đầu hành trình mới của bạn
        </h2>
    </x-slot>

    {{-- CSS riêng --}}
    <style>
        .car-block {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-radius: 1rem;
            padding: 1.5rem;
            position: relative;
            gap: 1.5rem;
        }
        .car-block.reverse {
            flex-direction: row-reverse;
        }
        .car-block img {
            width: 60%;
            height: auto;
            object-fit: cover;
            border-radius: 0.5rem;
        }
        .text-content {
            width: 40%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            gap: 1rem;
        }
        .text-content h1 {
            font-size: 1rem;
            font-weight: 600;
            color: #111827;
        }
        .text-content p {
            font-size: 0.875rem;
            color: #4b5563;
            line-height: 1.5;
        }
        .text-content a {
            display: inline-block;
            background-color: #1F2937;
            color: white;
            font-weight: 600;
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            text-decoration: none;
            transition: background-color 0.3s ease;
            margin: 0 auto;
        }
        .text-content a:hover {
            background-color: #3a8b5f;
        }
        .slider-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0,0,0,0.5);
            color: white;
            padding: 0.5rem 0.8rem;
            font-size: 1.5rem;
            cursor: pointer;
            border-radius: 50%;
            user-select: none;
        }
        .slider-arrow.left {
            left: 10px;
        }
        .slider-arrow.right {
            right: 10px;
        }
        .slider-counter {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background-color: rgba(0,0,0,0.5);
            color: white;
            padding: 0.3rem 0.6rem;
            font-size: 0.875rem;
            border-radius: 0.3rem;
        }
        .schedule-container {
            background-color: white;
            padding: 2rem 1rem;
            border-radius: 1rem;
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 1rem;
            flex-wrap: wrap;
        }
        .schedule-item {
            background-color: #f9fafb;
            border-radius: 0.75rem;
            padding: 1rem;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            text-decoration: none;
            color: #374151;
        }
        .schedule-item img {
            width: 300px;
            height: 230px;
            object-fit: cover;
            border-radius: 0.5rem;
            margin-bottom: 0.75rem;
        }
        .schedule-item:hover {
            transform: translateY(-5px);
            background-color: #1F2937;
            color: white;
        }
        .schedule-item:hover p {
            color: white;
        }
        @media (max-width: 768px) {
            .car-block {
                flex-direction: column;
                text-align: center;
            }
            .car-block.reverse {
                flex-direction: column;
            }
            .car-block img {
                width: 100%;
                margin-bottom: 1rem;
            }
            .text-content {
                width: 100%;
            }
            .schedule-container {
                flex-direction: column;
                gap: 1.5rem;
            }
        }
        /* Brand Section */
        .brand-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill,minmax(180px,1fr));
            gap: 1.5rem;
            padding: 0 1rem;
        }

        .brand-item {
            background: white;
            border-radius: 1rem;
            padding: 1rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            text-align: center;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
        }
        .brand-item:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        .brand-item img.car {
            width: 100%;
            max-height: 120px;
            object-fit: contain;
            margin: 0;
        }
        .brand-item img.logo {
            max-width: 80px;
            max-height: 40px;
            object-fit: contain;
            margin: 0;
        }
        @media (max-width: 768px) {
            .brand-item img.car {
                max-height: 100px;
            }
            .brand-item img.logo {
                max-width: 60px;
                max-height: 30px;
            }
        }
    </style>

    {{-- Slider Section --}}
    <div class="container-space">
        <div class="car-block" id="car-block">
            <img id="slider-image" src="{{ asset('storage/imghome/imghome1.png') }}" alt="Car Image">
            <div class="slider-arrow left" id="prev-arrow">&#10094;</div>
            <div class="slider-arrow right" id="next-arrow">&#10095;</div>
            <div class="slider-counter" id="slider-counter">1 / 4</div>

            <div class="text-content">
                <h1 id="slider-title">CarZone – Khởi đầu hành trình mới cùng bạn</h1>
                <p id="slider-description">CarZone mang đến những mẫu xe hiện đại, sang trọng và tiện nghi, phù hợp với mọi nhu cầu và phong cách sống của bạn.</p>
                <a href="{{ route('cars.index', ['id' => 1]) }}" id="slider-link">Xem chi tiết</a>
            </div>
        </div>
    </div>

    {{-- Schedule Section --}}
    <div class="schedule-container">
        <a href="{{ route('schedule.form') }}" class="schedule-item">
            <img src="{{ asset('storage/imghome/tuvan.png') }}" alt="Đặt Lịch Tư vấn" />
            <p>Đặt Lịch Tư vấn</p>
        </a>
        <a href="{{ route('schedule.form') }}" class="schedule-item">
            <img src="{{ asset('storage/imghome/laithu.png') }}" alt="Đặt Lịch Lái Thử" />
            <p>Đặt Lịch Lái Thử</p>
        </a>
        <a href="{{ route('schedule.form') }}" class="schedule-item">
            <img src="{{ asset('storage/imghome/baoduong.png') }}" alt="Đặt Lịch Bảo Dưỡng" />
            <p>Đặt Lịch Bảo Dưỡng</p>
        </a>
    </div>

    {{-- Brand Section --}}
    <h2 class="text-car mt-12 mb-6 text-2xl font-semibold text-center text-gray-700"></h2>

    <div class="brand-grid px-4 md:px-10">
        @php
            $brands = [
                ['car' => 'bmw-car.png', 'logo' => 'BMW-logo.png'],
                ['car' => 'lam-car.png', 'logo' => 'lam-logo.png'],
                ['car' => 'lexus-car.png', 'logo' => 'lexus-logo.png'],
                ['car' => 'mer-car.png', 'logo' => 'mer-logo.png'],
                ['car' => 'pc-car.png', 'logo' => 'pc-logo.png'],
                ['car' => 'rr-car.png', 'logo' => 'rr-logo.png'],
                ['car' => 'vin-car.png', 'logo' => 'vin-logo.png'],
            ];
        @endphp

        @foreach ($brands as $brand)
            <div class="brand-item">
                <a href="{{ route('cars.index') }}" class="flex flex-col items-center justify-center">
                    <img src="{{ asset('storage/welcomeImg/' . $brand['car']) }}" alt="Car" class="car mb-2" />
                    <img src="{{ asset('storage/logo/' . $brand['logo']) }}" alt="Logo" class="logo" />
                </a>
            </div>
        @endforeach
    </div>

    {{-- JS – Slider --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const imageElement = document.getElementById("slider-image");
            const titleElement = document.getElementById("slider-title");
            const descriptionElement = document.getElementById("slider-description");
            const linkElement = document.getElementById("slider-link");
            const prevArrow = document.getElementById("prev-arrow");
            const nextArrow = document.getElementById("next-arrow");
            const counterElement = document.getElementById("slider-counter");
            const carBlock = document.getElementById("car-block");

            const slides = [
                {
                    image: "{{ asset('storage/imghome/imghome1.png') }}",
                    title: "CarZone – Khởi đầu hành trình mới cùng bạn",
                    description: "CarZone mang đến những mẫu xe hiện đại, sang trọng và tiện nghi, phù hợp với mọi nhu cầu và phong cách sống của bạn.",
                    link: "{{ route('cars.index', ['id' => 1]) }}"
                },
                {
                    image: "{{ asset('storage/imghome/imghome2.png') }}",
                    title: "Đa dạng lựa chọn – Xe đẹp, giá tốt",
                    description: "CarZone tự hào mang đến nhiều dòng xe chất lượng cao, giá cả hợp lý, hỗ trợ khách hàng trên mọi hành trình.",
                    link: "{{ route('cars.index', ['id' => 2]) }}"
                },
                {
                    image: "{{ asset('storage/imghome/imghome3.png') }}",
                    title: "Dịch vụ bảo dưỡng chuyên nghiệp",
                    description: "CarZone cung cấp dịch vụ bảo dưỡng và sửa chữa xe với đội ngũ kỹ thuật viên giàu kinh nghiệm và tận tâm.",
                    link: "{{ route('cars.index', ['id' => 3]) }}"
                },
                {
                    image: "{{ asset('storage/imghome/imghome4.png') }}",
                    title: "Lái thử miễn phí – Trải nghiệm thực tế",
                    description: "CarZone luôn sẵn sàng hỗ trợ khách hàng lái thử để bạn cảm nhận được chất lượng và tiện ích thực tế của các dòng xe.",
                    link: "{{ route('cars.index', ['id' => 4]) }}"
                }
            ];

            let currentIndex = 0;
            let autoSlideInterval;

            function updateSlide() {
                const currentSlide = slides[currentIndex];
                imageElement.src = currentSlide.image;
                titleElement.textContent = currentSlide.title;
                descriptionElement.textContent = currentSlide.description;
                linkElement.href = currentSlide.link;
                counterElement.textContent = `${currentIndex + 1} / ${slides.length}`;

                if (currentIndex % 2 === 1) {
                    carBlock.classList.add("reverse");
                } else {
                    carBlock.classList.remove("reverse");
                }
            }

            function nextSlide() {
                currentIndex = (currentIndex + 1) % slides.length;
                updateSlide();
            }

            function prevSlide() {
                currentIndex = (currentIndex - 1 + slides.length) % slides.length;
                updateSlide();
            }

            nextArrow.addEventListener("click", () => {
                nextSlide();
                resetAutoSlide();
            });

            prevArrow.addEventListener("click", () => {
                prevSlide();
                resetAutoSlide();
            });

            function startAutoSlide() {
                autoSlideInterval = setInterval(nextSlide, 5000);
            }

            function resetAutoSlide() {
                clearInterval(autoSlideInterval);
                startAutoSlide();
            }

            updateSlide();
            startAutoSlide();
        });
    </script>
</x-app-layout>
