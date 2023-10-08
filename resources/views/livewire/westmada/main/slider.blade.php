<div class="swiper bg-dark" data-swiper-slides="1" data-swiper-speed="1000" data-swiper-grabcursor="true"
    data-swiper-parallax="true" data-swiper-pagination="true">
    <div class="swiper-pagination text-white position-absolute mb-30 start-0 w-100 d-none d-lg-block"></div>
    <div class="swiper-container">
        <div class="swiper-wrapper">
        @if($sliders->count() > 0)    
         @foreach ($sliders as $slider)
            @php
                $images = explode(',', $slider->images);
                $firstImage = count($images) > 0 ? $images[0] : null;
            @endphp
            <div class="swiper-slide h-auto">
                <div class="py-150 position-relative overflow-hidden h-100" data-name="{{$slider->onglet->name}}">
                    <div class="background">    
                        <div class="background-image">
                           @if ($firstImage)
                            <img loading="lazy" src="{{asset('storage/' . $firstImage)}}" data-swiper-parallax-x="20%" alt="">
                            @endif
                        </div>
                        <div class="background-color" style="--background-color: #000; opacity: .45;"></div>
                        <div class="background-color"
                            style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0) 150px);">
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7 offset-lg-1">
                                <h1 class="text-white mb-40">{{$slider->title}}</h1>
                                <!-- Button-->
                                <a class="btn btn-accent-3" href="{{ route('contente', ['slug' => $slider->slug]) }}" target="_self">En savoir plus
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" 
                                    class="bi bi-plus-circle-fill ms-10 align-self-center"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="position-relative py-160">
                    <div class="background">
                        <div class="background-color" style="background-color: #37404ae2;"></div>
                    </div>
            </div>
            @endif
        </div>
    </div>
    <div class="swiper-button-prev swiper-button-position-3 swiper-button-opacity shadow"><svg
            xmlns="http://www.w3.org/2000/svg" width="20" height="14" fill="none">
            <path fill="currentColor" fill-rule="evenodd"
                d="m3.96 6.15 5.08-4.515L7.91.365.445 7l7.465 6.635 1.13-1.27L3.96 7.85h15.765v-1.7H3.96Z"
                clip-rule="evenodd"></path>
        </svg></div>
    <div class="swiper-button-next swiper-button-position-3 swiper-button-opacity shadow"><svg
            xmlns="http://www.w3.org/2000/svg" width="20" height="14" fill="none">
            <path fill="currentColor" fill-rule="evenodd"
                d="m16.21 6.15-5.08-4.515 1.13-1.27L19.725 7l-7.465 6.635-1.13-1.27 5.08-4.515H.445v-1.7H16.21Z"
                clip-rule="evenodd"></path>
        </svg></div>
</div>