<?php

namespace App\GraphQL\Type;

use App\Models\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'user',
        'model' => User::class,
    ];

    public function fields(): array
    {
        return [
            // 'id' => [
            //     'type' => Type::id(),
            //     'description' => 'id'
            // ],
            'name' => [
                'type' => Type::string(),
                'description' => 'user name'
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'user email'
            ],
            'password' => [
                'type' => Type::string(),
                'description' => 'user password',
            ],
            'token' => [
                'type' => Type::string(),
                'description' => 'token',
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'created_at'
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'updated_at'
            ],
        ];
    }
}
