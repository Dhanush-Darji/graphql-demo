<?php

namespace App\GraphQL\Input;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class UserSort extends InputType
{
    protected $attributes = [
        'name' => 'UserSort',
        'description' => 'An example input',
    ];

    public function fields(): array
    {
        return [
            'by' => [
                'type' => Type::string(),
                'description' => 'sort by',
            ],
            'order' => [
                'type' => Type::string(),
                'description' => 'sort order',
            ],
        ];
    }
}
