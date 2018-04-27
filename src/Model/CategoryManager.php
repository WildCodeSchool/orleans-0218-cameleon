<?php
/**
 * Created by PhpStorm.
 * User: louise
 * Date: 18/04/18
 * Time: 17:19
 */

namespace Model;


class CategoryManager extends AbstractManager
{
    const TABLE = 'category';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}
