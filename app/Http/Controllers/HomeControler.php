<?php
    
    namespace App\Http\Controllers;
    
    use App\Models\Category;
    use App\Models\Generaloptions;
    use App\Models\Product;
    use App\Models\Tag;
    use Illuminate\Http\Request;
    use Illuminate\View\View;
    
    class HomeControler extends Controller
    {
        public function home(Request $request): View
        {
            $hideNoActives = Generaloptions::get('hide_no_actives', '0');
            $hideNoStock = Generaloptions::get('hide_no_existences', '0');
            $onlyRegisterCanView = Generaloptions::get('only_register_can_view', '0');
            
            if ($request->category) {
                $laid = $request->category;
                $elNombre = Category::where('id', $laid)->pluck('name')[0];
                //dd($elNombre);
                $titulo = " Productos de la categoría \"$elNombre\"";
                $products = Product::with(['tags', 'categories'])
                  ->whereHas('categories',
                    function ($query) use ($hideNoStock, $hideNoActives, $laid) {
                        $query->where('category_id', $laid)
                          ->when($hideNoActives == 1, fn($query) => $query->where('active', true))
                          ->when($hideNoStock == 1, fn($query) => $query->where('units', '>', 0));
                    })->paginate(12);
                
            } elseif ($request->tag) {
                $laid = $request->tag;
                $elNombre = Tag::where('id', $laid)->pluck('name')[0];
                $titulo = "Productos de la etiqueta \"$elNombre \"";
                $products = Product::with(['tags', 'categories'])
                  ->whereHas('tags', function ($query) use ($hideNoStock, $hideNoActives, $laid) {
                      $query->where('tag_id', $laid)
                        ->when($hideNoActives == 1, fn($query) => $query->where('active', true))
                        ->when($hideNoStock == 1, fn($query) => $query->where('units', '>', 0));
                  })->paginate(12);
                
            } else {
                $titulo = "Listado de productos";
                $products = Product::with(['tags', 'categories'])
                  ->when($hideNoActives == 1, fn($query) => $query->where('active', true))
                  ->when($hideNoStock == 1, fn($query) => $query->where('units', '>', 0))
                  ->paginate(100);
            }
            return view('product.index', [
              'products' => $products,
              'title' => $titulo,
            ]);
        }
        
    }
