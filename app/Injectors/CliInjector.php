<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

namespace App\Injectors;

class CliInjector extends Injector
{
    public function inject()
    {
        return $this->di;
    }

}
