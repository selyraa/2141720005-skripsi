<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DietPrediction extends Model
{
    use SoftDeletes;

    protected $table = 'diet_predictions';

    protected $fillable = [
        'checkup_id',
        'prediction_date',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function checkup()
    {
        return $this->belongsTo(Checkup::class);
    }
    public function predictionResults()
    {
        return $this->hasMany(PredictionResult::class);
    }
}
