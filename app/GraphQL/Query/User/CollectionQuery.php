<?php

declare(strict_types=1);

namespace App\GraphQL\Query\User;

use App\Models\User;
use App\Services\UserService;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class CollectionQuery extends Query
{
    private $userService;

    public function __construct(UserService $userService)
    {   
        $this->userService = $userService;
    }
    
    protected $attributes = [
        'name' => 'users',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        return GraphQL::paginate('user');
    }

    public function args(): array
    {
        return [
            'search' => [
                'name' => 'search',
                'type' => Type::string()
            ],
            'filters' => [
                'name' => 'filters',
                'type' => GraphQL::type('userFilter')
            ],
            'page' => [
                'name' => 'page',
                'type' => Type::int(),
                'rules' => ['required']
            ],
            'limit' => [
                'name' => 'limit',
                'type' => Type::int(),
                'rules' => ['required']
            ],
            'sort' => [
                'name' => 'sort',
                'type' => GraphQL::type('userSort')
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $users = $this->userService->collection($args);
        return $users;
    }
}
