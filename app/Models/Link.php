<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    public $table ='links';
    protected $fillable = ['original_url','short_code'];
}
