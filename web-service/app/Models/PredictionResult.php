<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PredictionResult extends Model
{
    use SoftDeletes;

    protected $table = 'prediction_results';

    protected $fillable = [
        'diet_prediction_id',
        'diet_program_id',
        'confidence_score',
        'is_selected',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function dietPrediction()
    {
        return $this->belongsTo(DietPrediction::class);
    }

    public function dietProgram()
    {
        return $this->belongsTo(DietProgram::class);
    }
}
