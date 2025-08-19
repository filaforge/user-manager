<?php

namespace Filaforge\ChatAi\Models;

use Illuminate\Database\Eloquent\Model;

class ModelProfile extends Model
{
    protected $table = 'chat_ai_model_profiles';

    protected $fillable = [
        'name','provider','model_id','base_url','api_key','stream','timeout','system_prompt','extra','per_minute_limit','per_day_limit','is_active'
    ];

    protected $casts = [
        'stream' => 'boolean',
        'is_active' => 'boolean',
        'extra' => 'array',
        'per_minute_limit' => 'integer',
        'per_day_limit' => 'integer',
    ];

    public function usages()
    {
        return $this->hasMany(ModelProfileUsage::class, 'model_profile_id');
    }

    protected static function booted()
    {
        static::deleting(function ($modelProfile) {
            // Clean up related usage records
            $modelProfile->usages()->delete();
        });

        static::saving(function (ModelProfile $modelProfile) {
            $apiKey = trim((string) ($modelProfile->api_key ?? ''));
            if ($apiKey === '') {
                $modelProfile->is_active = false;
            }
        });
    }
}
