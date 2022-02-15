<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Services\AuthService;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;

class RegisterUserMutation extends Mutation
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    protected $attributes = [
        'name' => 'registerUser',
        'description' => 'Register User'
    ];

    public function type(): Type
    {
        return GraphQL::type('user');
    }

    public function args(): array
    {
        return [
            'input' => [
                'type' => GraphQL::Type('registerInput'),
                'rules' => ['required'],
            ]
        ];
    }


    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $user = $this->authService->signup($args['input']);
        return $user;
    }
}