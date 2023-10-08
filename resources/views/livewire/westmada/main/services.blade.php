<div class="pt-40 pb-30 bg-gray-light callToActionPrev">
    <div class="container">
        <div class="row mb-40">
            <div class="col-lg-5 offset-lg-4 text-center">
                <span class="badge bg-light text-dark mb-20" data-show="startbox">NOS SERVICES</span>
                <h2 class="m-0" data-show="startbox" data-show-delay="100">Nos meilleurs services</h2>
            </div>
        </div>
        <div class="row gy-30">
         @foreach($services as $service)   
            <div class="col-12 col-md-6 col-lg-4" data-show="startbox" wire:key="{{$service->id}}" data-show-delay="100">
                <!-- Service case-->
                <div class="service-case lift rounded-4 bg-white shadow overflow-hidden">
                    <a class="service-case-image"
                        href="{{ route('nos-service', ['slug' => $service->slug]) }}" 
                        data-img-height="" style="--img-height: 64%;" wire:navigate>
                        <img loading="lazy"
                            src="{{asset('storage/' .$service->images)}}" alt=""></a>
                    <div class="service-case-body position-relative">
                        <!-- Circle icon-->
                        <div
                            class="circle-icon circle-icon-sm text-white bg-accent-1 position-absolute me-50 top-0 end-0 translate-middle-y">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="19" fill="none">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M20.493 18.382c.396-.396.618-.933.618-1.493V5.278A2.111 2.111 0 0 0 19 3.167H9.5L7.389 0H2.11A2.111 2.111 0 0 0 0 2.111V16.89A2.111 2.111 0 0 0 2.111 19H19c.56 0 1.097-.222 1.493-.618Zm-8.938-9.938a1 1 0 1 0-2 0v2.167H7.388a1 1 0 1 0 0 2h2.167v2.167a1 1 0 1 0 2 0V12.61h2.166a1 1 0 0 0 0-2h-2.166V8.444Z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h4 class="service-case-title mb-15">{{$service->name}}</h4>
                        <p class="service-case-text font-size-15 mb-30 text-ellipsis">{{ Str::limit($service->resume, 45) }}</p>
                        <a class="service-case-arrow stretched-link"
                            href="{{ route('nos-service', ['slug' => $service->slug]) }}" wire:navigate>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="14"
                                fill="none">
                                <path stroke="currentColor" stroke-width="1.7" d="M0 7h18m0 0-6.75-6M18 7l-6.75 6">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-40">
            <div data-show="startbox">
                <!-- Button-->
                <a class="btn btn-light" href="#" target="_self">Tous les services</a>
            </div>
        </div>
    </div>
</div>