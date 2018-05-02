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
use Model\AlertManager;
use Model\SliderManager;
use Structures\Notification;
use Structures\Upload;
use Structures\Session;

/**
 * Class ItemController
 *
 */
class HeaderAdminController extends AbstractController
{
    /**
     * Display item listing
     * @return string
     */
    public function index()
    {
        $notification = (new notification())->getNotification('notification');
        $alertManager = new AlertManager();
        $alert = $alertManager->selectFirst();
        $sliderManager = new SliderManager();
        $slider = $sliderManager->selectAll();
        return $this->twig->render('admin/header.html.twig',
            ['alert' => $alert, 'slider' => $slider, 'notification' => $notification]);
    }

    public function editAlert()
    {
        $alertManager = new AlertManager();
        if (!empty($_POST)) {
            $message = trim($_POST['alert']);
            $activated = isset($_POST['activated']);
            $notification = new Notification();
            $notification->setNotification('success', 'L\'enregistrement s\'est bien déroulé');
            try {
                if (strlen($message) > 100) {
                    throw new \Exception('Le message ne doit pas dépasser 100 caractères.');
                }
                $alert = $alertManager->selectFirst();
                $alertManager->update($alert->getId(), [
                    'alert' => $message,
                    'activated' => $activated
                ]);
            } catch (\Exception $e) {
                $notification->setNotification('danger', $e->getMessage());
            }
        }
        header('location:/admin/header');
        exit();
    }

    public function addImage()
    {
        $sliderManager = new SliderManager();
        if (!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                $cleanPost[$key] = trim($value);
            }
            $notification = new Notification();
            $upload = new Upload('upload/slider');
            $path = $upload->add($_FILES['picture']);
            if ($path) {
                $notification->setNotification('success', 'L\'enregistrement s\'est bien déroulé');
                $sliderManager->insert([
                    'picture' => $path,
                    'alt' => $cleanPost['alt']
                ]);
            }
        }
        header('location:/admin/header');
        exit();
    }

    public function deleteImage()
    {
        $sliderManager = new SliderManager();
        $upload = new Upload('upload/slider');
        if (!empty($_POST)) {
            $notification = new Notification();
            $notification->setNotification('success', 'L\'enregistrement s\'est bien déroulé');
            try {
                $upload->delete($_POST['path']);
                $sliderManager->delete($_POST['id']);

            } catch (\Exception $e) {
                $notification->setNotification('danger', $e->getMessage());
            }
        }
        header('location:/admin/header');
        exit();
    }

}
