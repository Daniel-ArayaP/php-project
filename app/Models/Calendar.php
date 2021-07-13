<?php

namespace App\Models ;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Calendar extends Model
{
    //
    protected $table= 'calendar_outlook';
    protected $primaryKey='id_calendar';
    public $timestamps=false;
    protected $fillable= [
        'id_event',
        'subject',
        'body_preview',
        'start_time',
        'end_time',
        'web_link',
        'mail',
        'button_zoom',
        'type_activity'
    ];

    public function user()
    {
    	return $this->belongsTo(User::Class, 'id');
    }

    public function trainingCourse()
    {
    	return $this->belongsTo(TrainingCourse::Class, 'id_training_course');
    }

    public function typeCalendar()
    {
    	return $this->belongsTo(TypeCalendar::Class, 'id_type_calendar');
    }

    /**
     * Este método permite ver si el evento esta pendiente, es decir, la fecha de inicio
     * aún no ha sido alcanzada por la fecha actual.
     */
    public function isPending() {
        $today = Carbon::now();

        
        return $today->lessThan( $this->getStartTime() );
    }

    /**
     * Este método permite ver si el evento está en progreso, es decir, la fecha
     * actual está entre la fecha de inicio y de fin del evento.
     */
    public function inProgress() {
        $today = Carbon::now();
        
        return $today->between(
            $this->getStartTime(),
            $this->getEndTime()
        );
    }

    /**
     * Permite saber si un evento esta terminado o realizado, comparando
     * que la fecha actual sea mayor que la fecha de inicio del evento.
     */
    public function isDone() {
        $today = Carbon::now();

        return $today->greaterThan( $this->getStartTime() );
    }

    /**
     * Permite saber si el evento posee materiales.
     */
    public function hasRepository() {
        $repository = Repository::where('id_calendar', '=', $this->id_calendar)->get();

        /* se pregunta si el repositorio posee archivos */
        return sizeof( $repository ) > 0 ? true : false;
    }

    /**
     * Permite obtener un objeto Carbon de la fecha 
     * de inicio del evento
     */
    public function getStartTime() {
        return new Carbon($this->start_time);
    }

    /**
     * Permite obtener un objeto Carbon de la fecha 
     * de fin del evento
     */
    public function getEndTime() {
        return new Carbon($this->end_time);
    }

    /**
     * Mutator para el atributo start_time.
     * Permite obtener la fecha que es de tipo
     * texto, en un objeto tipo Carbon, con solo
     * llamar al atributo del evento de la forma
     * normal.
     */
    public function getStartTimeAttribute($value) {
        return new Carbon($value);
    }

    /**
     * Mutator para el atributo end_time.
     * Permite obtener la fecha que es de tipo
     * texto, en un objeto tipo Carbon, con solo
     * llamar al atributo del evento de la forma
     * normal.
     */
    public function getEndTimeAttribute($value) {
        return new Carbon($value);
    }

    public function getDay() {
        return config('diasYmeses.dias')[$this->end_time->dayOfWeek];
    }

    public function getMonth() {
        return config('diasYmeses.mesCorto')[$this->end_time->month-1];
    }
}
