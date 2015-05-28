<?php

/*
 * Repository Config
 */
return [
    /*
     * Repository Pagination Limit Default
     */
    'pagination' => [
        'limit' => 15,
    ],

    /*
     * Fractal Presenter Config
     */
    'fractal' => [
        'params' => [
            'include' => 'include',
        ],
    ],

    /*
     * Criteria Config
     */
    'criteria' => [
        'acceptedConditions' => [
            '=', 'like',
        ],
    ],
    /*
     * Request Params
     */
    'params' => [
        'search'        => 'search',
        'searchFields'  => 'searchFields',
        'filter'        => 'filter',
        'orderBy'       => 'orderBy',
        'sortedBy'      => 'sortedBy',
    ],
];
