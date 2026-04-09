@extends('layout.theme')
@section('title', 'Tour List')

@section('meta_description', $seo->description??"IGL Web Ltd")
@section('meta_keywords', $seo->keywords??"")
@section('meta_robots', $seo->robots??"")
@section('favicon', asset('storage/'.$seo->icon??asset('assets/images/favicons/favicon-16x16.png')))

@section('og_type', $seo->og_type??"")
@section('og_title', $seo->og_title??"")
@section('og_description', $seo->og_description??"")
@section('og_width', $seo->og_width??"")
@section('og_height', $seo->og_height??"")
@section('meta_image', asset('storage/'.$seo->og_image??asset('assets/images/igl.png')))

@section('twitter_title', $seo->twitter_title??"")
@section('twitter_meta_description', $seo->twitter_description??"")
@section('twitter_meta_image', asset('storage/'.$seo->twitter_image??asset('assets/images/igl.png')))

@push('css')
    <style>
        /* Make tours grid scrollable */
        #toursGrid {
            max-height: 800px;
            overflow-y: auto;
            overflow-x: hidden;
            padding-right: 10px;
        }

        /* Custom scrollbar styling */
        #toursGrid::-webkit-scrollbar {
            width: 6px;
        }

        #toursGrid::-webkit-scrollbar-track {
            background: var(--gotur-gray, #F3F8F6);
            border-radius: 10px;
        }

        #toursGrid::-webkit-scrollbar-thumb {
            background: var(--gotur-base, #63AB45);
            border-radius: 10px;
        }


        /* Optional: Add smooth scrolling */
        #toursGrid {
            scroll-behavior: smooth;
        }
        /* Your existing CSS styles */
        .listing-card-four {
            height: 100%;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
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
        }

        /* Make the parent row align items start for sticky to work */
        .row.gutter-y-30 {
            display: flex;
            flex-wrap: wrap;
            margin-left: -15px;
            margin-right: -15px;
            align-items: flex-start;
        }

        /* Filter Sidebar Styles - FIXED: Proper sticky positioning */
        .filter-sidebar {
            background: var(--gotur-white, #fff);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--gotur-border-color, #E5E5E5);
            position: sticky;
            top: 100px;
            z-index: 10;
        }

        /* Ensure the filter column doesn't break sticky */
        #filterSidebar {
            position: relative;
            height: 100%;
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
        }

        .price-range-slider input {
            width: 100%;
            margin: 5px 0;
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

        /* Checkbox & Radio Styles */
        .checkbox-group,
        .radio-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .checkbox-item,
        .radio-item {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .checkbox-item input,
        .radio-item input {
            width: auto;
            margin-right: 10px;
            cursor: pointer;
            accent-color: var(--gotur-base, #63AB45);
        }

        .checkbox-item label,
        .radio-item label {
            margin: 0;
            cursor: pointer;
            font-weight: 400;
            font-size: 14px;
            color: var(--gotur-text, #595959);
        }

        .checkbox-item .count,
        .radio-item .count {
            margin-left: auto;
            font-size: 12px;
            color: var(--gotur-text, #595959);
            background: var(--gotur-gray, #F3F8F6);
            padding: 2px 8px;
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

        /* Tours Grid - FIXED: Show 3 cards per row */
        .tours-grid-container {
            display: flex;
            flex-wrap: wrap;
            margin-left: -15px;
            margin-right: -15px;
        }

        .tour-card-item {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
            padding-left: 15px;
            padding-right: 15px;
            margin-bottom: 30px;
        }

        /* For medium screens - 2 cards */
        @media (min-width: 768px) and (max-width: 991px) {
            .tour-card-item {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        /* For small screens - 1 card */
        @media (max-width: 767px) {
            .tour-card-item {
                flex: 0 0 100%;
                max-width: 100%;
            }
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

        /* Filter close button for mobile */
        .filter-close {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--gotur-text, #595959);
            display: none;
        }

        /* Responsive Design */
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
                position: fixed;
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
                display: block;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Filter Overlay for Mobile -->
    <div class="filter-overlay" id="filterOverlay"></div>

    <section style="margin-top:-90px;" class="tour-listing-page section-space">
        <div class="container">
            <!-- Mobile Filter Toggle -->
            <div class="filter-toggle">
                <button class="gotur-btn" id="showFilterBtn" style="width: 100%;">
                    <i class="fas fa-filter"></i> Filter & Search
                </button>
            </div>

            <div class="row gutter-y-30">
                <!-- Filter Sidebar - Sticky on desktop -->
                <div class="col-lg-3" id="filterSidebar">
                    <div class="filter-sidebar">
                        <button class="filter-close" id="closeFilterBtn">
                            <i class="fas fa-times"></i>
                        </button>
                        <h4 class="filter-title">
                            <i class="fas fa-sliders-h"></i> Filter Tours
                        </h4>

                        <!-- Search by Title -->
                        <div class="filter-group">
                            <label><i class="fas fa-search"></i> Search Tour</label>
                            <input type="text" id="searchInput" placeholder="Search by tour name..." autocomplete="off" value="{{ request('search') }}">
                        </div>

                        <!-- Location Filter -->
                        <div class="filter-group">
                            <label><i class="fas fa-map-marker-alt"></i> Location</label>
                            <select id="locationFilter">
                                <option value="">All Locations</option>
                                @php
                                    $locations = $tours->pluck('end_location')->unique();
                                @endphp
                                @foreach($locations as $location)
                                    <option value="{{ $location }}" {{ request('location') == $location ? 'selected' : '' }}>{{ $location }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tour Type Filter -->
                        <div class="filter-group">
                            <label><i class="fas fa-tag"></i> Tour Type</label>
                            <select id="tourTypeFilter">
                                <option value="">All Types</option>
                                <option value="adventure" {{ request('tour_type') == 'adventure' ? 'selected' : '' }}>Adventure</option>
                                <option value="honeymoon" {{ request('tour_type') == 'honeymoon' ? 'selected' : '' }}>Honeymoon</option>
                                <option value="family" {{ request('tour_type') == 'family' ? 'selected' : '' }}>Family</option>
                                <option value="group" {{ request('tour_type') == 'group' ? 'selected' : '' }}>Group</option>
                            </select>
                        </div>

                        <!-- Price Range Filter -->
                        <div class="filter-group">
                            <label><i class="fas fa-dollar-sign"></i> Price Range</label>
                            <div class="price-range">
                                <div class="price-range-slider">
                                    <input type="range" id="priceMin" min="0" max="{{ $maxPrice ?? 50000 }}" value="{{ request('min_price', 0) }}" step="500">
                                    <input type="range" id="priceMax" min="0" max="{{ $maxPrice ?? 50000 }}" value="{{ request('max_price', $maxPrice ?? 50000) }}" step="500">
                                </div>
                                <div class="price-values">
                                    <span>Min: {{config('app.currency')}} <span id="minPriceValue">{{ request('min_price', 0) }}</span></span>
                                    <span>Max: {{config('app.currency')}} <span id="maxPriceValue">{{ request('max_price', number_format($maxPrice ?? 50000)) }}</span></span>
                                </div>
                            </div>
                        </div>

                        <!-- Duration Filter -->
                        <div class="filter-group">
                            <label><i class="fas fa-clock"></i> Duration (Days)</label>
                            <select id="durationFilter">
                                <option value="">Any Duration</option>
                                <option value="1-3" {{ request('duration') == '1-3' ? 'selected' : '' }}>1 - 3 Days</option>
                                <option value="4-7" {{ request('duration') == '4-7' ? 'selected' : '' }}>4 - 7 Days</option>
                                <option value="8-14" {{ request('duration') == '8-14' ? 'selected' : '' }}>8 - 14 Days</option>
                                <option value="15+" {{ request('duration') == '15+' ? 'selected' : '' }}>15+ Days</option>
                            </select>
                        </div>

                        <!-- Filter Actions -->
                        <div class="filter-actions">
                            <button class="gotur-btn" id="applyFilterBtn">Apply Filters</button>
                            <button class="gotur-btn reset-filter-btn" id="resetFilterBtn">Reset</button>
                        </div>
                    </div>
                </div>

                <!-- Results Column -->
                <div class="col-lg-9">
                    <!-- Results Count -->
                    <div class="results-count" id="resultsCount">
                        Showing <strong id="showingCount">{{ $tours->count() }}</strong> tours
                    </div>

                    <!-- Active Filters Display -->
                    <div class="active-filters" id="activeFilters"></div>

                    <!-- Tours Grid - 3 cards per row -->
                    <div class="tours-grid-container" id="toursGrid">
                        @include('partials.tour-cards', ['tours' => $tours])
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
            // Get URL parameters
            const urlParams = new URLSearchParams(window.location.search);

            // DOM Elements
            const toursGrid = document.getElementById('toursGrid');
            const searchInput = document.getElementById('searchInput');
            const locationFilter = document.getElementById('locationFilter');
            const tourTypeFilter = document.getElementById('tourTypeFilter');
            const durationFilter = document.getElementById('durationFilter');
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

            // Parse date range from URL parameter (format: "5 Apr 26 - 13 Apr 26")
            function parseDateRange(dateString) {
                if (!dateString) return null;

                const dates = dateString.split(' - ');
                if (dates.length === 2) {
                    return {
                        start: dates[0],
                        end: dates[1]
                    };
                }
                return null;
            }

            // Filter Tours Function (supports both manual and URL parameters)
            async function filterTours(updateUrl = true) {
                loadingOverlay.classList.add('active');

                const searchTerm = searchInput ? searchInput.value : '';
                const location = locationFilter ? locationFilter.value : '';
                const tourType = tourTypeFilter ? tourTypeFilter.value : '';
                const duration = durationFilter ? durationFilter.value : '';
                const minPrice = priceMinSlider ? parseInt(priceMinSlider.value) : 0;
                const maxPrice = priceMaxSlider ? parseInt(priceMaxSlider.value) : 0;

                // Get date from URL if exists
                const dateParam = urlParams.get('date');
                const dateRange = parseDateRange(dateParam);

                // Get guests from URL if exists
                const guests = urlParams.get('guests') || '';

                const formData = new FormData();
                formData.append('search', searchTerm);
                formData.append('location', location);
                formData.append('tour_type', tourType);
                formData.append('duration', duration);
                formData.append('min_price', minPrice);
                formData.append('max_price', maxPrice);
                if (dateRange) {
                    formData.append('travel_date_start', dateRange.start);
                    formData.append('travel_date_end', dateRange.end);
                }
                if (guests) {
                    formData.append('guests', guests);
                }
                formData.append('_token', '{{ csrf_token() }}');

                try {
                    const response = await fetch('{{ route("front.tour-list.filter") }}', {
                        method: 'POST',
                        body: formData
                    });

                    const data = await response.json();

                    if (data.success) {
                        toursGrid.innerHTML = data.html;
                        resultsCountSpan.textContent = data.count;
                        updateActiveFilters(searchTerm, location, tourType, duration, minPrice, maxPrice, dateRange, guests);

                        // Update URL parameters if needed
                        if (updateUrl) {
                            updateURLParameters(searchTerm, location, tourType, duration, minPrice, maxPrice, dateRange, guests);
                        }
                    }
                } catch (error) {
                    console.error('Error filtering tours:', error);
                } finally {
                    loadingOverlay.classList.remove('active');
                }
            }

            // Update URL with current filter parameters
            function updateURLParameters(search, location, tourType, duration, minPrice, maxPrice, dateRange, guests) {
                const params = new URLSearchParams();

                if (search) params.set('search', search);
                if (location) params.set('location', location);
                if (tourType) params.set('tour_type', tourType);
                if (duration) params.set('duration', duration);
                if (minPrice > 0) params.set('min_price', minPrice);
                if (maxPrice < (priceMaxSlider?.max || 50000)) params.set('max_price', maxPrice);
                if (dateRange && dateRange.start && dateRange.end) params.set('date', `${dateRange.start} - ${dateRange.end}`);
                if (guests) params.set('guests', guests);

                const newUrl = window.location.pathname + (params.toString() ? '?' + params.toString() : '');
                window.history.pushState({}, '', newUrl);
            }

            // Update Active Filters Display
            function updateActiveFilters(search, location, type, duration, minPrice, maxPrice, dateRange, guests) {
                activeFiltersDiv.innerHTML = '';
                let filters = [];

                if (search) {
                    filters.push({ name: 'Search', value: search, key: 'search' });
                }
                if (location) {
                    filters.push({ name: 'Destination', value: location, key: 'location' });
                }
                if (type) {
                    let typeLabel = '';
                    if (type === 'adventure') typeLabel = 'Adventure';
                    else if (type === 'honeymoon') typeLabel = 'Honeymoon';
                    else if (type === 'family') typeLabel = 'Family';
                    else if (type === 'group') typeLabel = 'Group';
                    else typeLabel = type;
                    filters.push({ name: 'Tour Type', value: typeLabel, key: 'type' });
                }
                if (duration) {
                    let durationText = '';
                    if (duration === '1-3') durationText = '1-3 Days';
                    else if (duration === '4-7') durationText = '4-7 Days';
                    else if (duration === '8-14') durationText = '8-14 Days';
                    else if (duration === '15+') durationText = '15+ Days';
                    filters.push({ name: 'Duration', value: durationText, key: 'duration' });
                }
                if (minPrice > 0 || maxPrice < parseInt(priceMaxSlider?.max || 50000)) {
                    filters.push({ name: 'Price', value: `{{config('app.currency')}} ${minPrice.toLocaleString()} - {{config('app.currency')}} ${maxPrice.toLocaleString()}`, key: 'price' });
                }
                if (dateRange && dateRange.start && dateRange.end) {
                    filters.push({ name: 'Travel Date', value: `${dateRange.start} to ${dateRange.end}`, key: 'date' });
                }
                if (guests) {
                    filters.push({ name: 'Travelers', value: guests, key: 'guests' });
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
                        const value = this.dataset.value;
                        removeFilter(key, value);
                    });
                });
            }

            // Remove Individual Filter
            function removeFilter(key, value) {
                switch(key) {
                    case 'search':
                        if (searchInput) searchInput.value = '';
                        break;
                    case 'location':
                        if (locationFilter) locationFilter.value = '';
                        break;
                    case 'type':
                        if (tourTypeFilter) tourTypeFilter.value = '';
                        break;
                    case 'duration':
                        if (durationFilter) durationFilter.value = '';
                        break;
                    case 'price':
                        if (priceMinSlider) priceMinSlider.value = 0;
                        if (priceMaxSlider) priceMaxSlider.value = priceMaxSlider.max;
                        updatePriceRange();
                        break;
                    case 'date':
                        // Remove date parameter from URL
                        const url = new URL(window.location.href);
                        url.searchParams.delete('date');
                        window.history.pushState({}, '', url);
                        break;
                    case 'guests':
                        const urlGuests = new URL(window.location.href);
                        urlGuests.searchParams.delete('guests');
                        window.history.pushState({}, '', urlGuests);
                        break;
                }
                filterTours();
            }

            // Reset All Filters
            function resetFilters() {
                if (searchInput) searchInput.value = '';
                if (locationFilter) locationFilter.value = '';
                if (tourTypeFilter) tourTypeFilter.value = '';
                if (durationFilter) durationFilter.value = '';
                if (priceMinSlider) priceMinSlider.value = 0;
                if (priceMaxSlider) priceMaxSlider.value = priceMaxSlider.max;
                updatePriceRange();

                // Clear URL parameters
                const newUrl = window.location.pathname;
                window.history.pushState({}, '', newUrl);

                filterTours();
            }

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

            // Event Listeners
            if (applyFilterBtn) applyFilterBtn.addEventListener('click', () => filterTours(true));
            if (resetFilterBtn) resetFilterBtn.addEventListener('click', resetFilters);
            if (searchInput) searchInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') filterTours(true);
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

            // Auto-apply filters from URL parameters on page load
            if (urlParams.toString()) {
                // Set filter values from URL
                if (urlParams.has('location') && locationFilter) {
                    locationFilter.value = urlParams.get('location');
                }
                if (urlParams.has('tour_type') && tourTypeFilter) {
                    tourTypeFilter.value = urlParams.get('tour_type');
                }
                if (urlParams.has('duration') && durationFilter) {
                    durationFilter.value = urlParams.get('duration');
                }
                if (urlParams.has('search') && searchInput) {
                    searchInput.value = urlParams.get('search');
                }
                if (urlParams.has('min_price') && priceMinSlider) {
                    priceMinSlider.value = urlParams.get('min_price');
                }
                if (urlParams.has('max_price') && priceMaxSlider) {
                    priceMaxSlider.value = urlParams.get('max_price');
                }

                updatePriceRange();

                // Apply filters automatically
                setTimeout(() => {
                    filterTours(false);
                }, 500);
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
@endpush
