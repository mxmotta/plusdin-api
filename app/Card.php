<?php

namespace App;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    
    /**
     * Make model filterable
     *
     * @see App\Filterable
     */
    use Filterable;
    
    /**
     * Soft Delete
     */
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'limit',
        'annual_fee',
        'brand',
        'category_id'
    ];

    /**
     * Get the category for the card.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

}
