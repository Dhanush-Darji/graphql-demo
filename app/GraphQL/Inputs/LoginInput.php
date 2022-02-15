<?php

namespace App\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class LoginInput extends InputType
{
    protected $attributes = [
        'name' => 'LoginInput',
        'description' => 'An example input',
    ];

    public function fields(): array
    {
        return [
            'email' => [
                'name' => 'email',
                'type' => Type::string(),
                'rules' => ['required', 'email', 'exists:users,email']
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::string(),
                'rules' => ['required', 'min:6']
            ],
        ];
    }
}
