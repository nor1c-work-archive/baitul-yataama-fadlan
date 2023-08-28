<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataDonatur extends Model
{
    protected $table = 'tbl_donatur';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
