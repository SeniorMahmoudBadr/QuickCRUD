<?php

return [
    "list" => [
        "name" => "list",
        "controller_method" => "index",
        "route_type" => "get",
        "has_param" => 0,
    ],
    "show" => [
        "name" => "show",
        "controller_method" => "show",
        "route_type" => "get",
        "has_param" => 1,
    ],
    "create" => [
        "name" => "create",
        "controller_method" => "store",
        "route_type" => "post",
        "has_param" => 0,
    ],
    "edit" => [
        "name" => "edit",
        "controller_method" => "update",
        "route_type" => "put",
        "has_param" => 1,
    ],
    "delete" => [
        "name" => "delete",
        "controller_method" => "destroy",
        "route_type" => "delete",
        "has_param" => 1,
    ],
    "status" => [
        "name" => "status",
        "controller_method" => "status",
        "route_type" => "delete",
        "has_param" => 1,
    ],
    "bulk-status" => [
        "name" => "bulk status",
        "controller_method" => "statusBulk",
        "route_type" => "post",
        "has_param" => 0,
    ],
    "bulk-delete" => [
        "name" => "bulk delete",
        "controller_method" => "destroyBulk",
        "route_type" => "post",
        "has_param" => 0,
    ],
];
