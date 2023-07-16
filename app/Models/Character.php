<?php

namespace App\Models;

use App\Traits\Validates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @class Character
 *
 * @property int id_character
 * @property string name
 * @property string status
 * @property string species
 * @property string type
 * @property string gender
 *
 * @property Collection episodes
 */
class Character extends Model implements ValidatableModel
{
    use HasFactory, Validates;

    protected $primaryKey = 'id_character';

    protected $casts = [
        'name' => 'string',
        'status' => 'string',
        'species' => 'string',
        'type' => 'string',
        'gender' => 'string',
    ];

    protected $fillable = [
        'id_character',
        'name',
        'status',
        'species',
        'type',
        'gender'
    ];

    public function getValidationRules(): array
    {
        return [
            'name' => 'required|string',
            'status' => 'nullable|string',
            'species' => 'nullable|string',
            'type' => 'nullable|string',
            'gender' => 'nullable|string',
        ];
    }

    public function episodes()
    {
        return $this->belongsToMany(Episode::class, 'episode_has_characters', 'id_character', 'id_episode');
    }

}
