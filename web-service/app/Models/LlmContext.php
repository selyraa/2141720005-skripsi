<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LlmContext extends Model
{
    use SoftDeletes;

    protected $table = 'llm_contexts';

    protected $fillable = [
        'title',
        'context',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function dietRecommendations()
    {
        return $this->hasMany(DietRecommendation::class);
    }
}
