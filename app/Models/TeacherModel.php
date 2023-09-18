<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherModel extends Model
{
    use HasFactory;
    public $table ='teacher';
    public $primaryKey ='teacher_id';
    public $incrementing =true;
    public $keyType ='int';
    public $timestamps =false;
}
