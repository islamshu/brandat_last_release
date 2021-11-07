@extends('frontend.layouts.app')

@section('content')


    
    <div class="home-banner-area mb-4 pt-3">
        <div class="container">
            <div class="row gutters-10 position-relative">
             
                @php
                $slider_error = json_decode(get_setting('error_slider'), true); 
                $error_panner = json_decode(get_setting('error_panner'), true); 
                $error_product = json_decode(get_setting('error_product'), true); 
                $lang = Session()->get('locale');
                @$dir = App\Language::where('code',$lang)->first()->rtl;
                @endphp 
              

                <div class="  col-lg-12 ">
                    @if (get_setting('home_slider_images') != null)
                        <div class="aiz-carousel dots-inside-bottom mobile-img-auto-height" data-arrows="true" data-dots="true" data-autoplay="true" data-infinite="true">
                            @php $slider_images = json_decode(get_setting('home_slider_images'), true);  @endphp
                            @foreach ($slider_images as $key => $value)
                                <div class="carousel-box">
                                    <a href="{{ json_decode(get_setting('home_slider_links'), true)[$key] }}">
                                        <img 
                                            class="d-block  lazyload img-fit rounded shadow-sm"
                                            src="{{ uploaded_asset($slider_error)}}"
                                            data-src="{{ uploaded_asset($slider_images[$key]) }}"
                                            alt="{{ env('APP_NAME')}} promo"
                                            height="500"

                                           
                                         
                                            onerror="this.onerror=null;this.src='{{ uploaded_asset($slider_error) }}';"

                                            
                                        >
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                   
                </div>

           
               
            </div>
        </div>
    </div>
    <div class="home-banner-area mb-4 pt-3">
        <div class="container">
            <div class="row gutters-10 position-relative">
                 <div class="col-lg-2 position-static d-none d-lg-block">
                    @include('frontend.partials.category_menu')
                </div>  

        



<div class="@if($num_todays_deal > 0) col-lg-7 @else col-lg-9 @endif  "  >
    <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded" style="height:92%">
     @if($flash_deal != null && strtotime(date('Y-m-d ')) >= $flash_deal->start_date && strtotime(date('Y-m-d ')) <= $flash_deal->end_date)

        <div class="d-flex flex-wrap mb-3 align-items-baseline border-bottom">
            <h3 class="h5 fw-700 mb-0">
                <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Flash Sale') }}</span>
            </h3>
            <div class="aiz-count-down ml-auto ml-lg-3 align-items-center " data-date="{{ date('Y/m/d H:i:s', $flash_deal->end_date) }}"></div>
            <a href="{{ route('flash-deal-details', $flash_deal->slug) }}" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md w-100 w-md-auto">{{ translate('View More') }}</a>
        </div>

        <div class="aiz-carousel gutters-10 half-outside-arrow " data-items="3"   data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true' data-infinite='true'>
            @foreach ($flash_deal->flash_deal_products as $key => $flash_deal_product)
             
         @php
                    $product = \App\Product::find($flash_deal_product->product_id);

                @endphp
                @if ($product != null && $product->published != 0)             <div class="col mb-4">
    
        <div class="shell-card card" style="margin-bottom:20px !important">
          <div class="shell-inner card-bodyy">
            <div class="icons">
     <a  href="javascript:void(0)" onclick="addToWishList({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to wishlist') }}" data-placement="left"><i class="fas fa-heart fa-2x"></i></a>
                         <a href="javascript:void(0)" onclick="addToCompare({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to compare') }}" data-placement="left"><i class="far fa-repeat-alt fa-2x"></i></a>
            </div>

          <a href="{{ route('product', $product->slug) }}">
            <div class="product-img">
              <img src="@if($product->thumbnail_img != null) {{ uploaded_asset($product->thumbnail_img) }} " @else {{ uploaded_asset($error_product) }} " @endif">
            </div>
          </a>

            <div class="points">
              <p>{{ translate('Club Point') }}</p>
              <span>{{ $product->earn_point }}</span>
            </div>

      
          <a href="{{ route('product', $product->slug) }}">
            <div class="card-bodyy">
              <h2>  {{ $product->langname()   }}</h2>
              <p>
                  @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                <del>{{ home_base_price($product->id) }}</del> 
                                @endif
                  
               {{ home_discounted_base_price($product->id) }}        </p>
  <div class="star" style="    color: #991d5b;">
                                   <span> <i class="fas fa-star"></i></span>     {{ $product->rating }} 
                            </div>
              
            </div>
          </a>
        
            
            <div class="cart-1">
              <a href="javascript:void(0)" onclick="showAddToCartModal({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to cart') }}" data-placement="left"><i class="far fa-cart-plus fa-2x"></i></a>
            </div>

          </div>
        </div>
      
        </div>
                @endif
            @endforeach
        </div>
        @else

        <div class="aiz-carousel dots-inside-bottom mobile-img-auto-height" data-arrows="true" data-dots="true" data-autoplay="true" data-infinite="true">
                <div class="carousel-box">
                    <a href="#">
                        <img
                            class="d-block mw-100 lazyload img-fit rounded shadow-sm"
                            src="{{asset('public/'.@$baneer_flash)}}"
                            {{-- data-src="{{ uploaded_asset($slider_images[$key]) }}" --}}
                            alt="{{ env('APP_NAME')}} promo"
                            height="320"
                         
                            onerror="this.onerror=null;this.src='{{ uploaded_asset($error_panner) }}';"
                            >
                    </a>
                </div>
        </div>
        
        @endif
  

