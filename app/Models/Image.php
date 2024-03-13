<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['image_order','inventory_id', 'image_path'];

    /**
     * Get the Inventory that owns the Image
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function getImagePathAttribute($value){
        if(!Str::startsWith($value, '/')){
            return '/'.$value;
        }
        return $value;
    }
}
