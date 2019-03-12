<?php

namespace Assignment;

use Illuminate\Database\Eloquent\Model;

class code extends Model
{
    protected $table = 'code';

    public $primaryKey = 'code_id';

    public $timestamps = true;
}
