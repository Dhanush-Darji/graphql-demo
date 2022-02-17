<?php

declare(strict_types=1);

namespace App\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class UserFilterInput extends InputType
{
    protected $attributes = [
        'name' => 'UserFilterInput',
    ];

    public function fields(): array
    {
        return [
            'name' => [
                'type' => Type::string(),
                'description' => 'name',
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'email',
            ],
        ];
    }
}
