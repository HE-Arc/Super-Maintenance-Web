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
        "maintainer",
        "maintainer/*", 
        "maintainer_delete/*",
        
        "maintain",
        "maintain/*",
        "maintain_delete/*",

        "troubleshootingReport",
        "troubleshootingReport/*",
        "troubleshootingReport_delete/*",
        "machine/*"
    ];
}
