<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberModel extends Model
{
    use HasFactory;
    public $table ='member';
    public $primaryKey ='member_id';
    public $incrementing =true;
    public $keyType ='int';
    public $timestamps =false;
}
