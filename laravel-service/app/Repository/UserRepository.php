<?php 

namespace App\Repository;

use App\Models\User;
use App\Repository\Interface\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    public function __construct(public User $model)
    {
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function findById(int $id)
    {
        return $this->model->find($id);
    }

    public function findByEmail(string $email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function update($id , array $data)
    {
        $user = $this->findById($id);
        if ($user) {
            $user->update($data);
            return $user;
        }
        return null;
    }

    public function delete( $id)
    {
        $user = $this->findById($id);
        if ($user) {
            return $user->delete();
        }
        return false;
    }
}