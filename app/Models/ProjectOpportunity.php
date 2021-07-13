<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectOpportunity extends Model
{
    protected $guarded = [];
    
    public function period()
    {
    	return $this->belongsTo(Period::Class, 'period_id');
    }
    public function process()
    {
        return $this->belongsTo(ProcessType::Class, 'process_types_id');
    }

    public function getCreationDate()
    {
        return $this->created_at->format('d/m/Y');
    }
}
