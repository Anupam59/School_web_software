<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImageModel extends Model
{
    use HasFactory;
    public $table ='gallery_image';
    public $primaryKey ='gallery_image_id';
    public $incrementing =true;
    public $keyType ='int';
    public $timestamps =false;
}
