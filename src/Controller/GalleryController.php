<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace Controller;

use Model\GalleryManager;

/**
 * Class GalleryController
 * @package Controller
 */
class GalleryController extends AbstractController
{
    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index()
    {
        $galleryManager = new GalleryManager();
        $gallery = $galleryManager->selectAll();
        return $this->twig->render('gallery/gallery.html.twig', ['gallery'=>$gallery]);
    }
}