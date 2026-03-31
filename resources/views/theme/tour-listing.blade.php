@extends('layout.theme')
@section('title','Tour List')
@push('css')
<style>
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
                        
                        
                        <h4 class="filter-title">
                            <i class="fas fa-sliders-h"></i> Filter Tours
                        </h4>

                        <!-- Search by Title -->
                        <div class="filter-group">
                            <label><i class="fas fa-search"></i> Search Tour</label>
                            <input type="text" id="searchInput" placeholder="Search by tour name..." autocomplete="off">
                        </div>

                        <!-- Location Filter -->
                        <div class="filter-group">
                            <label><i class="fas fa-map-marker-alt"></i> Destination</label>
                            <select id="locationFilter">
                                <option value="">All Destinations</option>
                                @php
                                    $locations = $tours->pluck('end_location')->unique();
                                @endphp
                                @foreach($locations as $location)
                                    <option value="{{ $location }}">{{ $location }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tour Type Filter -->
                        <div class="filter-group">
                            <label><i class="fas fa-tag"></i> Tour Type</label>
                            <select id="tourTypeFilter">
                                <option value="">All Types</option>
                                @php
                                    $tourTypes = $tours->pluck('tour_type')->unique();
                                @endphp
                                @foreach($tourTypes as $type)
                                    <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Price Range Filter -->
                        <div class="filter-group">
                            <label><i class="fas fa-dollar-sign"></i> Price Range</label>
                            <div class="price-range">
                                <div class="price-range-slider">
                                    <input type="range" id="priceMin" min="0" max="{{ $maxPrice ?? 50000 }}" value="0" step="500">
                                    <input type="range" id="priceMax" min="0" max="{{ $maxPrice ?? 50000 }}" value="{{ $maxPrice ?? 50000 }}" step="500">
                                </div>
                                <div class="price-values">
                                    <span>Min: {{config('app.currency')}} <span id="minPriceValue">0</span></span>
                                    <span>Max: {{config('app.currency')}} <span id="maxPriceValue">{{ number_format($maxPrice ?? 50000) }}</span></span>
                                </div>
                            </div>
                        </div>

                        <!-- Duration Filter -->
                        <div class="filter-group">
                            <label><i class="fas fa-clock"></i> Duration (Days)</label>
                            <select id="durationFilter">
                                <option value="">Any Duration</option>
                                <option value="1-3">1 - 3 Days</option>
                                <option value="4-7">4 - 7 Days</option>
                                <option value="8-14">8 - 14 Days</option>
                                <option value="15+">15+ Days</option>
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
                <div class="col-lg-8">
                    <!-- Results Count -->
                    <div class="results-count" id="resultsCount">
                        Showing <strong id="showingCount">{{ $tours->count() }}</strong> tours
                    </div>

                    <!-- Active Filters Display -->
                    <div class="active-filters" id="activeFilters"></div>

                    <!-- Tours Grid -->
                    <div class="row gutter-y-30 align-items-stretch" id="toursGrid">
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

        // Duration Filter Logic
        function checkDuration(duration, tourDays) {
            if (!duration) return true;
            
            const [min, max] = duration.split('-');
            
            if (duration === '15+') {
                return tourDays >= 15;
            } else {
                return tourDays >= parseInt(min) && tourDays <= parseInt(max);
            }
        }

        // Filter Tours Function
        async function filterTours() {
            loadingOverlay.classList.add('active');
            
            const searchTerm = searchInput ? searchInput.value : '';
            const location = locationFilter ? locationFilter.value : '';
            const tourType = tourTypeFilter ? tourTypeFilter.value : '';
            const duration = durationFilter ? durationFilter.value : '';
            const minPrice = priceMinSlider ? parseInt(priceMinSlider.value) : 0;
            const maxPrice = priceMaxSlider ? parseInt(priceMaxSlider.value) : 0;
            
            const formData = new FormData();
            formData.append('search', searchTerm);
            formData.append('location', location);
            formData.append('tour_type', tourType);
            formData.append('duration', duration);
            formData.append('min_price', minPrice);
            formData.append('max_price', maxPrice);
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
                    updateActiveFilters(searchTerm, location, tourType, duration, minPrice, maxPrice);
                }
            } catch (error) {
                console.error('Error filtering tours:', error);
            } finally {
                loadingOverlay.classList.remove('active');
            }
        }
        
        // Update Active Filters Display
        function updateActiveFilters(search, location, type, duration, minPrice, maxPrice) {
            activeFiltersDiv.innerHTML = '';
            let filters = [];
            
            if (search) {
                filters.push({ name: 'Search', value: search, key: 'search' });
            }
            if (location) {
                filters.push({ name: 'Destination', value: location, key: 'location' });
            }
            if (type) {
                filters.push({ name: 'Tour Type', value: type, key: 'type' });
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
            filterTours();
        }
        
        // Event Listeners
        if (applyFilterBtn) applyFilterBtn.addEventListener('click', filterTours);
        if (resetFilterBtn) resetFilterBtn.addEventListener('click', resetFilters);
        if (searchInput) searchInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') filterTours();
        });
        
        // Mobile Filter Toggle
        if (showFilterBtn && filterSidebar && closeFilterBtn && filterOverlay) {
            showFilterBtn.addEventListener('click', () => {
                filterSidebar.classList.add('active');
                filterOverlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
            
            closeFilterBtn.addEventListener('click', () => {
                filterSidebar.classList.remove('active');
                filterOverlay.classList.remove('active');
                document.body.style.overflow = '';
            });
            
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
            filterTours();
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