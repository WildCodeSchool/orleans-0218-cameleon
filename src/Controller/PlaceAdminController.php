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
use Structures\Notification;

/**
 * Class ItemController
 *
 */
class PlaceAdminController extends AbstractController
{
    /**
     * Display item listing
     * @return string
     */
    public function index()
    {
        $notification = (new notification())->getNotification('notification');
        $placeManager = new PlaceManager();
        $infos = $placeManager->selectAll();
        return $this->twig->render('admin/place.html.twig',
            ['places' => $infos, 'notification' => $notification]);
    }

    public function edit()
    {
        if (!empty($_POST)) {

            foreach ($_POST as $key => $value) {
                $cleanPost[$key] = trim($value);
            }
            $placeManager = new PlaceManager();
            $notification = new Notification();
            $notification->setNotification('success', 'L\'enregistrement s\'est bien déroulé');
            try {
                if ((preg_match('/-?[0-9]+.[0-9]+,\s?-?[0-9]+.[0-9]+/', $cleanPost['coord-12'])
                        || $cleanPost['coord-12'] == null) &&
                    (preg_match('/-?[0-9]+.[0-9]+,\s?-?[0-9]+.[0-9]+/', $cleanPost['coord-19'])
                        || $cleanPost['coord-19'] == null)) {
                    $placeManager->update($cleanPost['id'], [
                        'adress_day' => $cleanPost['adress-12'],
                        'coord_day' => $cleanPost['coord-12'],
                        'adress_evening' => $cleanPost['adress-19'],
                        'coord_evening' => $cleanPost['coord-19'],
                    ]);
                } else {
                    throw new \Exception('Les coordonnées en sont pas valides.');
                }
            } catch (\Exception $e) {
                $notification->setNotification('danger', $e->getMessage());
            }
        }
        header('location:/admin/place');
        exit();
    }
}
