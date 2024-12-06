@extends('components.layouts.app')

@section('title', 'Vendor Items')

@section('content')
    <div class="row responsive">
        <div class="col-12 d-flex justify-content-center">
            <div class="">
                <!-- Topbar Search -->
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group shadow mb-4">
                        <input type="text" class="form-control bg-light border-0 small " placeholder="Search for..."
                            aria-label="Search" aria-describedby="basic-addon2" id="search-input">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-12 d-flex justify-content-center">
            <div class="col-12 d-flex flex-wrap justify-content-center" id="vendor-items-container" data-page="1" data-per-page="10">
                @foreach ($vendors as $vendor)
                    <div class="col-4">

                        <livewire:card-vendor-items :vendor="$vendor" />

                    </div>
                @endforeach
            </div>
            {{ $vendors->links() }}
        </div>

        {{-- <div class="col-12 mt-4 d-flex justify-content-center">
        </div> --}}

    </div>

@endsection

{{-- @push('scripts')
    <script>
        const searchInput = document.getElementById('search-input');
        const vendorItemsContainer = document.getElementById('vendor-items-container');
        const prevPageBtn = document.getElementById('prev-page');
        const nextPageBtn = document.getElementById('next-page');

        // Fungsi untuk melakukan pencarian dan pagination
        function fetchData(page, searchTerm) {
            // Ganti URL berikut dengan URL yang sesuai dengan endpoint API Anda
            const url = `/vendor-items?page=${page}&search=${searchTerm}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // Update tampilan dengan data yang baru
                    vendorItemsContainer.innerHTML = data.html; // Asumsikan API mengembalikan HTML
                    // Update atribut data-page
                    vendorItemsContainer.dataset.page = data.currentPage;

                    // Update status tombol pagination
                    updatePaginationButtons(data);
                });
        }

        // Fungsi untuk memperbarui status tombol pagination
        function updatePaginationButtons(data) {
            prevPageBtn.disabled = data.currentPage === 1;
            nextPageBtn.disabled = data.currentPage === data.lastPage;
        }

        // Event listener untuk pencarian
        searchInput.addEventListener('keyup', () => {
            fetchData(1, searchInput.value); // Mulai dari halaman 1 saat pencarian baru
        });

        // Event listener untuk tombol pagination
        prevPageBtn.addEventListener('click', () => {
            const currentPage = parseInt(vendorItemsContainer.dataset.page);
            fetchData(currentPage - 1, searchInput.value);
        });

        nextPageBtn.addEventListener('click', () => {
            const currentPage = parseInt(vendorItemsContainer.dataset.page);
            fetchData(currentPage + 1, searchInput.value);
        });

        // Panggil fungsi fetchData pertama kali untuk memuat data awal
        fetchData(1, '');
    </script>
@endpush --}}