</div>
</div>

                @if($num_todays_deal > 0)
                <div class="col-lg-3 order-3 mt-3 mt-lg-0" >
                    <div class="bg-white rounded shadow-sm">
                        <div class="bg-soft-primary rounded-top p-3 d-flex align-items-center justify-content-center">
                            <span class="fw-600 fs-16 mr-2 text-truncate">
                                {{ translate('Todays Deal') }}
                            </span>
                            <span class="badge badge-primary badge-inline">{{ translate('Hot') }}</span>
                        </div>
                        <div class="container">
                            <div class="row rowone">
                                @foreach ($today_deals as $key => $product)
                                @if ($product != null)
                              
                                <div class=" card4 col-sm-6 col-md-12 col-lg-12 " style="max-width: 300px;">
                                    <div class="row ">
                                     
                                      <div class="col-md-8">
                                        <div class="card4-bodyyr text-left">
                                          <h4 class="card4-title">{{ $product->langname() }}</h4>
                                          <div class="price card-text">
                                            @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                              <del class="text-danger" >{{ home_base_price($product->id) }}</del>
                                              @endif
                                              <span>{{ home_discounted_base_price($product->id) }}</span></div>
                                          <a href="javascript:void(0)" onclick="showAddToCartModal({{ $product->id }})" data-toggle="tooltip" data-title="{{ translate('Add to cart') }}" data-placement="left" class="border border-primary">{{ translate('Add to cart') }}</a>
                                        </div>
                                      </div>
                            
                                      <div class=" img-boxd col-md-4">
                                        <img          src="{{uploaded_asset($product->thumbnail_img) }}"
                               
                                        alt="{{$product->langname() }}"
                                       

                                        onerror="this.onerror=null;this.src='{{ uploaded_asset($error_product) }}';">
                                        </div>
                                    </div>
                                  </div>
                            
                                @endif
                            @endforeach
                    
                          
                             </div>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>


    {{-- Flash Deal --}}
    @php

        $now = \Now();
    @endphp
   
    
    
    {{-- Banner section 1 --}}
    <div class="mb-4">
        <div class="container">
            <div class="row gutters-10">
                @if (get_setting('home_banner1_images') != null)
                    @foreach ($banner_1_imags as $key => $value)
                        <div class="col-xl col-md-6">
                            <div class="mb-3 mb-lg-0">
                                <a href="{{ json_decode(get_setting('home_banner1_links'), true)[$key] }}" class="d-block text-reset">
                                    <img src="{{ uploaded_asset($error_product) }}" data-src="{{ uploaded_asset($banner_1_imags[$key]) }}" style="height: 180px" alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload">
                                </a>

                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    {{-- Featured Section --}}
    <div id="section_featured">

    </div>

    {{-- Best Selling  --}}
    <div id="section_best_selling">

    </div>

    {{-- Category wise Products --}}
    <div id="section_home_categories">

    </div>

    {{-- Classified Product --}}
    @if(\App\BusinessSetting::where('type', 'classified_product')->first()->value == 1)
        @php
        @endphp
           @if (count($customer_products) > 0)
               <section class="mb-4">
                   <div class="container">
                       <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">
                            <div class="d-flex mb-3 align-items-baseline border-bottom">
                                <h3 class="h5 fw-700 mb-0">
                                    <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Classified Ads') }}</span>
                                </h3>
                                <a href="{{ route('customer.products') }}" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md">{{ translate('View More') }}</a>
                            </div>
                           <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5" data-lg-items="4"  data-md-items="3" data-sm-items="2" data-xs-items="2" data-arrows='true' data-infinite='true'>
                               @foreach ($customer_products as $key => $customer_product)
                                   <div class="carousel-box">
                                        <div class="aiz-card-box border border-primary h-280px rounded hov-shadow-md my-2 has-transition">
                                            <div class="position-relative">
                                                <a href="{{ route('customer.product', $customer_product->slug) }}" class="d-block">
                                                    <img
                                                        class="img-fit lazyload mx-auto h-140px h-md-210px"
                                                        src="{{ uploaded_asset($error_product) }}"
                                                        data-src="{{ uploaded_asset($customer_product->thumbnail_img) }}"
                                                        alt="{{ $customer_product->getTranslation('name') }}"
                                                        onerror="this.onerror=null;this.src='{{ uploaded_asset($error_product) }}';"
                                                    >
                                                </a>
                                                <div class="absolute-top-left pt-2 pl-2">
                                                    @if($customer_product->conditon == 'new')
                                                       <span class="badge badge-inline badge-success">{{translate('new')}}</span>
                                                    @elseif($customer_product->conditon == 'used')
                                                       <span class="badge badge-inline badge-danger">{{translate('Used')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="p-md-3 p-2 text-left">
                                                <div class="fs-15 mb-1">
                                                    <span class="fw-700 text-primary">{{ single_price($customer_product->unit_price) }}</span>
                                                </div>
                                                <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px">
                                                    <a href="{{ route('customer.product', $customer_product->slug) }}" class="d-block text-reset">{{ $customer_product->getTranslation('name') }}</a>
                                                </h3>
                                            </div>
                                       </div>
                                   </div>
                               @endforeach
                           </div>
                       </div>
                   </div>
               </section>
           @endif
       @endif

    {{-- Banner Section 2 --}}
    <div class="mb-4">
        <div class="container">
            <div class="row gutters-10">
                @if (get_setting('home_banner2_images') != null)
                    @foreach ($banner_2_imags as $key => $value)
                        <div class="col-xl col-md-6">
                            <div class="mb-3 mb-lg-0">
                                <a href="{{ json_decode(get_setting('home_banner2_links'), true)[$key] }}" class="d-block text-reset">
                                    <img src="{{ uploaded_asset($error_product) }}" data-src="{{ uploaded_asset($banner_2_imags[$key]) }}" style="height: 180px" alt="{{ env('APP_NAME') }} promo" class="img-fluid lazyload">
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    {{-- Best Seller --}}
    @if (\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
    <div id="section_best_sellers">

    </div>
    @endif

    {{-- Top 10 categories and Brands --}}
    <section class="mb-4">
        <div class="container">
            <div class="row gutters-10">
                @if (get_setting('top10_categories') != null)
                    <div class="col-lg-6">
                        <div class="d-flex mb-3 align-items-baseline border-bottom">
                            <h3 class="h5 fw-700 mb-0">
                                <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Top 10 Categories') }}</span>
                            </h3>
                            <a href="{{ route('categories.all') }}" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md">{{ translate('View All Categories') }}</a>
                        </div>
                        <div class="row gutters-5">
                            @foreach ($top10_categories as $key => $value)
                                @php $category = \App\Category::find($value); @endphp
                                @if ($category != null)
                               
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
                @if (get_setting('top10_categories') != null)
                    <div class="col-lg-6">
                        <div class="d-flex mb-3 align-items-baseline border-bottom">
                            <h3 class="h5 fw-700 mb-0">
                                <span class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Top 10 Brands') }}</span>
                            </h3>
                            <a href="{{ route('brands.all') }}" class="ml-auto mr-0 btn btn-primary btn-sm shadow-md">{{ translate('View All Brands') }}</a>
                        </div>
                        <div class="row gutters-5">
                            @foreach ($top10_brands as $key => $value)
                                @php $brand = \App\Brand::find($value); @endphp
                                @if ($brand != null)
                                    <div class="col-sm-6">
                                        <a href="{{ route('products.brand', $brand->slug) }}" class="bg-white border d-block text-reset rounded p-2 hov-shadow-md mb-2 rounded-pill">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col-4 text-center">
                                                    <img
                                                        src="{{uploaded_asset($error_product)}}"
                                                        data-src="{{ uploaded_asset($brand->logo) }}"
                                                        alt="{{ $brand->getTranslation('name') }}"
                                                        class="img-fluid img lazyload h-60px"
                                                        onerror="this.onerror=null;this.src='{{uploaded_asset($error_product)}}';"
                                                    >
                                                </div>
                                                <div class="col-6">
                                                    <div class="text-truncate-2 pl-3 fs-14 fw-600 text-left">{{ $brand->getTranslation('name') }}</div>
                                                </div>
                                                <div class="col-2 text-center">
                                                    <i class="la la-angle-right text-primary"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $.post('{{ route('home.section.featured') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_featured').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.best_selling') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_selling').html(data);
                AIZ.plugins.slickCarousel();
            });
            $.post('{{ route('home.section.home_categories') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_home_categories').html(data);
                AIZ.plugins.slickCarousel();
            });

            @if (\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
            $.post('{{ route('home.section.best_sellers') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#section_best_sellers').html(data);
                AIZ.plugins.slickCarousel();
            });
            @endif
        });
    </script>
@endsection
