<?php

declare(strict_types=1);

namespace App\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class RegisterInput extends InputType
{
    protected $attributes = [
        'name' => 'RegisterInput',
    ];

    public function fields(): array
    {
        return [
            'name' => [
                'name' => 'name', 
                'type' => Type::string(),
                'rules' => ['required', 'min:3']
            ],
            'email' => [
                'name' => 'email', 
                'type' => Type::string(),
                'rules' => ['required', 'email', 'unique:users,email']
            ],
            'password' => [
                'name' => 'password', 
                'type' => Type::string(),
                'rules' => ['required', 'min:6']
            ]
        ];
    }
}
