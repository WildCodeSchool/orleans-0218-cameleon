<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace Controller;

use Model\Item;
use Model\ItemManager;

/**
 * Class ItemController
 *
 */
class MainController extends AbstractController
{

    /**
     * Display item listing
     *
     * @return string
     */
    public function index()
    {
        return $this->twig->render('user/mainpage.html.twig');
    }
}
