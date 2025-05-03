$(document).ready(function() {
    const carouselImages = [
        {
            src: "assets/images/carousel1.jpg",
            alt: "Sertifikasi Profesional 1"
        },
        {
            src: "assets/images/carousel2.jpg",
            alt: "Sertifikasi Profesional 2"
        },
        {
            src: "assets/images/carousel3.jpg",
            alt: "Sertifikasi Profesional 3"
        }
    ];

    function initCarousel() {
        const $carouselInner = $('#home-carousel .carousel-inner');
        $carouselInner.empty();
        carouselImages.forEach((img, index) => {
            $carouselInner.append(`
                <div class="carousel-item absolute inset-0 transition-opacity duration-700 ${index === 0 ? 'opacity-100 relative' : 'opacity-0'}">
                    <img src="${img.src}" alt="${img.alt}" class="w-full h-64 object-cover rounded-lg" />
                </div>
            `);
        });

        let currentIndex = 0;
        const total = carouselImages.length;

        function showSlide(index) {
            $carouselInner.children().each(function(i) {
                $(this).toggleClass('opacity-100 relative', i === index);
                $(this).toggleClass('opacity-0 absolute', i !== index);
            });
        }

        $('.carousel-prev').off('click').on('click', function() {
            currentIndex = (currentIndex - 1 + total) % total;
            showSlide(currentIndex);
        });

        $('.carousel-next').off('click').on('click', function() {
            currentIndex = (currentIndex + 1) % total;
            showSlide(currentIndex);
        });
    }

    function loadPageContent(slug) {
        if (slug === 'home') {
            $('#home-carousel').removeClass('hidden');
            $('#company-profile').removeClass('hidden');
            $('#page-content-text').html('<h2 class="text-2xl font-semibold mb-4">Selamat Datang di Website Sertifikasi</h2><p>Temukan berbagai informasi tentang sertifikasi profesional dan pendidikan.</p>');
            initCarousel();
        } else {
            $('#home-carousel').addClass('hidden');
            $('#company-profile').addClass('hidden');
            $('#page-content-text').html('<h2 class="text-2xl font-semibold mb-4">' + slug.charAt(0).toUpperCase() + slug.slice(1) + '</h2><div>Memuat konten...</div>');
            $.ajax({
                url: '/api/pages/' + slug,
                method: 'GET',
                success: function(data) {
                    $('#page-content-text').html(`
                        <h2 class="text-2xl font-semibold mb-4">${slug.charAt(0).toUpperCase() + slug.slice(1)}</h2>
                        <div>${data.content}</div>
                    `);
                },
                error: function() {
                    $('#page-content-text').html('<p class="text-red-600">Gagal memuat konten.</p>');
                }
            });
        }
    }

    // Load konten home saat halaman pertama kali dibuka
    loadPageContent('home');

    // Event klik menu navigasi
    $('.nav-link').click(function(e) {
        e.preventDefault();
        var target = $(this).data('target');
        loadPageContent(target);
    });
});
