<?php
/**
 * Created by PhpStorm.
 * User: wilder22
 * Date: 18/04/18
 * Time: 10:17
 */

namespace Controller;

use Model\PictureManager;
use Structures\Upload;
use Structures\Notification;

class GalleryAdminController extends AbstractController
{
    public function index()
    {
        $notification = (new notification())->getNotification('notification');
        $pictureManager = new PictureManager();
        $pictures = $pictureManager->selectAll();
        return $this->twig->render('admin/gallery.html.twig',
            ['pictures' => $pictures, 'notification' => $notification]);
    }

    public function insert()
    {
        if (isset($_POST['submit'])) {
            $pictureManager = new PictureManager();
            $upload = new Upload('upload/gallery');
            $path = $upload->add($_FILES['file']);
            if ($path) {
                $pictureManager->insert(['path' => $path, 'alt' => $_POST['alt']]);
            }
        }
        header('Location:/admin/gallery');
        exit;
    }

    public function delete()
    {
        if (isset($_POST['id'])) {
            $pictureManager = new PictureManager();
            $upload = new Upload('upload/gallery');
            $upload->delete(($pictureManager->selectOneById($_POST['id']))->getPath());
            $pictureManager->delete($_POST['id']);
            header('Location:/admin/gallery');
            exit;
        }
    }
}