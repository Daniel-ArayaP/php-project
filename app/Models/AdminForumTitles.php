<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminForumTitles extends Model
{
    protected $table = 'forum_titles';
    protected $primaryKey='id';
    public $timestamps = false;

    public function parent_category_id()
    {
    	return $this->belongsTo(AdminForumCategory::Class, 'category_id');
    }

}