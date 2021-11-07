<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\City2;
use Share;
class SellerCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                $city = $data->user->shop->city;
                $total = $data->user->seller_reviews->count();
                $rating = $data->user->seller_reviews->sum('rating');
                if ($total > 0)
                    $rate = $rating/$total;
                else
                    $rate = 0;
                return [
                    'name_ar' =>   $data->user->shop->name_ar,
                    'name_en' => $data->user->shop->name,

                    'user' => [
                        'name' => $data->user->name,
                        'email' => $data->user->email,
                        'avatar' => $data->user->avatar,
                        'avatar_original' => uploaded_asset_nullable($data->user->avatar_original)
                    ],
                    'share_links'=>$this->share($data),
                    
                    'shop_fetures'=>$data->verify,
                    'logo' => api_asset($data->user->shop->logo),
                    'sliders' => $this->convertPhotos(explode(',', $data->user->shop->sliders)),
                    'address_ar' => $city->name,
                    'address_en' => $city->name_en,
                    'rate'=>$rate,
                    'facebook' => $data->user->shop->facebook,
                    // 'google' => $data->user->shop->google,
                    'twitter' => $data->user->shop->twitter,
                    'youtube' => $data->user->shop->youtube,
                    'instagram' => $data->user->shop->instagram,
                    
                    // 'rating'=>
                    'links' => [
                        'featured' => route('v3.shops.featuredProducts', $data->id),
                        'top' => route('v3.shops.topSellingProducts',  $data->id),
                        'new' => route('v3.shops.newProducts', $data->id),
                        'all' => route('v3.shops.allProducts', $data->id),
                        'brands' => route('v3.shops.brands', $data->id)
                    ]
                ];
            })
        ];
    }
    public function share($data){
        // dd();
        $link = 'https://www.brandat-store.com/shop/'.$data->user->shop->slug;
        	$links= Share::load($link, 'seller in tujjar oman store')->services('facebook', 'whatsapp', 'twitter');
        	$links['link']=$link;
        	return $links;

    }
    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200
        ];
    }

    protected function convertPhotos($data){
        $result = array();
        foreach ($data as $key => $item) {
            array_push($result, api_asset($item));
        }
        return $result;
    }
}
