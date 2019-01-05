<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    /**
     * Get the comments for the blog post.
     */
    public function vaccinations()
    {
        return $this->hasMany('App\Vaccination');
    }
}
