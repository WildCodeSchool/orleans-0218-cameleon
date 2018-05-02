<?php
/**
 * Created by PhpStorm.
 * User: wilder13
 * Date: 19/04/18
 * Time: 10:57
 */

namespace Structures;


class Notification
{
    private $type;
    private $message;
    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

    public function getNotification()
    {
        $notification = $this->session->get('notification');
        $this->session->unset('notification');
        return $notification;
    }

    public function setNotification($type, $message)
    {
        $this->session->set('notification', ['type' => $type, 'message' => $message]);
    }
}