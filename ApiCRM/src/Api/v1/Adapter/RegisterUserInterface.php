<?php

namespace App\Api\v1\Adapter;

interface RegisterUserInterface
{
    public function register(string $json_data): bool;
}