<?php

function paginator($collection, $page = 1, $per_page = 10) {
    $page = $page ?: (\Illuminate\Pagination\Paginator::resolveCurrentPage() ?: 1);
    
    $collection = $collection instanceof \Illuminate\Support\Collection 
                    ? $collection : \Illuminate\Support\Collection::make($collection);

    $collection = new \Illuminate\Pagination\LengthAwarePaginator(
        $collection->forPage($page, $per_page), 
        $collection->count(), 
        $per_page, 
        $page, 
        []
    );
    
    return $collection;
}