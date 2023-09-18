<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuSubItemModel extends Model
{
    use HasFactory;
    public $table ='menu_sub_item';
    public $primaryKey ='menu_sub_item_id';
    public $incrementing =true;
    public $keyType ='int';
    public $timestamps =false;
}
