<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto">
        <!-- Tab Navigation -->
        <div class="mb-6 border-b border-gray-200 dark:border-gray-700">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs" id="tabs">
                <button class="tab-link text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 border-b-2 border-transparent py-4 px-1 text-sm font-medium" data-tab="home">Home</button>
                <button class="tab-link text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 border-b-2 border-transparent py-4 px-1 text-sm font-medium" data-tab="about">About</button>
                <button class="tab-link text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 border-b-2 border-transparent py-4 px-1 text-sm font-medium" data-tab="contact">Contact</button>
            </nav>
        </div>

        <!-- Tab Contents -->
        <div>
            @php
                $pages = ['home' => 'Home', 'about' => 'About', 'contact' => 'Contact'];
            @endphp

            @foreach ($pages as $slug => $title)
                <div class="tab-content hidden bg-white dark:bg-gray-800 p-6 rounded shadow" id="tab-{{ $slug }}">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Edit Konten Halaman {{ $title }}</h3>

                    <div id="alert-success-{{ $slug }}" class="hidden mb-4 p-4 bg-green-100 text-green-700 rounded"></div>
                    <div id="alert-error-{{ $slug }}" class="hidden mb-4 p-4 bg-red-100 text-red-700 rounded"></div>

                    <form id="page-edit-form-{{ $slug }}">
                        @csrf
                        <textarea id="content-{{ $slug }}" name="content" rows="10" class="w-full rounded border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 mb-4"></textarea>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Simpan</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(function() {
            const pages = ['home', 'about', 'contact'];
            const token = $('meta[name="csrf-token"]').attr('content');

            // Fungsi untuk aktifkan tab dan tampilkan konten
            function activateTab(tab) {
                $('.tab-link').removeClass('border-red-600 text-red-600').addClass('border-transparent text-gray-500 dark:text-gray-400');
                $('.tab-content').addClass('hidden');

                $(`.tab-link[data-tab="${tab}"]`).addClass('border-red-600 text-red-600').removeClass('border-transparent text-gray-500 dark:text-gray-400');
                $(`#tab-${tab}`).removeClass('hidden');
            }

            // Set tab pertama (home) aktif saat load
            activateTab('home');

            // Event klik tab
            $('.tab-link').click(function() {
                const tab = $(this).data('tab');
                activateTab(tab);
            });

            // Load konten tiap halaman dari API
            pages.forEach(function(slug) {
                $.getJSON(`/api/pages/${slug}`, function(data) {
                    $(`#content-${slug}`).val(data.content);
                }).fail(function() {
                    $(`#alert-error-${slug}`).text('Gagal memuat konten.').removeClass('hidden');
                });

                // Submit update konten via API
                $(`#page-edit-form-${slug}`).submit(function(e) {
                    e.preventDefault();
                    $(`#alert-success-${slug}, #alert-error-${slug}`).addClass('hidden');

                    $.ajax({
                        url: `/api/pages/${slug}`,
                        method: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json',
                        },
                        data: {
                            content: $(`#content-${slug}`).val()
                        },
                        success: function() {
                            $(`#alert-success-${slug}`).text('Konten berhasil disimpan.').removeClass('hidden');
                        },
                        error: function(xhr) {
                            let msg = 'Gagal menyimpan konten.';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                msg = xhr.responseJSON.message;
                            }
                            $(`#alert-error-${slug}`).text(msg).removeClass('hidden');
                        }
                    });
                });
            });
        });
    </script>
</x-app-layout>
