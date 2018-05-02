<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace Controller;


/**
 * Class ItemController
 */
use Model\CompanyManager;
use Model\SpotlightManager;
use Model\TeamManager;
use Model\PictureManager;
use Model\AlertManager;
use Model\SliderManager;


class MainController extends AbstractController
{
    /**
     * Display item listing
     *
     * @return string
     */

    public function index()

    {
        $companyManager = new CompanyManager();
        $company = $companyManager->selectFirst();
        $spotlightManager = new SpotlightManager();
        $spotlight = $spotlightManager->selectFirst();
        $teamManager = new TeamManager();
        $team = $teamManager->selectAll();
        $pictureManager = new PictureManager();
        $pictures = $pictureManager->selectLimitDesc(6);
        $alertManager = new AlertManager();
        $alert = $alertManager->selectFirst();
        $sliderManager = new SliderManager();
        $slider = $sliderManager->selectAll();
        return $this->twig->render('main/index.html.twig', [
                'alert' => $alert,
                'slider' => $slider,
                'team' => $team,
                'company' => $company,
                'spotlight' => $spotlight,
                'team' => $team,
                'pictures' => $pictures,
            ]
        );
    }
}
