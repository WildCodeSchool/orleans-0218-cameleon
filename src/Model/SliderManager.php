<?php
/**
 * Created by PhpStorm.
 * User: louise
 * Date: 04/04/18
 * Time: 16:28
 */

namespace Model;

class SliderManager extends AbstractManager
{
    const TABLE = "slider";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}