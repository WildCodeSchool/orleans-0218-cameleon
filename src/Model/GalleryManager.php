<?php
/**
 * Created by PhpStorm.
 * User: wilder22
 * Date: 05/04/18
 * Time: 11:18
 */

namespace Model;

class GalleryManager extends AbstractManager
{
    private const TABLE = "gallery";

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
