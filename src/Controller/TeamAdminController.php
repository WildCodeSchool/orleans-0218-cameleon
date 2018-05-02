<?php
/**
 * Created by PhpStorm.
 * User: ziadoof
 * Date: 19/04/18
 * Time: 16:15
 */

namespace Controller;

use Model\TeamManager;
use Structures\Notification;
use Structures\Session;
use Structures\Upload;


class TeamAdminController extends AbstractController
{/**
 * Display item listing
 * @return string
 */
    public function index()
    {
        $teamManager = new TeamManager();
        $infos = $teamManager->selectWithLimit(0,2);
        $notification = (new notification())->getNotification('notification');
        return $this->twig->render('admin/team.html.twig', ['teams'=>$infos,'notification'=>$notification]);
    }
    public function edit()
    {
        $teamManager = new TeamManager();
        $notification = new Notification();
        $directory ='team';
        if (!empty($_POST))
        {
                foreach ($_POST as $key => $value)
                {
                        $cleanPost[$key] = trim($value);
                }
                try
                {
                    if (empty($cleanPost['name'])||empty($cleanPost['description']))
                    {
                        throw new \Exception('Certains champs ne peuvent pas être vides');
                    }
                    $teamManager->update($cleanPost['id'], $cleanPost);
                    $notification->setNotification('success', 'L\'enregistrement s\'enregistré avec succès');
                }
                catch (\Exception $e)
                {
                    $notification->setNotification('danger', $e->getMessage());
                }
                if ($_FILES['picture']['error'] == 0)
                {
                    $upload = new Upload($directory);
                    $photo='/'.$upload->add($_FILES['picture']);
                    $teamManager->update($cleanPost['id'], ['picture' => $photo]);
                }
             }
        else
        {
            $notification->setNotification('danger', 'Les coordonnées ne sont pas valides');
        }
        header('location:/admin/team');
        exit();
    }
}