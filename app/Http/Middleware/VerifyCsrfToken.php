<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        "student_assignment",
        "login",
        "courses",
        "student_answer",
        "register",
        "admin/user",
        "admin/user/update",
        "admin/user/reset_password",
        "admin/user/delete"

    ];
}
