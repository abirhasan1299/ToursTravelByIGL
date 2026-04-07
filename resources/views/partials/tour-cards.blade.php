@if(count($tours) > 0)
    @foreach($tours as $tour)
        <div class="col-lg-4 col-md-4 px-2 py-2">
            <div class="listing-card-four wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='100ms'>
                <div class="listing-card-four__image">
                    <img src="{{asset('storage/package/'.$tour->cover_img)}}" alt="{{$tour->title}}">

                    <div class="listing-card-four__btn-group">
                        @if($tour->is_featured ?? false)
                            <div class="listing-card-four__featured">Featured</div>
                        @endif
                    </div>

                    <ul class="listing-card-four__meta list-unstyled">
                        <li>
                            <a href="{{route('front.tour.detail', base64_encode($tour->id))}}">
                                <span class="listing-card-four__meta__icon"><i class="icon-pin1"></i></span>
                                {{$tour->end_location}}
                            </a>
                        </li>
                        <li>
                            <a href="{{route('front.tour.detail', base64_encode($tour->id))}}">
                                <span class="listing-card-four__meta__icon"><i class="icon-calendar"></i></span>
                                {{$tour->day}} Days, {{$tour->night}} Nights
                            </a>
                        </li>
                    </ul>
                    <a href="{{route('front.tour.detail', base64_encode($tour->id))}}" class="listing-card-four__image__overly"></a>
                </div>
                <div class="listing-card-four__content">
                    <h3 class="listing-card-four__title">
                        <a href="{{route('front.tour.detail', base64_encode($tour->id))}}">{{ Str::limit($tour->title, 50) }}</a>
                    </h3>


                    <div class="listing-card-four__content__btn">
                        <div class="listing-card-four__price">
                            <span class="listing-card-four__price__sub">Per Person</span>
                            <span class="listing-card-four__price__number">{{config('app.currency')." ".number_format($tour->amount)}}</span>
                        </div>
                        <a href="{{route('front.tour.detail', base64_encode($tour->id))}}" class="listing-card-four__btn gotur-btn">
                            Book <span class="icon"><i class="icon-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="col-12">
        <div class="no-results">
            <i class="fas fa-search"></i>
            <h4>No Tours Found</h4>
            <p>We couldn't find any tours matching your criteria. Please try different filters.</p>

        </div>
    </div>
@endif
