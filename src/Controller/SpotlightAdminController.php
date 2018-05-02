<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace Controller;

use http\Exception;
use Model\SpotlightManager;
use Structures\Notification;
use Structures\Session;
use Structures\Upload;

/**
 * Class ItemController
 *
 */
class SpotlightAdminController extends AbstractController
{
    /**
     * Display item listing
     * @return string
     */
    public function index()
    {
        $notification = (new notification())->getNotification('notification');
        $spotlightManager = new SpotlightManager();
        $spotlight = $spotlightManager->selectFirst();
        return $this->twig->render('admin/spotlight.html.twig',
            ['spotlight' => $spotlight, 'notification' => $notification]);
    }

    public function editSpotlight()
    {
        $spotlightManager = new spotlightManager();
        if (!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                $cleanPost[$key] = trim($value);
            }
            $notification = new Notification();
            $notification->setNotification('success', 'L\'enregistrement s\'est bien déroulé');
            try {
                $spotlight = $spotlightManager->selectFirst();
                if ($_FILES['photo']['error'] == 0) {
                    $upload = new Upload('upload/spotlight');
                    $upload->delete($spotlight->getPhoto());
                    $path = $upload->add($_FILES['photo']);
                } else {
                    $path = $spotlight->getPhoto();
                }
                $spotlightManager->update($cleanPost['id'], [
                    'text' => $cleanPost['text'],
                    'photo' => $path,
                    'alt' => $cleanPost['alt']]);

            } catch (\Exception $e) {
                $notification->setNotification('danger', $e->getMessage());
            }
        }
        header('location:/admin/spotlight');
        exit();
    }
}
