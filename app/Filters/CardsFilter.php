<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class CardsFilter
 *
 * @package App\Filters
 */
class CardsFilter extends QueryFilters
{
    /**
     * Do filter by name
     *
     * @param string $name
     *
     * @return Builder
     */
    public function name($name = "")
    {
        if($name){
            return $this->builder
                ->where('name', 'like', '%' . $name . '%');
        }
        return $this->builder;
    }

}
