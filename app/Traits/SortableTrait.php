<?php

namespace App\Traits;

trait SortableTrait {
    public function scopeSortable($query) {
        if(\Request::has('s') && \Request::has('o'))
            return $query->orderBy(\Request::get('s'), \Request::get('o'));
        else
            return $query;
    }
 
    public static function link_to_sorting_action($col, $title = null) {
        if (is_null($title)) {
            $title = str_replace('_', ' ', $col);
            $title = ucfirst($title);
        }
 
        $indicator = (\Request::get('s') == $col ? (\Request::get('o') === 'asc' ? '&uarr;' : '&darr;') : null);
        $parameters = array_merge(\Request::get(), array('s' => $col, 'o' => (\Request::get('o') === 'asc' ? 'desc' : 'asc')));
        
        $url = \Request::url().'?'.urldecode(http_build_query($parameters, null, '&'));
        
        return link_to($url, "$title $indicator");
        
//         return link_to_route(\Route::currentRouteName(), "$title $indicator", $parameters);
    }
}