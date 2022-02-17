<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Illuminate\Pagination\LengthAwarePaginator;

class Pagination extends GraphQLType
{
    protected $attributes = [
        'name' => 'Pagination',
        'description' => 'Pagination Detail'
    ];

    public function fields(): array
    {
        return [
            'from' => [
                'type' => Type::int(),
                'description' => 'The first id of current result set',
                'resolve' => function (LengthAwarePaginator $root, $args) {
                    return $root->firstItem();
                }
            ],
            'to' => [
                'type' => Type::int(),
                'description' => 'The last id of current result set',
                'resolve' => function (LengthAwarePaginator $root, $args) {
                    return $root->lastItem();
                }
            ],
            'perPage' => [
                'alias' => 'per_page',
                'type' => Type::int(),
                'description' => 'Total number of object which returns per page',
                'resolve' => function (LengthAwarePaginator $root, $args) {
                    return $root->perPage();
                }
            ],
            'currentPage' => [
                'alias' => 'current_page',
                'type' => Type::int(),
                'description' => 'The current page of provided result',
                'resolve' => function (LengthAwarePaginator $root, $args) {
                    return $root->currentPage();
                }
            ],
            'lastPage' => [
                'alias' => 'last_page',
                'type' => Type::int(),
                'description' => 'The last page of provided result',
                'resolve' => function (LengthAwarePaginator $root, $args) {
                    return $root->lastPage();
                }
            ],
            'total' => [
                'type' => Type::int(),
                'description' => 'Total number of object',
                'resolve' => function (LengthAwarePaginator $root, $args) {
                    return $root->total();
                }
            ],
            'resultCount' => [
                'alias' => 'result_count',
                'type' => Type::int(),
                'description' => 'Total number of object for returned result',
                'resolve' => function (LengthAwarePaginator $root, $args) {
                    return $root->count();
                }
            ],
            'hasMorePages' => [
                'alias' => 'has_more_pages',
                'type' => Type::boolean(),
                'description' => 'Return the flag for checking whether the more pages are available or not',
                'resolve' => function (LengthAwarePaginator $root, $args) {
                    return $root->hasMorePages();
                }
            ]
        ];
    }
}
