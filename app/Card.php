<?php

namespace App;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    
    /**
     * Make model filterable
     *
     * @see App\Filterable
     */
    use Filterable;

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
        return $this->hasOne('App\Category');
    }

}
