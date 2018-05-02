<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace Controller;

use Model\PlaceManager;

/**
 * Class ItemController
 *
 */
class PlaceController extends AbstractController
{
    /**
     * Display item listing
     * @return string
     */
    public function index()
    {
        $placeManager = new PlaceManager();
        $places = $placeManager->selectAll();

        return $this->twig->render('place/list.html.twig', ['places' => $places]);
    }
}
