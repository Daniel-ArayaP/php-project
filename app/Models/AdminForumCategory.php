<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminForumCategory extends Model
{
    protected $table = 'forum_categories';
    protected $primaryKey='category_id';
    public $timestamps = false;
}