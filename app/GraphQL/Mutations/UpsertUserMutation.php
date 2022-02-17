<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Services\UserService;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpsertUserMutation extends Mutation
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    
    protected $attributes = [
        'name' => 'Upsert User',
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
            ],
            'input' => [
                'type' => GraphQL::Type('userInput'),
                'rules' => ['required'],
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {   
        if(isset($args['id'])) {
            data_fill($args, 'input.id', $args['id']);
        }

        $user = (isset($args['id']))
                ? $this->userService->update($args['input'])
                : $this->userService->store($args['input']);
                
        return $user;
    }
}
