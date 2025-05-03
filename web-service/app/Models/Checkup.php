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

    /**
     * Calculate BMI value based on height and weight
     * 
     * @return float
     */
    public function calculateBmi()
    {
        if ($this->height <= 0) return 0;
        
        $heightInMeters = $this->height / 100;
        return $this->weight / ($heightInMeters * $heightInMeters);
    }

    /**
     * Get BMI category based on value
     * 
     * @return string
     */
    public function getBmiCategory()
    {
        $bmi = $this->calculateBmi();
        
        if ($bmi < 18.5) {
            return 'underweight';
        } elseif ($bmi >= 18.5 && $bmi < 25) {
            return 'normal';
        } elseif ($bmi >= 25 && $bmi < 30) {
            return 'overweight';
        } else {
            return 'obese';
        }
    }

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
