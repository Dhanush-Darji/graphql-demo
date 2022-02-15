<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    private $userObj;
    public function __construct(User $userObj)
    {
        $this->userObj = $userObj;
    }

    public function resource($id, $inputs = null)
    {
        $user = $this->userObj->getQB()->findOrFail($id);
        return $user;
    }

    public function collection($args)
    {
        $paginate = isset($args['paginate']) ? $args['paginate'] : 10;

        if($paginate == -1) {
            $users = $this->userObj->get();
        } else {
            $users = $this->userObj->paginate($paginate);
        }
        return $users;
    }

    public function update($inputs)
    {
        $user = $this->resource($inputs['id']);
        $user->update($inputs);

        return $user;
    }

    public function delete($id)
    {
        $user = $this->resource($id);
        $delete = $user->delete();

        return $delete;
    }
}
