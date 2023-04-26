<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reservation;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller{
    
    public function index(){
        $shops = Shop::all();
        $areas = Area::all();
        $genres = Genre::all();
        $user = Auth::user();
        $reserve = Reservation::where('users_id', '=', $user->id)
        ->orderBy('start_at', 'asc')->get();
        $favorite = Favorite::where('users_id', '=', $user->id)->get();

        if(isset($reserve)){
            for($i = 0; $i < count($reserve); $i++){
                // 予約日時と時間の抽出
                $reserve[$i]['date'] = substr($reserve[$i]['start_at'], 0, 10);
                $reserve[$i]['time'] = substr($reserve[$i]['start_at'], 10, 6);

                // 店舗名の代入
                for($n = 0; $n < count($shops); $n++){
                    if($reserve[$i]['shops_id'] == $shops[$n]['id']){
                        $reserve[$i]['shops_name'] = $shops[$n]['name'];
                    }
                }
            }
        }

        if(isset($favorite)){
            for($i = 0; $i < count($favorite); $i++){
                for($n = 0; $n < count($shops); $n++){
                    if($favorite[$i]['shops_id'] == $shops[$n]['id']){
                        $favorite_shop[] = [
                            'id' => $favorite[$i]['id'],
                            'shops_id' => $shops[$n]['id'],
                            'shops_name' => $shops[$n]['name'],
                            'img_url' => $shops[$n]['img_url'],
                            'areas_id' => $shops[$n]['areas_id'],
                            'genres_id' => $shops[$n]['genres_id']
                        ];
                    }
                }
            }
        }

        for($i=0; $i < count($favorite_shop); $i++){
            // エリア名の取得
            for($n=0; $n < count($areas); $n++){
                if($favorite_shop[$i]['areas_id'] == $areas[$n]['id']){
                    $favorite_shop[$i]['area_name'] = $areas[$n]['name'];
                }
            }
            // ジャンル名の取得
            foreach($genres as $genre){
                if($favorite_shop[$i]['genres_id'] == $genre['id']){
                    $favorite_shop[$i]['genre_name'] = $genre->name;
                }
            }
        }

        return view('mypage', ['reserve' => $reserve, 'favorite' => $favorite_shop]);
    }
}
