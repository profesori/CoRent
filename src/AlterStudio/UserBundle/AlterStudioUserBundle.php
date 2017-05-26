<?php

namespace AlterStudio\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AlterStudioUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
