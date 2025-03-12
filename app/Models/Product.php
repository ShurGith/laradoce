<?php
    
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\BelongsToMany;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Laravolt\Avatar\Facade as Avatar;
    
    class Product extends Model
    {
        use HasFactory;
        
        protected $fillable = [
          'name',
          'description',
          'features',
          'price',
          'active',
          'oferta',
          'descuento',
          'units',
          'user_id',
          'images',
          'stars'
        ];
        
        protected $casts = [
          'id' => 'integer',
          'active' => 'boolean',
          'oferta' => 'boolean',
          'user_id' => 'integer',
          'descuento' => 'integer',
          'units' => 'integer',
          'images' => 'array',
          'stars' => 'integer'
        ];
        
        public function getImgPal()
        {
            // if (isset($this->images)) {
            if (isset($this->images)) {
                if (count($this->images) > 0) {
                    return asset($this->images[0]);
                }
            }
            return Avatar::create($this->name)->toBase64();
        }
        
        public function countImg()
        {
            $count = 0;
            if (isset($this->images)) {
                foreach ($this->images as $img) {
                    $count++;
                }
                return $count - 1;
            }
            return false;
        }
        
        public function getThumbs()
        {
            $thumbs = [];
            if (isset($this->images)) {
                foreach ($this->images as $thumb) {
                    if ($thumb !== $this->images[0]) {
                        $thumbs[] = $thumb;
                    }
                }
            }
            return $thumbs;
            
        }
        
        public function featuretitles(): HasMany
        {
            return $this->hasMany(Featuretitle::class);
        }
        
        public function buyer(): HasMany
        {
            return $this->hasMany(Order::class);
        }
        
        public function tags(): BelongsToMany
        {
            return $this->belongsToMany(Tag::class);
        }
        
        public function categories(): BelongsToMany
        {
            return $this->belongsToMany(Category::class);
        }
        
        public function seller(): BelongsTo
        {
            return $this->belongsTo(Order::class);
        }
        
        public function user(): BelongsTo
        {
            return $this->belongsTo(User::class);
        }
        
        public function precios($descuento, $decimales = false): string
        {
            if ($descuento && $this->oferta) {
                $precio_final = $this->price * ((100 - $this->descuento) / 100);
            } else {
                $precio_final = $this->price;
            }
            if ($decimales) {
                return substr($this->formatoPrecio($precio_final), -2);
            }
            
            return substr($this->formatoPrecio($precio_final), 0, strpos($this->formatoPrecio($precio_final), "'") + 1);
        }
        
        public function formatoPrecio($valor)
        {
            return number_format($valor / 100, 2, "'", ".");
        }
        
        public function getStars()
        {
            $salida = "";
            $quitaUno = 0;
            $stars = $this->stars;
            $starFull = config('url')."/images/page/star-full.svg";
            $starHalf = config('url')."/images/page/star-half.svg";
            $starEmpty = config('url')."/images/page/star-empty.svg";
            $decimales = intval(substr($stars, -1));
            $enteros = intval(substr($stars, 0, 1));
            for ($i = 0; $i < $enteros; $i++) {
                $salida .= "<img src=$starFull style='width:18px; height:18px'>";
            }
            if ($decimales > 0) {
                $salida .= "<img src=$starHalf style='width:18px; height:18px'>";
                $quitaUno = 1;
            }
            if ($enteros + 1 < 5) {
                for ($i = 0; $i < 5 - $enteros - $quitaUno; $i++) {
                    $salida .= "<img src=$starEmpty style='width:16px; height:16px'>";
                }
            }
            if ($enteros + $quitaUno > 0) {
                return $salida;
            }
        }
        
    }
