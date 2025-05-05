<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DietRecommendation extends Model
{
    use SoftDeletes;

    protected $table = 'diet_recommendations';

    protected $fillable = [
        'checkup_id',
        'llm_context_id',
        'prompt',
        'result',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function checkup()
    {
        return $this->belongsTo(Checkup::class);
    }

    public function llmContext()
    {
        return $this->belongsTo(LlmContext::class);
    }
}
