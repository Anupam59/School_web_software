<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsModel extends Model
{
    use HasFactory;
    public $table ='news';
    public $primaryKey ='news_id';
    public $incrementing =true;
    public $keyType ='int';
    public $timestamps =false;
}
