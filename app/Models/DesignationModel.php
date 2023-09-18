<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignationModel extends Model
{
    use HasFactory;
    public $table ='designation';
    public $primaryKey ='designation_id';
    public $incrementing =true;
    public $keyType ='int';
    public $timestamps =false;
}
