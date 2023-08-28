<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BeritaYayasan extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
