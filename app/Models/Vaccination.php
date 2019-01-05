<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vaccine_name',
        'tag_number',
        'vaccine_given',
        'vaccine_due',
        'vaccine_notes',
    ];

    public function animal()
    {
        return $this->belongsTo('App\Animal');
    }
}
