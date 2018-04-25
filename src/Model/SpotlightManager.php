<?php

namespace Model;

class SpotlightManager extends AbstractManager
{
    const TABLE = 'spotlight';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}