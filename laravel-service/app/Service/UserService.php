<?php

namespace App\Services;

use App\Exceptions\EmailAlreadyExistsException;
use App\Models\User;
use App\Repository\Interface\UserRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(public   UserRepositoryInterface $users) {
    }

    public function list(): Collection
    {
        return $this->users->getAll();
    }

    public function find(int $id): ?User
    {
        return $this->users->findById($id);
    }

    public function register(array $data): User
    {
        if ($this->users->findByEmail($data['email'])) {
            throw new EmailAlreadyExistsException($data['email']);
        }

        return $this->users->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function update(User $id, array $data): User
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $this->users->update($id, $data);
    }

    public function delete(User $id): bool
    {
        return $this->users->delete($id);
    }
}