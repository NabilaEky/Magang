<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    use HasFactory;

    protected $fillable = ['slide_number', 'image_path'];

    public static function isSlideAvailable($slide_number)
    {
        return !self::where('slide_number', $slide_number)->exists();
    }
}
