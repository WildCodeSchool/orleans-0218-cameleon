<?php
/**
 * Created by PhpStorm.
 * User: wilder22
 * Date: 03/04/18
 * Time: 15:11
 */

namespace Model;

class Team
{
    private $id;
    private $name;
    private $description;
    private $picture;
    private $picture_description;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param mixed $picture
     */
    public function setPicture($picture): void
    {
        $this->picture = $picture;
    }

    /**
     * @return mixed
     */
    public function getPictureDescription()
    {
        return $this->picture_description;
    }

    /**
     * @param mixed $picture_description
     */
    public function setPictureDescription($picture_description): void
    {
        $this->picture_description = $picture_description;
    }

}
