<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryModel extends Model
{
    use HasFactory;
    public $table ='gallery';
    public $primaryKey ='gallery_id';
    public $incrementing =true;
    public $keyType ='int';
    public $timestamps =false;
}
