<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Services\UserService;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class EditUserMutation extends Mutation
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    
    protected $attributes = [
        'name' => 'Edit User',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('user');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
                'rules' => ['required'],
            ],
            'input' => [
                'type' => GraphQL::Type('userInput'),
                'rules' => ['required'],
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {   
        $args['input']['id'] = $args['id'];
        $user = $this->userService->update($args['input']);
        return $user;
    }
}
