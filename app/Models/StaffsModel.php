<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffsModel extends Model
{
    use HasFactory;
    public $table ='staffs';
    public $primaryKey ='staffs_id';
    public $incrementing =true;
    public $keyType ='int';
    public $timestamps =false;
}
