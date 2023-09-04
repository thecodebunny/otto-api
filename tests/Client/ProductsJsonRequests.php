<?php

namespace Thecodebunny\OttoApi\Test\Client;

final class ProductsJsonRequests
{
    const POST_ACTIVE_STATUS = <<<EOD
    {"status":[{"sku":"123363682","active":true},{"sku":"123363682-1","active":true}]}
    EOD;
}
