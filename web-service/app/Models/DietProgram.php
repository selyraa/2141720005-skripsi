<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DietProgram extends Model
{
    use SoftDeletes;

    protected $table = 'diet_programs';
    protected $fillable = [
        'name',
        'description',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function programEnrollments()
    {
        return $this->hasMany(ProgramEnrollment::class);
    }

    public function predictionResults()
    {
        return $this->hasMany(PredictionResult::class);
    }

}
