<?php

declare(strict_types=1);

namespace App\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class UserSortInput extends InputType
{
    protected $attributes = [
        'name' => 'UserSortInput',
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
