<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class FavoriteController extends Controller
{

    public function toggle(Request $request, $productId)
    {
        $favorites = json_decode($request->cookie($this->cookie_name(), '[]'), true);

        if (!in_array($productId, $favorites) and is_numeric($productId)) {
            $favorites[] = $productId;
        } else {
            $favorites = array_diff($favorites, [$productId]);
        }

        if ($request->unico && count($favorites) > 0) {
            Cookie::queue($this->cookie_name(), json_encode($favorites), 525600);
            return back()->with('eliminado', 'One favorite was deleted');
        }
        if ($request->unico && count($favorites) == 0) {
            return $this->eliminarCookieFav();
        }

        return response()->json([
            'status' => 'success',
            'favorites' => $favorites
        ])->cookie($this->cookie_name(), json_encode($favorites), 525600);


    }

    public function cookie_name(): string
    {
        return 'cookie_favorites';
    }

    public function eliminarCookieFav()
    {
        Cookie::queue(Cookie::forget($this->cookie_name()));
        return redirect()->route('home')->with('eliminado', 'All Favorities was deleted');
    }

    public function getFavorites(Request $request)
    {
        $favorites = json_decode($request->cookie($this->cookie_name(), '[]'), true);
        $products = [];
        foreach ($favorites as $favorite) {
            $products[] = Product::find($favorite);
        }
        return view('product.favorites', [
            'products' => $products,
        ]);
    }
}
