<?php

namespace App\GraphQL\Mutations;

use App\Services\AuthService;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

use function PHPSTORM_META\type;

class LoginMutation extends Mutation
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    protected $attributes = [
        'name' => 'loginMutation',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::Type('user');
    }

    public function args(): array
    {
        return [
            'input' => [
                'type' => GraphQL::Type('loginInput'),
                'rules' => ['required'],
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $user = $this->authService->login($args['input']);
        return $user;
    }
}
