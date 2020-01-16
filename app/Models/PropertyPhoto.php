<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyPhoto extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'url', 'property_id' 
    ];

    /**
     * Get the post that owns the comment.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'property_id');
    }
}
