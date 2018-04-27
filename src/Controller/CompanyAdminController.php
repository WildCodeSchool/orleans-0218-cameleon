<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace Controller;

use Model\CompanyManager;
use Structures\Notification;

/**
 * Class ItemController
 *
 */
class CompanyAdminController extends AbstractController
{
    /**
     * Display item listing
     * @return string
     */
    public function index()
    {
        $notification = (new notification())->getNotification('notification');
        $companyManager = new CompanyManager();
        $info = $companyManager->selectFirst();
        return $this->twig->render('admin/company.html.twig',
            ['company' => $info, 'notification' => $notification]);
    }

    public function edit()
    {
        $notification = new Notification();
        if (!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                $cleanPost[$key] = trim($value);
            }
            $companyManager = new CompanyManager();
            if (!preg_match('`^0[1-79]([-. ]?[0-9]{2}){4}$`', $cleanPost['phone'])) {
                $notification->setNotification('danger', 'Le numero de telephone n\'est pas valide');
            } elseif (filter_var($cleanPost['facebook'], FILTER_VALIDATE_URL) == false) {
                $notification->setNotification('danger', 'L\'URL de facebook n\'est pas valide');
            } elseif (filter_var($cleanPost['tweeter'], FILTER_VALIDATE_URL) == false) {
                $notification->setNotification('danger', 'L\URL de tweeter n\'est pas valide');
            } elseif (filter_var($cleanPost['instagram'], FILTER_VALIDATE_URL) == false) {
                $notification->setNotification('danger', 'L\'URL d\'instagram n\'est pas valide');
            } else {
                $companyManager->update($cleanPost['id'], [
                    'phone' => $cleanPost['phone'],
                    'facebook' => $cleanPost['facebook'],
                    'tweeter' => $cleanPost['tweeter'],
                    'instagram' => $cleanPost['instagram']
                ]);
            }
        }
        header('location:/admin/company');
        exit();
    }
}
