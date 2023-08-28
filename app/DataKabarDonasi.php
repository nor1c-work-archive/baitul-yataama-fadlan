<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataKabarDonasi extends Model
{
    protected $table = 'tbl_kabar_donasi';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
