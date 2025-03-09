<?php
    
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    
    class Imageproduct extends Model
    {
        use HasFactory;
        
        public $timestamps = false;
        
        protected $fillable = [
          'img_path',
          'img_pos',
          'product_id',
        ];
        
        protected $casts = [
          'id' => 'integer',
          'product_id' => 'integer',
        ];
        
        public function product(): BelongsTo
        {
            return $this->belongsTo(Product::class);
        }
    }
