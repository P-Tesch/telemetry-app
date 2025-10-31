<?php

namespace App\Views;

use Attribute;

#[Attribute()]
class HttpMethod {
    public const int GET = "Get";
    public const int POST = "Post";
}
