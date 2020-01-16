<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'price', 'address', 'neighborhood', 'city', 'state', 'postcode', 'user_id', 'lat', 'lng'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'float',
        'postcode' => 'integer',
        'lat' => 'float',
        'lng' => 'float',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'positions',
    ];

    /**
     * Get the owner that owns the property.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the photos for the property.
     */
    public function photos()
    {
        return $this->hasMany(PropertyPhoto::class, 'property_id');
    }

    /**
     * Format the price for the property.
     *
     * @return string
     */
    public function getPriceAttribute($value)
    {
        return 'R$ ' . $value;
    }

    /**
     * Format the postcode for the property.
     *
     * @return string
     */
    public function getPostcodeAttribute($value)
    {
        return vsprintf('%s%s.%s%s%s-%s%s%s', $value);
    }

    /**
     * Clean format of the postcode for the property.
     *
     * @return string
     */
    public function setPostcodeAttribute($value)
    {
        return preg_replace('/[^0-9]/', '', $value);
    }

    /**
     * Format the price for the property.
     *
     * @return object
     */
    public function getPositionsAttribute()
    {
        return collect([
            'lat' => $this->lat,
            'lng' => $this->lng
        ]);
    }

    /**
     * Scope a query to only include owner.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOwned($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }
}
