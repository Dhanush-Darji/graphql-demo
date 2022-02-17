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
                'rules' => function($inputArguments, $mutationArguments){
                    if (array_key_exists('id', $mutationArguments)) {
                        return ['nullable', 'min:3'];
                    } else {
                        return ['required', 'min:3'];
                    }
                }
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'user email',
                'rules' => function($inputArguments, $mutationArguments){
                    if (array_key_exists('id', $mutationArguments)) {
                        return ['nullable', 'unique:users,email,' . $mutationArguments['id']];
                    } else {
                        return ['required', 'unique:users,email'];
                    }
                }
            ],
            'password' => [
                'type' => Type::string(),
                'description' => 'user password',
                'rules' => function($inputArguments, $mutationArguments){
                    if (array_key_exists('id', $mutationArguments)) {
                        return ['nullable', 'min:5'];
                    } else {
                        return ['required', 'min:5'];
                    }
                }
            ],
        ];
    }
}
