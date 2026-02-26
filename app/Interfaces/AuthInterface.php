<?php
namespace App\Interfaces;

interface AuthInterface {
    public function store($data);
    public function update($data, $id);
    public function delete($id);
      public function updateProfile($data, $id);
         public function customerUpdate($data, $id);
             public function createUpdateTemplate($data, $id = null);


}