<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkModel extends Model
{
    use HasFactory;
    public $table ='link';
    public $primaryKey ='link_id';
    public $incrementing =true;
    public $keyType ='int';
    public $timestamps =false;
}
