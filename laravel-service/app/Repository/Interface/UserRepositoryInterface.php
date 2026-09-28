<?php 

namespace App\Repository\Interface;

interface UserRepositoryInterface
{
    public function getAll();
    public function create(array $data);
    public function findById(int $id);
    public function findByEmail(string $email);
    public function update( $id, array $data);
    public function delete( $id);
}