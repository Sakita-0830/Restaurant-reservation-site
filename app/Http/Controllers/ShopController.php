<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;


class ShopController extends Controller{
    
    // 店舗一覧表示
    public function index(Request $request){
        $shops = Shop::all();
        $areas = Area::all();
        $genres = Genre::all();
        $user = Auth::user();
        $favorite = Favorite::all();

        for($i=0; $i < count($shops); $i++){
            // 検索無し
            if(empty($request->area) && empty($request->genre) && empty($request->word)){
                $shop_data = Shop::all();
            }
            // エリアで検索
            elseif(isset($request->area) && empty($request->genre) && empty($request->word)){
                $shop_data = Shop::where('areas_id', '=', $request->area)->get();
            }
            // ジャンルで検索
            elseif(empty($request->area) && isset($request->genre) && empty($request->word)){
                $shop_data = Shop::where('genres_id', '=', $request->genre)->get();
            }
            // キーワードで検索
            elseif(empty($request->area) && empty($request->genre) && isset($request->word)){
                $shop_data = Shop::where('name', 'LIKE', "%{$request->word}%")->get();
            }
            // エリア,ジャンルで検索
            elseif(isset($request->area) && isset($request->genre) && empty($request->word)){
                $shop_data = Shop::where('areas_id', '=', $request->area)
                ->where('genres_id', '=', $request->genre)
                ->get();
            }
            // エリア,キーワードで検索
            elseif(isset($request->area) && empty($request->genre) && isset($request->word)){
                $shop_data = Shop::where('areas_id', '=', $request->area)
                ->where('name', 'LIKE', "%{$request->word}%")
                ->get();
            }
            // ジャンル,キーワードで検索
            elseif(empty($request->area) && isset($request->genre) && isset($request->word)){
                $shop_data = Shop::where('genres_id', '=', $request->genre)
                ->where('name', 'LIKE', "%{$request->word}%")
                ->get();
            }
            // エリア,ジャンル,キーワードで検索
            elseif(isset($request->area) && isset($request->genre) && isset($request->word)){
                $shop_data = Shop::where('areas_id', '=', $request->area)
                ->where('genres_id', '=', $request->genre)
                ->where('name', 'LIKE', "%{$request->word}%")
                ->get();
            }

            // 店舗が存在するエリアの抽出
            for($n=0; $n < count($areas); $n++){
                if($shops[$i]['areas_id'] == $areas[$n]['id']){
                    $areas_data[] = array(
                        'id' => $areas[$n]['id'],
                        'name' => $areas[$n]['name']
                    );
                }
            }
        }

        for($i=0; $i < count($shop_data); $i++){
            // エリア名の取得
            for($n=0; $n < count($areas); $n++){
                if($shop_data[$i]['areas_id'] == $areas[$n]['id']){
                    $shop_data[$i]['area_name'] = $areas[$n]['name'];
                }
            }
            // ジャンル名の取得
            foreach($genres as $genre){
                if($shop_data[$i]['genres_id'] == $genre['id']){
                    $shop_data[$i]['genre_name'] = $genre->name;
                }
            }
            // お気に入りの取得
            if(isset($user) && isset($favorite)){
                for($n=0; $n < count($favorite); $n++){
                    if($shop_data[$i]['id'] == $favorite[$n]['shops_id'] && $user->id == $favorite[$n]['users_id']){
                        $shop_data[$i]['favorite'] = $favorite[$n]['id'];
                    }
                }
            }
        }

        // 重複エリアの削除
        for($i=0; $i < count($areas_data); $i++){
            $areas_exist =array_unique($areas_data, SORT_REGULAR);
        }

        //dd($shop_data);
        return view('index_shops', ['shops' => $shop_data, 'areas' => $areas_exist, 'genres' => $genres, 'request' => $request]);
    }

    // 店舗詳細ページ表示
    public function detail(Request $request){
        $areas = Area::all();
        $genres = Genre::all();
        $shop = Shop::where('id', '=', $request->shop_id)->first();

        // エリア名の取得
        foreach($areas as $areas){
            if($shop->areas_id == $areas['id']){
                $shop->area_name = $areas['name'];
            }
        }
        // ジャンル名の取得
        foreach($genres as $genre){
            if($shop->genres_id == $genre['id']){
                $shop->genre_name = $genre->name;
            }
        }

        return view('detail_shop', ['shop' => $shop]);
    }

    

}
