<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'name',
        'profession',
        'position',
        'technology',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true
            ]
        ];
    }

    public function getGetNameAttribute()
    {
        return strtoupper($this->name);
    }

    public function getGetProfessionAttribute()
    {
        return ucfirst($this->profession);
    }
}
