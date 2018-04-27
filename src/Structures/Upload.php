<?php
/**
 * Created by PhpStorm.
 * User: wilder22
 * Date: 23/04/18
 * Time: 11:24
 */

namespace Structures;


class Upload
{
    private const MIME_AUTHORIZED = ['image/png', 'image/gif', 'image/jpeg'];
    private const MAX_SIZE = '1000000';

    private $directory;

    public function __construct(string $directory)
    {
        $this->setDirectory($directory);
    }

    /**
     * @param array $file
     */
    public function add(array $file)
    {
        $notification = new Notification();
        if (!in_array($file['type'], self::MIME_AUTHORIZED)) {
            $notification->setNotification('danger', 'Format de fichier non autorisé');
        } elseif (filesize($file['tmp_name']) > self::MAX_SIZE) {
            $notification->setNotification('danger', 'Taille du fichier supérieur à 1 Mo');
        } else {
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $filename = uniqid() . '.' . $extension;
            $filePath = "assets/images/" . $this->directory . $filename;
            move_uploaded_file($file['tmp_name'], '../public/' . $filePath);
            $notification->setNotification('success', 'Ajout de fichier réussi');
            return $filePath;
        }
    }

    /**
     * @param int $id
     */
    public function delete(string $path)
    {
        $notification = new Notification();
        if (file_exists($path)) {
            unlink('../public/' . $path);
            $notification->setNotification('success', 'Suppression du fichier réussi');
            return true;
        }
    }

    /**
     * @return string
     */
    public function getDirectory(): string
    {
        return $this->directory;
    }

    /**
     * @param string $directory
     */
    public function setDirectory(string $directory): void
    {
        $this->directory = $directory . '/';
    }

    /**
     * @return mixed
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * @param mixed $manager
     */
    public function setManager($manager): void
    {
        $this->manager = $manager;
    }
}