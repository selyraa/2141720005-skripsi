<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsultationSchedule extends Model
{
    use SoftDeletes;

    protected $table = 'consultation_schedules';

    protected $fillable = [
        'user_id',
        'program_enrollment_id',
        'schedule_date',
        'status',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function programEnrollment()
    {
        return $this->belongsTo(ProgramEnrollment::class);
    }
}
