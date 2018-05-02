<?php
/**
 * Created by PhpStorm.
 * User: wilder13
 * Date: 19/04/18
 * Time: 15:26
 */

namespace Structures;


class Session
{
    public function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return null;
        }
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function unset($key)
    {
        unset($_SESSION[$key]);
    }
}