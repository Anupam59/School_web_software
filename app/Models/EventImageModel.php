<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventImageModel extends Model
{
    use HasFactory;
    public $table ='event_image';
    public $primaryKey ='event_image_id';
    public $incrementing =true;
    public $keyType ='int';
    public $timestamps =false;
}
