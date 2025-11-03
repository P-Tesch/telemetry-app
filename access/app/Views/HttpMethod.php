<?php

namespace App\Views;

use Attribute;

#[Attribute()]
class HttpMethod {
    public const string GET = "get";
    public const string POST = "post";
    public const string PUT = "put";
    public const string DELETE = "delete";
}
