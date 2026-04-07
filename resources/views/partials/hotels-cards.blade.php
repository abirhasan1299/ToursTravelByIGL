{{-- resources/views/partials/hotel-cards.blade.php --}}
@if($hotels->count() > 0)
    @foreach($hotels as $hotel)
        <div class="col-md-4 col-xl-4 px-2 py-2">
            <div class="listing-card-four">
                <div class="listing-card-four__image">
                    {{-- You can replace this with actual hotel image if you have one --}}
                    @if($hotel->images->isNotEmpty())
                        <img src="{{ asset('storage/' . $hotel->images[0]->image_name) }}" alt="Hotel Image">
                    @else
                        <img src="{{ asset('images/default-hotel.jpg') }}" alt="Default Image">
                    @endif
                </div>
                <div class="listing-card-four__content">
                    <div>
                        <h3 class="hotel-title">{{ $hotel->name }}</h3>
                        <div class="hotel-location">
                            <i class="fas fa-map-marker-alt"></i> {{ $hotel->location }}
                        </div>
                        <div class="hotel-location" style="margin-bottom: 8px;">
                            <i class="fas fa-address-card"></i> {{ Str::limit($hotel->address, 60) }}
                        </div>
                        @if($hotel->description)
                            <div class="hotel-description">
                                {{ Str::limit($hotel->description, 100) }}
                            </div>
                        @endif
                        <div class="check-times">
                            <span><i class="fas fa-clock"></i> Check-in: {{ $hotel->checkIn }}</span>
                            <span><i class="fas fa-clock"></i> Check-out: {{ $hotel->checkOut }}</span>
                        </div>
                    </div>
                    <div>
                        <div class="hotel-price text-center">
                            {{ config('app.currency', '$') }}  {{ number_format($hotel->price) }}
                        </div>
                        <a href="{{route('front.hotel.about',base64_encode($hotel->id))}}" class="btn-book">
                            Book Now <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="col-12">
        <div class="no-results">
            <i class="fas fa-hotel"></i>
            <h4>No Hotels Found</h4>
            <p>We couldn't find any hotels matching your criteria. Try adjusting your filters.</p>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const resetBtn = document.getElementById('resetNoResultsBtn');
            if (resetBtn) {
                resetBtn.addEventListener('click', function() {
                    const resetFilterBtn = document.getElementById('resetFilterBtn');
                    if (resetFilterBtn) resetFilterBtn.click();
                });
            }
        });
    </script>
@endif
