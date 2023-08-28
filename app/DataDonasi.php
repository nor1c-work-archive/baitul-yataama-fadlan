<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataDonasi extends Model
{
    //
    protected $table = 'tbl_donasi';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
