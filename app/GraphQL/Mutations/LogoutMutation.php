<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Services\AuthService;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class LogoutMutation extends Mutation
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    protected $attributes = [
        'name' => 'logout',
        'description' => 'Logout'
    ];

    public function type(): Type
    {
        return Type::boolean();
    }

    public function args(): array
    {
        return [
            // 
        ];
    }



    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {   
        return $this->authService->logout();
    }
}
