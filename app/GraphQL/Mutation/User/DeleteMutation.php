<?php

declare(strict_types=1);

namespace App\GraphQL\Mutation\User;

use App\Services\UserService;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class DeleteMutation extends Mutation
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    protected $attributes = [
        'name' => 'Delete User',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return Type::boolean();
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
                'rules' => ['required', 'exists:users,id']
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $user = $this->userService->delete($args['id']);
        return $user;
    }
}
