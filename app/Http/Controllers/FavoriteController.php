<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller{
    
    public function store(Request $request){
        $form = [
            'users_id' => $request->users_id,
            'shops_id' => $request->shops_id,
        ];
        Favorite::create($form);

        return redirect('/');
    }

    public function destroy(Request $request){
        Favorite::find($request->id)->delete();
        return back();
    }
}
