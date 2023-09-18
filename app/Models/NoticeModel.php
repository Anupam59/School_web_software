<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeModel extends Model
{
    use HasFactory;
    public $table ='notice';
    public $primaryKey ='notice_id';
    public $incrementing =true;
    public $keyType ='int';
    public $timestamps =false;
}
