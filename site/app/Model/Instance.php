<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Instance extends Model
{
    use SoftDeletes;
    //
    protected $table = 'instance';
    protected $dates = ['deleted_at'];
}
