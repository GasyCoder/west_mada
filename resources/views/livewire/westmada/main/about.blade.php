<div class="pt-60 pb-30 shape-parent overflow-hidden">
    <!-- Shape-->
    <div class="shape justify-content-end">
        <img loading="lazy" src="{{asset('assets/frontend/img/root/team-shape-534x383.png')}}" alt="" width="536" height="630">
    </div>
    <div class="container">
        <div class="row align-items-center gy-90">
            <div class="col-lg-7">
                <div class="pe-lg-70">
                    <span class="badge bg-light text-dark mb-20" data-show="startbox">Qui sommes-nous?</span>
                    <h2 class="mb-20" data-show="startbox" data-show-delay="100">
                        <span class="highlight">West Mada SARL,</span><br>{{ $pageAbout->title }}
                    </h2>
                    <p class="mb-40" data-show="startbox" data-show-delay="300">
                        {{ $pageAbout->sub_title }}</p> 
                    <div data-show="startbox" data-show-delay="400">
                        <!-- Button-->
                        <a class="btn btn-accent-1 btn-link btn-clean" href="{{ route('pagetype', ['slug' => $pageAbout->slug]) }}" target="_self">Découvrez-nous</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 pb-30">
                <div class="ms-40 shape-parent">    
                <!-- Slider-->
                <div class="swiper me-lg-40" data-swiper-slides="1" data-swiper-effect="fade" data-show="startbox">
                    <div class="swiper-container">
                        <div class="swiper-wrapper gallery-wrapper">
                         @foreach($stories as $story)   
                         @foreach ($story->images as $image)
                            <div class="swiper-slide">
                                <!-- Gallery item-->
                                <a class="gallery-item rounded-4 overflow-hidden" href="{{ asset('storage/' . $image) }}" style="--img-height: 110%;"
                                    data-img-height="">
                                    <img loading="lazy" src="{{ asset('storage/' . $image) }}" alt="">
                                </a>
                            </div>
                          @endforeach  
                          @endforeach
                        </div>
                    </div>
                    <div class="swiper-button-prev swiper-button-position-1 swiper-button-white shadow"><svg
                            xmlns="http://www.w3.org/2000/svg" width="20" height="14" fill="none">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="m3.96 6.15 5.08-4.515L7.91.365.445 7l7.465 6.635 1.13-1.27L3.96 7.85h15.765v-1.7H3.96Z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="swiper-button-next swiper-button-position-1 swiper-button-white shadow"><svg
                            xmlns="http://www.w3.org/2000/svg" width="20" height="14" fill="none">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="m16.21 6.15-5.08-4.515 1.13-1.27L19.725 7l-7.465 6.635-1.13-1.27 5.08-4.515H.445v-1.7H16.21Z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>