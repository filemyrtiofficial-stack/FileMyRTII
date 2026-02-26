<?php
namespace App\Interfaces;

interface ServiceInterface {
    public function store($data);
    public function update($data, $id);
    public function delete($id);
    public function deleteSection($id);
    public function assignLawyer($id, $data);
    public function storeTemplate($data, $service_id);
    public function updateTemplate($data, $id);
    public function storeFields($request, $service_id);

    public function deleteRTI($id);



}