<?php
namespace App\Api\v1\Adapter;

interface ReadUserInformationInterface
{
    public function getUserInformation(object $token): array;
    public function getUserSitesInformation(object $token): array;

}