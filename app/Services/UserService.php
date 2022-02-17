<?php

namespace App\Services;

use App\Models\User;
use App\Traits\FilterTrait;
use App\Traits\PaginationTrait;
use App\Traits\SortTrait;
use DB;

class UserService
{
    use FilterTrait, SortTrait, PaginationTrait;

    private $userObj;
    
    public function __construct(User $userObj)
    {
        $this->userObj = $userObj;
    }

    public function resource($id)
    {
        $user = $this->userObj->findOrFail($id);
        return $user;
    }

    public function collection($inputs)
    {
        $inputs = $this->paginationAttribute($inputs);
        $query = $this->userObj;

        if(isset($inputs['search'])) {
            $query = $query->search($inputs['search']);
        }

        $query = $this->filterInput($query, $inputs);
        $query = $this->sortInput($query, $inputs);
        $query = $query->paginate($inputs['limit'], ['*'], 'users', $inputs['page']);

        return $query;
    }

    public function store($inputs)
    {
        $user = $this->userObj->create($inputs);
        return $user;
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
