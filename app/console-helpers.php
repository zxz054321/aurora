<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

function console()
{
    static $climate = null;

    if (!$climate) {
        $climate = new League\CLImate\CLImate;
    }

    return $climate;
}