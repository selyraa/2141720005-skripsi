<?php

namespace App\Models;

use App\Casts\ProgramEnrollmentStatusCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramEnrollment extends Model
{
    use SoftDeletes;

    protected $table = 'program_enrollments';

    protected $fillable = [
        'user_id',
        'diet_program_id',
        'status',
    ];

    protected $dates = [
        'deleted_at',
    ];

    protected function casts(): array
    {
        return [
            'status' => ProgramEnrollmentStatusCast::class,
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dietProgram()
    {
        return $this->belongsTo(DietProgram::class);
    }

    public function consultationSchedule()
    {
        return $this->hasMany(ConsultationSchedule::class);
    }

    public function checkup()
    {
        return $this->hasMany(Checkup::class);
    }

}
