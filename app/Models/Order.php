<?php
    
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Model;
    
    class Order extends Model
    {
        
        protected $fillable = ['buyer_id', 'seller_id', 'product_id'];
        protected $casts = [
          'buyer_id' => 'integer', 'seller_id' => 'integer', 'product_id' => 'integer'
        ];
        
        public function buyer()
        {
            return $this->belongsTo(User::class, 'buyer_id');
        }
        
        public function seller()
        {
            return $this->belongsTo(User::class, 'seller_id');
        }
        
        public function product()
        {
            return $this->belongsTo(Product::class);
        }
    }
