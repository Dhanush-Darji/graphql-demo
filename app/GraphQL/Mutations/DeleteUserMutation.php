<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Exceptions\InvalidException;
use App\Models\User;
use App\Services\UserService;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class DeleteUserMutation extends Mutation
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
        return Type::string();
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::id()),
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $user = $this->userService->delete($args['id']);
        return $user;
    }
}
