{{-- resources/views/hotels/index.blade.php --}}
@extends('layout.theme')
@section('title', 'Hotel List')
@push('css')
    <style>
        .listing-card-four {
            height: 100%;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
            background: var(--gotur-white, #fff);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.05);
        }

        .listing-card-four__image {
            height: 220px;
            overflow: hidden;
            position: relative;
        }

        .listing-card-four__image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .listing-card-four:hover .listing-card-four__image img {
            transform: scale(1.1);
        }

        .listing-card-four__content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 20px;
        }

        .hotel-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--gotur-black, #1D231F);
        }

        .hotel-location {
            font-size: 13px;
            color: var(--gotur-text, #595959);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .hotel-location i {
            color: var(--gotur-base, #63AB45);
            font-size: 12px;
        }

        .hotel-description {
            font-size: 14px;
            color: var(--gotur-text, #595959);
            margin-bottom: 15px;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .check-times {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 12px;
            background: var(--gotur-gray, #F3F8F6);
            padding: 8px 12px;
            border-radius: 10px;
        }

        .check-times span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .check-times i {
            color: var(--gotur-base, #63AB45);
        }

        .hotel-price {
            font-size: 20px;
            font-weight: 800;
            color: var(--gotur-base, #63AB45);
            margin-bottom: 15px;
        }

        .hotel-price small {
            font-size: 12px;
            font-weight: 400;
            color: var(--gotur-text, #595959);
        }

        .btn-book {
            background: var(--gotur-base, #63AB45);
            color: #fff;
            padding: 10px 20px;
            border-radius: 30px;
            text-align: center;
            display: inline-block;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            border: none;
            width: 100%;
        }

        .btn-book:hover {
            background: #4e8a36;
            transform: translateY(-2px);
        }

        /* Filter Sidebar Styles */
        .filter-sidebar {
            background: var(--gotur-white, #fff);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--gotur-border-color, #E5E5E5);
            position: sticky;
            top: 100px;
        }

        .filter-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--gotur-base, #63AB45);
            position: relative;
        }

        .filter-title i {
            color: var(--gotur-base, #63AB45);
            margin-right: 10px;
        }

        .filter-group {
            margin-bottom: 25px;
        }

        .filter-group label {
            display: block;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 10px;
            color: var(--gotur-black, #1D231F);
        }

        .filter-group label i {
            color: var(--gotur-base, #63AB45);
            margin-right: 8px;
            font-size: 14px;
        }

        .filter-group input,
        .filter-group select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--gotur-border-color, #E5E5E5);
            border-radius: 12px;
            font-size: 14px;
            font-family: var(--gotur-font, "Plus Jakarta Sans", sans-serif);
            transition: all 0.3s ease;
            background: var(--gotur-white, #fff);
        }

        .filter-group input:focus,
        .filter-group select:focus {
            outline: none;
            border-color: var(--gotur-base, #63AB45);
            box-shadow: 0 0 0 3px rgba(99, 171, 69, 0.1);
        }

        /* Price Range Slider */
        .price-range {
            padding: 10px 0;
        }

        .price-range-slider {
            width: 100%;
            margin: 20px 0;
            position: relative;
            height: 4px;
        }

        input[type="range"] {
            -webkit-appearance: none;
            width: 100%;
            height: 4px;
            background: var(--gotur-border-color, #E5E5E5);
            border-radius: 5px;
            outline: none;
            margin: 10px 0;
        }

        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 18px;
            height: 18px;
            background: var(--gotur-base, #63AB45);
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid #fff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }

        .price-values {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            font-size: 14px;
            color: var(--gotur-text, #595959);
        }

        .price-values span {
            background: var(--gotur-gray, #F3F8F6);
            padding: 5px 12px;
            border-radius: 20px;
        }

        /* Filter Actions */
        .filter-actions {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .filter-actions .gotur-btn {
            flex: 1;
            text-align: center;
            padding: 12px 15px;
            font-size: 14px;
        }

        .reset-filter-btn {
            background: var(--gotur-gray, #F3F8F6) !important;
            color: var(--gotur-black, #1D231F) !important;
            box-shadow: none !important;
        }

        .reset-filter-btn:hover {
            background: var(--gotur-border-color, #E5E5E5) !important;
            transform: translateY(-2px);
        }

        /* Active Filters */
        .active-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--gotur-border-color, #E5E5E5);
        }

        .filter-tag {
            background: var(--gotur-gray, #F3F8F6);
            padding: 6px 12px;
            border-radius: 30px;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .filter-tag i {
            cursor: pointer;
            font-size: 12px;
            transition: all 0.3s ease;
        }

        .filter-tag i:hover {
            color: #ff4444;
            transform: scale(1.1);
        }

        /* Results Count */
        .results-count {
            font-size: 14px;
            color: var(--gotur-text, #595959);
            margin-bottom: 20px;
            padding: 10px 15px;
            background: var(--gotur-gray, #F3F8F6);
            border-radius: 10px;
            display: inline-block;
        }

        .results-count strong {
            color: var(--gotur-base, #63AB45);
        }

        /* No Results */
        .no-results {
            text-align: center;
            padding: 60px 20px;
            background: var(--gotur-gray, #F3F8F6);
            border-radius: 20px;
        }

        .no-results i {
            font-size: 64px;
            color: var(--gotur-base, #63AB45);
            margin-bottom: 20px;
            display: block;
        }

        .no-results h4 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .no-results p {
            color: var(--gotur-text, #595959);
            margin-bottom: 20px;
        }

        /* Loading Overlay */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.9);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            visibility: hidden;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .loading-overlay.active {
            visibility: visible;
            opacity: 1;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 3px solid var(--gotur-gray, #F3F8F6);
            border-top-color: var(--gotur-base, #63AB45);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Mobile Filter Toggle */
        .filter-toggle {
            display: none;
            width: 100%;
            margin-bottom: 20px;
        }

        @media (max-width: 991px) {
            .filter-sidebar {
                position: fixed;
                top: 0;
                left: -100%;
                width: 85%;
                max-width: 350px;
                height: 100%;
                z-index: 1000;
                overflow-y: auto;
                transition: left 0.3s ease;
                border-radius: 0;
                padding: 20px;
            }

            .filter-sidebar.active {
                left: 0;
            }

            .filter-overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
                visibility: hidden;
                opacity: 0;
                transition: all 0.3s ease;
            }

            .filter-overlay.active {
                visibility: visible;
                opacity: 1;
            }

            .filter-toggle {
                display: block;
            }

            .filter-close {
                position: absolute;
                top: 20px;
                right: 20px;
                background: none;
                border: none;
                font-size: 24px;
                cursor: pointer;
                color: var(--gotur-text, #595959);
            }
        }
    </style>
@endpush

@section('content')
    <!-- Filter Overlay for Mobile -->
    <div class="filter-overlay" id="filterOverlay"></div>

    <section class="tour-listing-page section-space">
        <div class="container">
            <!-- Mobile Filter Toggle -->
            <div class="filter-toggle">
                <button class="gotur-btn" id="showFilterBtn" style="width: 100%;">
                    <i class="fas fa-filter"></i> Filter & Search
                </button>
            </div>

            <div class="row gutter-y-30">
                <!-- Filter Sidebar -->
                <div class="col-lg-4" id="filterSidebar">
                    <div class="filter-sidebar">
                        <button class="filter-close d-lg-none" id="closeFilterBtn" style="position: absolute; top: 20px; right: 20px; background: none; border: none; font-size: 24px;">&times;</button>
                        <h4 class="filter-title">
                            <i class="fas fa-sliders-h"></i> Filter Hotels
                        </h4>

                        <!-- Search by Name -->
                        <div class="filter-group">
                            <label><i class="fas fa-hotel"></i> Search Hotel</label>
                            <input type="text" id="searchInput" placeholder="Search by hotel name..." autocomplete="off">
                        </div>

                        <!-- Location Filter -->
                        <div class="filter-group">
                            <label><i class="fas fa-map-marker-alt"></i> Location</label>
                            <select id="locationFilter" class="select2">
                                <option value="">All Locations</option>
                                @php
                                    $locations = $hotels->pluck('location')->unique();
                                @endphp
                                @foreach($locations as $location)
                                    <option value="{{ $location }}">{{ $location }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Address Filter -->
                        <div class="filter-group">
                            <label><i class="fas fa-address-card"></i> Address</label>
                            <select id="addressFilter" class="select2">
                                <option value="">All Addresses</option>
                                @php
                                    $addresses = $hotels->pluck('address')->unique();
                                @endphp
                                @foreach($addresses as $address)
                                    <option value="{{ $address }}">{{ Str::limit($address, 40) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Price Range Filter -->
                        <div class="filter-group">
                            <label><i class="fas fa-dollar-sign"></i> Price Range (per night)</label>
                            <div class="price-range">
                                <div class="price-range-slider">
                                    <input type="range" id="priceMin" min="0" max="{{ $maxPrice ?? 50000 }}" value="0" step="500">
                                    <input type="range" id="priceMax" min="0" max="{{ $maxPrice ?? 50000 }}" value="{{ $maxPrice ?? 50000 }}" step="500">
                                </div>
                                <div class="price-values">
                                    <span>Min: {{config('app.currency', '$')}} <span id="minPriceValue">0</span></span>
                                    <span>Max: {{config('app.currency', '$')}} <span id="maxPriceValue">{{ number_format($maxPrice ?? 50000) }}</span></span>
                                </div>
                            </div>
                        </div>

                        <!-- Filter Actions -->
                        <div class="filter-actions">
                            <button class="gotur-btn" id="applyFilterBtn">Apply Filters</button>
                            <button class="gotur-btn reset-filter-btn" id="resetFilterBtn">Reset</button>
                        </div>
                    </div>
                </div>

                <!-- Results Column -->
                <div class="col-lg-8">
                    <!-- Results Count -->
                    <div class="results-count" id="resultsCount">
                        Showing <strong id="showingCount">{{ $hotels->count() }}</strong> hotels
                    </div>

                    <!-- Active Filters Display -->
                    <div class="active-filters" id="activeFilters"></div>

                    <!-- Hotels Grid -->
                    <div class="row gutter-y-30 align-items-stretch" id="hotelsGrid">
                        @include('partials.hotels-cards', ['hotels' => $hotels])
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // DOM Elements
            const hotelsGrid = document.getElementById('hotelsGrid');
            const searchInput = document.getElementById('searchInput');
            const locationFilter = document.getElementById('locationFilter');
            const addressFilter = document.getElementById('addressFilter');
            const applyFilterBtn = document.getElementById('applyFilterBtn');
            const resetFilterBtn = document.getElementById('resetFilterBtn');
            const resultsCountSpan = document.getElementById('showingCount');
            const activeFiltersDiv = document.getElementById('activeFilters');
            const loadingOverlay = document.getElementById('loadingOverlay');

            // Price Range Elements
            const priceMinSlider = document.getElementById('priceMin');
            const priceMaxSlider = document.getElementById('priceMax');
            const minPriceValue = document.getElementById('minPriceValue');
            const maxPriceValue = document.getElementById('maxPriceValue');

            // Mobile Filter Elements
            const showFilterBtn = document.getElementById('showFilterBtn');
            const closeFilterBtn = document.getElementById('closeFilterBtn');
            const filterSidebar = document.getElementById('filterSidebar');
            const filterOverlay = document.getElementById('filterOverlay');

            // Price Range Logic
            if (priceMinSlider && priceMaxSlider) {
                function updatePriceRange() {
                    let minVal = parseInt(priceMinSlider.value);
                    let maxVal = parseInt(priceMaxSlider.value);

                    if (minVal > maxVal) {
                        [minVal, maxVal] = [maxVal, minVal];
                    }

                    minPriceValue.textContent = minVal.toLocaleString();
                    maxPriceValue.textContent = maxVal.toLocaleString();

                    priceMinSlider.value = minVal;
                    priceMaxSlider.value = maxVal;
                }

                priceMinSlider.addEventListener('input', function() {
                    if (parseInt(this.value) > parseInt(priceMaxSlider.value)) {
                        priceMaxSlider.value = this.value;
                    }
                    updatePriceRange();
                });

                priceMaxSlider.addEventListener('input', function() {
                    if (parseInt(this.value) < parseInt(priceMinSlider.value)) {
                        priceMinSlider.value = this.value;
                    }
                    updatePriceRange();
                });

                updatePriceRange();
            }

            // Filter Hotels Function
            async function filterHotels() {
                loadingOverlay.classList.add('active');

                const searchTerm = searchInput ? searchInput.value : '';
                const location = locationFilter ? locationFilter.value : '';
                const address = addressFilter ? addressFilter.value : '';
                const minPrice = priceMinSlider ? parseInt(priceMinSlider.value) : 0;
                const maxPrice = priceMaxSlider ? parseInt(priceMaxSlider.value) : 0;

                const formData = new FormData();
                formData.append('search', searchTerm);
                formData.append('location', location);
                formData.append('address', address);
                formData.append('min_price', minPrice);
                formData.append('max_price', maxPrice);
                formData.append('_token', '{{ csrf_token() }}');

                try {
                    const response = await fetch('{{ route("front.hotel-list.filter") }}', {
                        method: 'POST',
                        body: formData
                    });

                    const data = await response.json();

                    if (data.success) {
                        hotelsGrid.innerHTML = data.html;
                        resultsCountSpan.textContent = data.count;
                        updateActiveFilters(searchTerm, location, address, minPrice, maxPrice);
                    }
                } catch (error) {
                    console.error('Error filtering hotels:', error);
                } finally {
                    loadingOverlay.classList.remove('active');
                }
            }

            // Update Active Filters Display
            function updateActiveFilters(search, location, address, minPrice, maxPrice) {
                activeFiltersDiv.innerHTML = '';
                let filters = [];

                if (search) {
                    filters.push({ name: 'Search', value: search, key: 'search' });
                }
                if (location) {
                    filters.push({ name: 'Location', value: location, key: 'location' });
                }
                if (address) {
                    filters.push({ name: 'Address', value: address.length > 40 ? address.substring(0, 40) + '...' : address, key: 'address' });
                }
                if (minPrice > 0 || maxPrice < parseInt(priceMaxSlider?.max || 50000)) {
                    filters.push({ name: 'Price', value: `{{config('app.currency', '$')}} ${minPrice.toLocaleString()} - {{config('app.currency', '$')}} ${maxPrice.toLocaleString()}`, key: 'price' });
                }

                if (filters.length === 0) {
                    activeFiltersDiv.innerHTML = '<span style="color: var(--gotur-text); font-size: 13px;">No active filters</span>';
                    return;
                }

                filters.forEach(filter => {
                    const tag = document.createElement('div');
                    tag.className = 'filter-tag';
                    tag.innerHTML = `${filter.name}: ${filter.value} <i class="fas fa-times" data-key="${filter.key}" data-value="${filter.value}"></i>`;
                    activeFiltersDiv.appendChild(tag);
                });

                // Add remove filter functionality
                document.querySelectorAll('.filter-tag i').forEach(icon => {
                    icon.addEventListener('click', function() {
                        const key = this.dataset.key;
                        removeFilter(key);
                    });
                });
            }

            // Remove Individual Filter
            function removeFilter(key) {
                switch(key) {
                    case 'search':
                        if (searchInput) searchInput.value = '';
                        break;
                    case 'location':
                        if (locationFilter) locationFilter.value = '';
                        break;
                    case 'address':
                        if (addressFilter) addressFilter.value = '';
                        break;
                    case 'price':
                        if (priceMinSlider) priceMinSlider.value = 0;
                        if (priceMaxSlider) priceMaxSlider.value = priceMaxSlider.max;
                        updatePriceRange();
                        break;
                }
                filterHotels();
            }

            // Reset All Filters
            function resetFilters() {
                if (searchInput) searchInput.value = '';
                if (locationFilter) locationFilter.value = '';
                if (addressFilter) addressFilter.value = '';
                if (priceMinSlider) priceMinSlider.value = 0;
                if (priceMaxSlider) priceMaxSlider.value = priceMaxSlider.max;
                updatePriceRange();
                filterHotels();
            }

            // Event Listeners
            if (applyFilterBtn) applyFilterBtn.addEventListener('click', filterHotels);
            if (resetFilterBtn) resetFilterBtn.addEventListener('click', resetFilters);
            if (searchInput) searchInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') filterHotels();
            });

            // Mobile Filter Toggle
            if (showFilterBtn && filterSidebar && closeFilterBtn && filterOverlay) {
                showFilterBtn.addEventListener('click', () => {
                    filterSidebar.classList.add('active');
                    filterOverlay.classList.add('active');
                    document.body.style.overflow = 'hidden';
                });

                if (closeFilterBtn) {
                    closeFilterBtn.addEventListener('click', () => {
                        filterSidebar.classList.remove('active');
                        filterOverlay.classList.remove('active');
                        document.body.style.overflow = '';
                    });
                }

                filterOverlay.addEventListener('click', () => {
                    filterSidebar.classList.remove('active');
                    filterOverlay.classList.remove('active');
                    document.body.style.overflow = '';
                });
            }

            // Initialize with any existing filters from URL
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('search')) {
                if (searchInput) searchInput.value = urlParams.get('search');
                filterHotels();
            }
        });
    </script>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Message',
                text: "{{ session('success') }}"
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Message',
                text: "{{ session('error') }}"
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $('#locationFilter').select2({
                placeholder: "Select Location ",
                allowClear: true
            });
            $('#addressFilter').select2({
                placeholder: "Select Address",
                allowClear: true
            });

        });
    </script>
@endpush
