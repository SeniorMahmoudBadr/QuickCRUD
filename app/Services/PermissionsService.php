<?php

namespace App\Services;

use Illuminate\Support\Collection;

class PermissionsService
{
    protected array $data;

    public function __construct()
    {
        $this->data = include app_path("Data" . DIRECTORY_SEPARATOR . "main_permissions.php");
    }

    public static function get(): Collection
    {
        $data = (new static())->data;
        return collect($data);
    }
}
