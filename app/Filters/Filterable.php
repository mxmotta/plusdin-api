<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class Filterable
 * @package App\Filters
 */
trait Filterable
{
    /**
     * @param Builder $query
     * @param QueryFilters $filters
     * @return Builder
     */
    public function scopeFilter($query, QueryFilters $filters) {

        return $filters->apply($query);
    }
}
