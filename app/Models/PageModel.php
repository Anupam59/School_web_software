<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageModel extends Model
{
    use HasFactory;
    public $table ='page';
    public $primaryKey ='page_id';
    public $incrementing =true;
    public $keyType ='int';
    public $timestamps =false;
}
