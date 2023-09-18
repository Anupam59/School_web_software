<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerModel extends Model
{
    use HasFactory;

    public $table ='banner';
    public $primaryKey ='banner_id';
    public $incrementing =true;
    public $keyType ='int';
    public $timestamps =false;
}
