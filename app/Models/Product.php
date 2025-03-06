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
        ];
        
        protected $casts = [
          'id' => 'integer',
          'active' => 'boolean',
          'oferta' => 'boolean',
          'user_id' => 'integer',
        ];
        
        public function getImgPal()
        {
            if ($this->imageproducts->count() === 0) {
                return Avatar::create($this->name)->toBase64();
            }
            foreach ($this->imageproducts as $image) {
                if ($image->img_pos === 1) {
                    return asset($image->img_path);
                }
            }
        }
        
        public function imageproducts(): HasMany
        {
            return $this->hasMany(Imageproduct::class);
        }
        
        public function featuretitles(): HasMany
        {
            return $this->hasMany(Featuretitle::class);
        }
        
        public function tags(): BelongsToMany
        {
            return $this->belongsToMany(Tag::class);
        }
        
        public function categories(): BelongsToMany
        {
            return $this->belongsToMany(Category::class);
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
        
    }
