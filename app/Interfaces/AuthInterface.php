<?php
namespace App\Interfaces;

interface AuthInterface {
    public function sendOtp($data);
    public function verifyOtp($data);
    public function register($data);

}