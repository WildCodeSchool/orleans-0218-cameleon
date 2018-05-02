<?php
/**
 * Created by PhpStorm.
 * User: ziadoof
 * Date: 18/04/18
 * Time: 15:57
 */

namespace Controller;

use Model\TeamManager;

/**
 * Class TeamController
 *
 */
class TeamController extends AbstractController
{
    /**
     * Display item listing
     * @return string
     */
    public function index()
    {
        $teamManager = new TeamManager();
        $teams = $teamManager->selectAll();
        return $this->twig->render('admin/team.html.twig');
    }
}
