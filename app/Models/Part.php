<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    protected $fillable = ['slugName', 'category', 'make', 'model', 'subject', 'year', 'capacity', 'boom', 'jib', 'images', 'description', 'hours', 'condition', 'thumbnail'];

    public function getCleanDescriptionAttribute()
    {
        return strip_tags($this->description, '<br>');
    }

    public function inventory()
    {
        return $this->belongsTo(inventory::class);
    }
}
