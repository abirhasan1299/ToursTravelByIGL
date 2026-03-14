@extends('layout.theme')
@section('title','Tour List')
@push('css')
            <style>
                .listing-card-four{
            height:100%;
            display:flex;
            flex-direction:column;
        }

        .listing-card-four__image{
            height:220px;
            overflow:hidden;
        }

        .listing-card-four__image img{
            width:100%;
            height:100%;
            object-fit:cover;
        }

        .listing-card-four__content{
            flex:1;
            display:flex;
            flex-direction:column;
            justify-content:space-between;
        }
            </style>
@endpush
@section('content')
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{asset('assets/images/backgrounds/page-header-bg-1-1.jpg')}});"></div><!-- /.page-header__bg -->
        <div class="container">
            <div class="page-header__content">
                <h2 class="page-header__title bw-split-in-right">Tour Listing</h2>
                <ul class="gotur-breadcrumb list-unstyled">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><span>Tour Listing</span></li>
                </ul><!-- /.thm-breadcrumb list-unstyled -->
            </div><!-- /.page-header__content -->
        </div><!-- /.container -->
    </section><!-- /.page-header -->

    <section class="tour-listing-page section-space">
        <div class="container">
            <div class="row gutter-y-30 gutter-x-30  align-items-stretch">
               @foreach($tours as $t)
                <div class="col-lg-4 col-md-6">
                    <div class="listing-card-four wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='100ms'>
                        <div class="listing-card-four__image">
                            <img src="{{asset('storage/package/'.$t->cover_img)}}" alt="">

                            <div class="listing-card-four__btn-group">

                                <div class="listing-card-four__featured">Featured</div><!-- /.listing-card-four__featured -->

                            </div><!-- /.listing-card-four__btn-group -->

                            <ul class="listing-card-four__meta list-unstyled">
                                <li>
                                    <a href="{{route('front.tour.detail',base64_encode($t->id))}}"> <span class="listing-card-four__meta__icon"> <i class="icon-pin1"></i> </span>{{$t->end_location}}</a>
                                </li>
                                <li>
                                    <a href="{{route('front.tour.detail',base64_encode($t->id))}}"> <span class="listing-card-four__meta__icon"> <i class="icon-calendar"></i> </span>{{$t->day}}  Days, {{$t->night}}  Night</a>
                                </li>
                            </ul><!-- /.listing-card-four__meta -->
                            <a href="#" class="listing-card-four__image__overly"></a>
                        </div><!-- /.listing-card-four__image -->
                        <div class="listing-card-four__content">

                            <h3 class="listing-card-four__title"><a href="{{route('front.tour.detail',base64_encode($t->id))}}">{{$t->title}}</a></h3><!-- /.listing-card-four__title -->

                            <div class="listing-card-four__content__btn">
                                <div class="listing-card-four__price">
                                    <span class="listing-card-four__price__sub">Per Person</span>
                                    <span class="listing-card-four__price__number">{{config('app.currency')." ".number_format($t->amount)}}</span>
                                </div><!-- /.listing-card-four__price -->
                                <a href="{{route('front.tour.detail',base64_encode($t->id))}}" class="listing-card-four__btn gotur-btn"> Book Now <span class="icon"><i class="icon-right"></i> </span></a>
                            </div><!-- /.listing-card-four__content__btn -->
                        </div><!-- /.listing-card-four__content -->
                    </div><!-- /.listing-card-four -->
                </div><!-- /.col-lg-4 col-md-6 -->
                @endforeach
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.tour-listing-page -->
@endsection
@push('js')
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
