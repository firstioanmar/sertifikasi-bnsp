$(document).ready(function() {
    function loadPageContent(slug) {
        $('#page-content').html('<h2 class="text-2xl font-semibold mb-4">Memuat konten...</h2>');
        $.ajax({
            url: '/api/pages/' + slug,
            method: 'GET',
            success: function(data) {
                $('#page-content').html(`
                    <h2 class="text-2xl font-semibold mb-4">${slug.charAt(0).toUpperCase() + slug.slice(1)}</h2>
                    <div>${data.content}</div>
                `);
            },
            error: function() {
                $('#page-content').html('<p class="text-red-600">Gagal memuat konten.</p>');
            }
        });
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
