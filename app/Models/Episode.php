<?php

namespace App\Models;

use App\Traits\Validates;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @class Episode
 *
 * @property int id_episode
 * @property string name
 * @property Carbon air_date
 * @property string episode
 *
 * @property Collection characters
 */
class Episode extends Model implements ValidatableModel
{
    use HasFactory, Validates;

    protected $primaryKey = 'id_episode';

    protected $casts = [
        'name' => 'string',
        'air_date' => 'date',
        'episode' => 'string'
    ];

    protected $fillable = [
        'id_episode',
        'name',
        'air_date',
        'episode'
    ];

    /**
     * Returns validation rules for Model
     * @return array
     */
    public function getValidationRules(): array
    {
        return [
            'name' => 'required|string',
            'air_date' => 'required|date',
            'episode' => 'nullable|string'
        ];
    }

    public function characters()
    {
        return $this->belongsToMany(Character::class, 'episode_has_characters', 'id_episode', 'id_character');
    }
}
