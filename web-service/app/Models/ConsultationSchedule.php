<?php

namespace App\Models;

use App\Casts\ConsultationScheduleStatusCast;
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

    protected $casts = [
        'schedule_date' => 'datetime',
        'status' => ConsultationScheduleStatusCast::class,
    ];

    protected $dates = [
        'deleted_at',
        'schedule_date',
    ];

    public function programEnrollment()
    {
        return $this->belongsTo(ProgramEnrollment::class);
    }
}
