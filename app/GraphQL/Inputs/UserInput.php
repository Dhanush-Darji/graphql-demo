<?php

declare(strict_types=1);

namespace App\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class UserInput extends InputType
{
    protected $attributes = [
        'name' => 'UserInput',
    ];

    public function fields(): array
    {
        return [
            'name' => [
                'type' => Type::string(),
                'description' => 'user name',
                'rules' => ['required', 'min:3'],
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'user email',
                'rules' => ['required', 'email'],
            ],
            'password' => [
                'type' => Type::string(),
                'description' => 'user password',
            ],
        ];
    }
}
