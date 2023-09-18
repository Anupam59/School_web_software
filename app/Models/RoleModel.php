<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    use HasFactory;
    public $table ='role';
    public $primaryKey ='role_id';
    public $incrementing =true;
    public $keyType ='int';
    public $timestamps =false;
}
