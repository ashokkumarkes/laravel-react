<?php 
namespace App\Repositories\User;
interface UserInterface {
    public function getAll();
    public function find($id);
    public function delete($id);
    public function update();
    // public function login();
}