<?php

namespace Easy\Bundle\VentesBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class EasyVentesBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
