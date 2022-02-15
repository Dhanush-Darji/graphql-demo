<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\User;
use App\Services\UserService;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UsersQuery extends Query
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
        return GraphQL::type('user');
    }

    public function args(): array
    {
        return [
            'paginate' => [
                'name' => 'paginate',
                'type' => Type::string(),
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $users = $this->userService->collection($args);
        return $users;
    }
}
