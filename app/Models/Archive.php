<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use SoftDeletes;

    protected $table = "archives";
    protected $primarykey = "id";

    protected $guarded = [
        'id'
    ];
}
