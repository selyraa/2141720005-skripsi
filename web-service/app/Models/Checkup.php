<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checkup extends Model
{
    use SoftDeletes;

    protected $table = 'checkups';

    protected $fillable = [
        'program_enrollment_id',
        'checkup_date',
        'height',
        'weight',
        'body_fat',
        'belly_fat',
        'bone_density',
        'calories_needs',
        'cell_age',
        'muscle_mass',
        'water_content',
    ];

    protected $dates = [
        'deleted_at',
        'checkup_date',
    ];

    protected $casts = [
        'checkup_date' => 'datetime',
    ];

    public function programEnrollment()
    {
        return $this->belongsTo(ProgramEnrollment::class);
    }

    public function dietPrediction()
    {
        return $this->hasOne(DietPrediction::class);
    }

    public function dietRecommendation()
    {
        return $this->hasOne(DietRecommendation::class);
    }
}
