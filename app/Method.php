<?php

namespace Assignment;

use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    protected $table = 'method';
    // Primary Key
    public $primaryKey = 'method_id';
    // Timestamps
    public $timestamps = true;//
    //
}
