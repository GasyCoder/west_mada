<div>
 <div class="content-wrap">
    <!-- Page title-->
    <div class="position-relative py-160">
        <div class="background">
            <div class="background-color" style="background-color: #37404ae2;"></div>
        </div>
        <div class="container">
            <h1 class="text-white mb-0 text-center">{{$page->onglet->name}}</h1>
        </div>
    </div>
        <div class="pt-80 pb-30" id="next">
            <div class="container">
                <div class="row gy-100">
                    <div class="col-lg-7">
                        <h3 class="mb-35" data-show="startbox">{{$page->title}}</h3>
                        <h4 class="mb-30" data-show="startbox" data-show-delay="100" style="text-align: justify">{{$page->sub_title}}</h4>
                        <p class="mb-40" data-show="startbox" data-show-delay="200" style="text-align: justify">
                            {{$page->description}}
                        </p>
                        <div data-show="startbox" data-show-delay="300">
                         @if($page->url != null)   
                            @php
                            $completeUrl = 'http://' . $page->url;
                            @endphp
                            <!-- Button-->
                            <a class="btn btn-accent-1" href="{{$completeUrl}}" target="_blank">Visitez Website 
                                <svg class="ms-15 align-self-center" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none">
                                    <path fill="currentColor" d="M7.273 8.196a.85.85 0 0 0-1.362 1.017l1.362-1.017Zm4.627.89-.601-.602.601.601Zm2.112-2.115.601.6a.638.638 0 0 0 .01-.01l-.611-.59ZM9.035 1.99l-.591-.611-.009.009.6.602Zm-1.81.603a.85.85 0 1 0 1.199 1.205l-1.2-1.205Zm1.502 5.212a.85.85 0 1 0 1.362-1.017L8.727 7.804ZM4.1 6.914l.601.602-.601-.601ZM1.988 9.03l-.601-.6a.934.934 0 0 0-.01.01l.611.59Zm4.977 4.982.59.611a.638.638 0 0 0 .011-.01l-.6-.601Zm1.805-.604a.85.85 0 0 0-1.202-1.202l1.202 1.202ZM5.911 9.213a4.37 4.37 0 0 0 1.404 1.219l.816-1.492a2.67 2.67 0 0 1-.858-.744L5.911 9.213Zm1.404 1.219c.55.3 1.158.48 1.783.524l.122-1.695a2.667 2.667 0 0 1-1.089-.32l-.816 1.491Zm1.783.524a4.366 4.366 0 0 0 1.84-.264l-.594-1.593a2.667 2.667 0 0 1-1.124.162l-.122 1.696Zm1.84-.264a4.369 4.369 0 0 0 1.563-1.006L11.3 8.485a2.67 2.67 0 0 1-.955.614l.594 1.593Zm1.563-1.006 2.112-2.114-1.202-1.202-2.112 2.114L12.5 9.686Zm2.123-2.125a4.375 4.375 0 0 0 1.226-3.076l-1.7.015a2.675 2.675 0 0 1-.75 1.881l1.224 1.18Zm1.226-3.076a4.375 4.375 0 0 0-1.28-3.054l-1.202 1.202c.495.495.776 1.166.782 1.867l1.7-.015Zm-1.28-3.054a4.368 4.368 0 0 0-3.052-1.28l-.015 1.7c.7.005 1.37.286 1.865.782L14.57 1.43ZM11.518.151a4.368 4.368 0 0 0-3.074 1.227L9.626 2.6a2.668 2.668 0 0 1 1.877-.75l.015-1.7ZM8.435 1.386l-1.21 1.205 1.199 1.205 1.21-1.205-1.199-1.205Zm1.654 5.4a4.37 4.37 0 0 0-1.404-1.219L7.869 7.06c.336.183.629.437.858.744l1.362-1.017ZM8.685 5.568c-.55-.3-1.158-.48-1.783-.524L6.78 6.739c.382.028.753.137 1.089.32l.816-1.491Zm-1.783-.524a4.367 4.367 0 0 0-1.84.264l.594 1.593a2.667 2.667 0 0 1 1.124-.162l.122-1.695Zm-1.84.264a4.37 4.37 0 0 0-1.564 1.006l1.203 1.201c.271-.27.597-.48.955-.614l-.594-1.593ZM3.499 6.314 1.387 8.428 2.589 9.63l2.112-2.114L3.5 6.314ZM1.376 8.44A4.375 4.375 0 0 0 .15 11.515l1.7-.015a2.675 2.675 0 0 1 .75-1.881l-1.224-1.18ZM.15 11.515a4.375 4.375 0 0 0 1.28 3.054l1.202-1.202A2.675 2.675 0 0 1 1.85 11.5l-1.7.015Zm1.28 3.054a4.368 4.368 0 0 0 3.052 1.28l.015-1.7a2.668 2.668 0 0 1-1.865-.782L1.43 14.57Zm3.052 1.28a4.368 4.368 0 0 0 3.074-1.227L6.374 13.4a2.668 2.668 0 0 1-1.877.75l-.015 1.7Zm3.084-1.237 1.204-1.205-1.202-1.202-1.204 1.205 1.202 1.202Z"></path>
                                </svg>
                            </a>
                        @endif
                        </div>
                    </div>
                    <div class="col-lg-4 offset-lg-1" data-show="startbox" data-show-delay="400">
                        <div class="bg-gray-light rounded-4 py-50 px-60">
                            <h5 class="mb-10">Nos services</h5>
                            <p class="m-0">Business Consulting <br>Development <br>Branding Strategy</p>
                            <h5 class="mb-10 mt-35">Contacts</h5>
                            <p class="m-0">+261 34 93 458 51 <br> @ bezara@eeh.fr</p>
                            <h5 class="mb-10 mt-35">Adresse </h5>
                            <p class="m-0">Mahajanga Madagascar</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid mt-30 p-0" data-show="startbox">
                <div class="swiper" data-swiper-slides="auto" data-swiper-center="true" data-swiper-loop="true" data-swiper-gap="30"
                    data-swiper-grabcursor="true">
                    <div class="swiper-container">
                        <div class="swiper-wrapper gallery-wrapper">
                            @foreach (explode(',', $page->images) as $imagePath)
                            <div class="swiper-slide" style="max-width: 570px;">
                                <!-- Gallery item-->
                                <a class="gallery-item rounded-4 overflow-hidden" href="{{ asset('storage/' . trim($imagePath)) }}"
                                    style="--img-height: 42%;" data-img-height="">
                                    <img loading="lazy" src="{{ asset('storage/' . trim($imagePath)) }}" alt="">
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="d-flex mt-30 mb-40 justify-content-center">
                        <div class="swiper-button-prev swiper-button-position-2 swiper-button-gray shadow"><svg
                                xmlns="http://www.w3.org/2000/svg" width="20" height="14" fill="none">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="m3.96 6.15 5.08-4.515L7.91.365.445 7l7.465 6.635 1.13-1.27L3.96 7.85h15.765v-1.7H3.96Z"
                                    clip-rule="evenodd">
                                </path>
                            </svg>
                        </div>
                        <div class="swiper-button-next swiper-button-position-2 swiper-button-gray shadow"><svg
                                xmlns="http://www.w3.org/2000/svg" width="20" height="14" fill="none">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="m16.21 6.15-5.08-4.515 1.13-1.27L19.725 7l-7.465 6.635-1.13-1.27 5.08-4.515H.445v-1.7H16.21Z"
                                    clip-rule="evenodd">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-150">
            <div class="row gy-30">
            @if($page->liste_1 !== Null)   
            @foreach ($listes->getAttributes() as $key => $value)
            <div class="col-12 col-md-6 col-lg-3" data-show="startbox">
                <!-- Service box -->
                <div class="service-box lift position-relative rounded-4 bg-light text-center service-box-sm">
                    <!-- Circle icon -->
                    <div class="circle-icon text-white bg-accent-2 mb-30">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26"
                            height="29" fill="none">
                            <path fill="currentColor" d="...">
                                <!-- Your SVG path data here -->
                            </path>
                        </svg></div>
                    <h4 class="service-box-title mb-15">{{ $value }}</h4>
                    {{-- <p class="service-box-text font-size-15 mb-0">{{ $value }}</p> --}}
                </div>
            </div>
            @endforeach
            @endif
            </div>
        </div>
    </div>
</div>