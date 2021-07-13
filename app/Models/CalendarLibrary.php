<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CalendarLibrary extends Model
{
    //
    protected $table= 'calendar_library';
    protected $primaryKey='id_calendar_library';
    public $timestamps=false;
    protected $fillable= [
        'created_at',
        'modified_at',
    ];

    public function createdByUser()
    {
    	return $this->belongsTo(User::Class, 'id');
    }
    public function modifiedByUser()
    {
    	return $this->belongsTo(User::Class, 'id');
    }

    public function calendar()
    {
    	return $this->belongsTo(Calendar::Class, 'id_calendar');
    }

    public function getCreatedAtAttribute($value) {
        return new Carbon($value);
    }

    public function getDay() {
        return config('diasYmeses.dias')[$this->created_at->dayOfWeek];
    }

    public function getMonth() {
        return config('diasYmeses.meses')[$this->created_at->month-1];
    }

    public function createdAtDate() {
        $date = $this->getDay().', ';
        $date .= $this->created_at->format('M').' ';
        $date .= $this->created_at->format('Y').' ';
        $date .= $this->created_at->format('H:i');
        return $date;

        //DIA, NUMEROMES A;O HORA:MINUTO
    }

    public function eventDay() {
        //DIA, NUMEROMES A;O HORA:MINUTO
    }
}
