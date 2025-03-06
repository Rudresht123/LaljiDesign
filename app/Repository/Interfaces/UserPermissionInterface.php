<?php

namespace App\Repository\Interfaces;

use App\Models\UserPermissionModel;

interface UserPermissionInterface
{
    public function getAtteorneys();
    public function getCategorys();
}
