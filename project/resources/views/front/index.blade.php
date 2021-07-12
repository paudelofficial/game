@extends('layouts.front')

@section('content')

	@if($ps->slider == 1)

		@if(count($sliders))
			@include('includes.slider-style')
		@endif
	@endif

	@if($ps->slider == 1)
		<!-- Hero Area Start -->
		<section class="hero-area" style="padding:1em 0;">
            <div class="container">
                <div class="row">
                   <div class="categories_menu col-lg-3">
						<div class="categories_title active">
							<h5 class="categories_toggle"> {{ $langg->lang14 }} </h5>
						</div>
						<div class="categories_list_inner">
							<ul>

								@foreach($categories as $category)

								<li class="{{count($category->subs) > 0 ? 'dropdown_list':''}} {{ $loop->index >= 14 ? 'rx-child' : '' }}">
								@if(count($category->subs) > 0)
									<div class="img">
										<img src="{{ asset('assets/images/categories/'.$category->photo) }}" alt="">
									</div>
									<div class="link-area">
										<span><a href="{{ route('front.category',$category->slug) }}">{{ $category->name }}</a></span>

									</div>

								@else
									<a href="{{ route('front.category',$category->slug) }}"><img src="{{ asset('assets/images/categories/'.$category->photo) }}"> {{ $category->name }}</a>

								@endif

									</li>

									@if($loop->index == 14)
						                <li>
						                <a href="{{ route('front.categories') }}"><i class="fas fa-plus"></i> {{ $langg->lang15 }} </a>
						                </li>
						                @break
									@endif


									@endforeach

							</ul>
						</div>
					</div>
                    <div class="col-lg-9">
                        @if($ps->slider == 1)

                            @if(count($sliders))
                                <div class="hero-area-slider">
                                    <div class="slide-progress"></div>
                                    <div class="intro-carousel">
                                        @foreach($sliders as $data)
                                            <div class="intro-content {{$data->position}}" style="background-image: url({{asset('assets/images/sliders/'.$data->photo)}})">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="slider-content">
                                                                <!-- layer 1 -->
                                                                <div class="layer-1">
                                                                    <h4 style="font-size: {{$data->subtitle_size}}px; color: {{$data->subtitle_color}}" class="subtitle subtitle{{$data->id}}" data-animation="animated {{$data->subtitle_anime}}">{{$data->subtitle_text}}</h4>
                                                                    <h2 style="font-size: {{$data->title_size}}px; color: {{$data->title_color}}" class="title title{{$data->id}}" data-animation="animated {{$data->title_anime}}">{{$data->title_text}}</h2>
                                                                </div>
                                                                <!-- layer 2 -->
                                                                <div class="layer-2">
                                                                    <p style="font-size: {{$data->details_size}}px; color: {{$data->details_color}}"  class="text text{{$data->id}}" data-animation="animated {{$data->details_anime}}">{{$data->details_text}}</p>
                                                                </div>
                                                                <!-- layer 3 -->
                                                                <div class="layer-3">
                                                                    <a href="{{$data->link}}" target="_blank" class="mybtn1"><span>{{ $langg->lang25 }} <i class="fas fa-chevron-right"></i></span></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                        @endif

                    </div>
                </div>
            </div>

		</section>
		<!-- Hero Area End -->
	@endif

    <style>


        .five-column{
            width:18.75%;
            border:1px solid #c1c1c1;
            height:260px;
        }
        .five-column h5{
            font-size:16px;
        }
        .five-column p{
            font-size:14px;
        }

        @media(max-width:576px){
            .five-column{
                width:100%;
            }
        }

        .col-half-offset{
            margin-left:1%;
        }
    </style>

	@if($ps->featured_category == 1)

	{{-- Slider buttom Category Start --}}
	<section class="slider-buttom-category">
		<div class="container">
			<div class="row">
				@foreach($categories->where('is_featured','=',1) as $cat)
					<div class="col col-half-offset">
						<a href="{{ route('front.category',$cat->slug) }}">
                            <div class="single-category" style="padding:0.5em">
                                <img src="{{asset('assets/images/categories/'.$cat->image) }}" alt="" style="height:175px; width:175px; object-fit:cover;margin-bottom:0.5em"><br>
                                <h5 class="title">
                                    {{ $cat->name }}
                                </h5>
                                <p class="count">
                                    {{ count($cat->products) }} {{ $langg->lang4 }}
                                </p>
                            </div>
						</a>
					</div>
				@endforeach
			</div>
		</div>
	</section>
	{{-- Slider buttom banner End --}}

	@endif


    @foreach($categories as $category)
        @if(count($category->products)>0)
        <section class="category-product trending">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 remove-padding">
                        <div class="section-top">
                            <h2 class="section-title">
                                {{$category->name}}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="row">
					<div class="col-lg-12 remove-padding">
						<div class="trending-item-slider">
							@foreach($products->where('category_id','=',$category->id) as $prod)
                                @include('includes.product.slider-product')
							@endforeach
						</div>
					</div>
				</div>
            </div>
        </section>
        @endif
    @endforeach

<!--
    @if($ps->featured == 1)
    		 Trending Item Area Start 
    		<section  class="trending">
    			<div class="container">
    				<div class="row">
    					<div class="col-lg-12 remove-padding">
    						<div class="section-top">
    							<h2 class="section-title">
    								{{ $langg->lang26 }}
    							</h2>
    							{{-- <a href="#" class="link">View All</a> --}}
    						</div>
    					</div>
    				</div>
    				<div class="row">
    					<div class="col-lg-12 remove-padding">
    						<div class="trending-item-slider">
    							@foreach($feature_products as $prod)
    								@include('includes.product.slider-product')
    							@endforeach
    						</div>
    					</div>
    				</div>
    			</div>
    		</section>
    		 Tranding Item Area End 
    	@endif

	@if($ps->small_banner == 1)

		 Banner Area One Start 
		<section class="banner-section">
			<div class="container">
				@foreach($top_small_banners->chunk(2) as $chunk)
					<div class="row">
						@foreach($chunk as $img)
							<div class="col-lg-6 remove-padding">
								<div class="left">
									<a class="banner-effect" href="{{ $img->link }}" target="_blank">
										<img src="{{asset('assets/images/banners/'.$img->photo)}}" alt="">
									</a>
								</div>
							</div>
						@endforeach
					</div>
				@endforeach
			</div>
		</section>
		 Banner Area One Start 
	@endif

	<section id="extraData">
		<div class="text-center">
			<img src="{{asset('assets/images/'.$gs->loader)}}">
		</div>
	</section>

-->
@endsection

@section('scripts')
	<script>
        $(window).on('load',function() {

            setTimeout(function(){

                $('#extraData').load('{{route('front.extraIndex')}}');

            }, 500);
        });

	</script>
@endsection
