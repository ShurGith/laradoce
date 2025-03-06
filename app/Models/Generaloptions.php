<?php
    
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    
    class Generaloptions extends Model
    {
        use HasFactory;
        
        public $timestamps = false;
        
        protected $fillable = [
          'name',
          'value'
        ];
        
        protected $casts = [
          'name' => 'string',
        ];
        
        public static function get($key, $default = null)
        {
            return self::where('name', $key)->value('value') ?? $default;
        }
        
        public static function set($key, $value)
        {
            return self::updateOrCreate(['name' => $key], ['value' => $value]);
        }
    }
