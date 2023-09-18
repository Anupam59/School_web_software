<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodModel extends Model
{
    use HasFactory;
    public $table ='period';
    public $primaryKey ='period_id';
    public $incrementing =true;
    public $keyType ='int';
    public $timestamps =false;
}
