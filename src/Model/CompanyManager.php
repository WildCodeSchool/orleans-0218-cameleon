<?php
//created by damien with brice help

namespace Model;

class CompanyManager extends AbstractManager
{
    const TABLE = 'company';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}