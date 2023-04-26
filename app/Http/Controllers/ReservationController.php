<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ReservationsRequest;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reservation;

class ReservationController extends Controller{

    // 予約完了ページ表示
    public function thanks(){
        return view('done');
    }

    public function select(Request $request){
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

        //dd($request);
        return view('detail_shop', ['shop' => $shop, 'request' => $request]);
    }

    public function store(ReservationsRequest $request){
        $form = [
            'users_id' => $request->user_id,
            'shops_id' => $request->shop_id,
            'start_at' => $request->date . " " . $request->time,
            'num_of_people' => $request->num_of_people
        ];
        Reservation::create($form);
        return view('done');
    }

    public function destroy(Request $request){
        Reservation::find($request->id)->delete();
        return redirect('mypage');
    }

}
