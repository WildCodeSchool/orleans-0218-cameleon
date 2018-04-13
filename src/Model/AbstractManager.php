<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 20:52
 * PHP version 7
 */

namespace Model;

use App\Connection;

/**
 * Abstract class handling default manager.
 */
abstract class AbstractManager
{
    protected $pdoConnection; //variable de connexion

    protected $table;
    protected $className;

    /**
     *  Initializes Manager Abstract class.
     *
     * @param string $table Table name of current model
     */
    public function __construct(string $table)
    {
        $connexion = new Connection();
        $this->pdoConnection = $connexion->getPdoConnection();
        $this->table = $table;
        $this->className = __NAMESPACE__ . '\\' . ucfirst($table);
    }

    /**
     * Get all row from database.
     *
     * @return array
     */
    public function selectAll(): array
    {
        return $this->pdoConnection->query('SELECT * FROM ' . $this->table, \PDO::FETCH_CLASS, $this->className)->fetchAll();
    }

    /**
     * Get one row from database by ID.
     *
     * @param  int $id
     *
     * @return array
     */
    public function selectOneById(int $id)
    {
        // prepared request
        $statement = $this->pdoConnection->prepare("SELECT * FROM $this->table WHERE id=:id");
        $statement->setFetchMode(\PDO::FETCH_CLASS, $this->className);
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    /**
     * DELETE on row in dataase by ID
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        //TODO : Implements SQL DELETE request
    }


    /**
     * INSERT one row in dataase
     *
     * @param Array $data
     */
    public function insert(array $data)
    {
        //TODO : Implements SQL INSERT request
    }


    /**
     * @param array $id
     *    un tableau avec le nom de l'id en clé et l'id en valeur
     * @param array $data
     *    un tableau avec la colone en clé et la valeur en valeur
     */
    public function update(array $id, array $data)
    {
        $query = "UPDATE $this->table SET ";
        foreach($data as $key=>$value){
            $query .= $key . "=:" . $key . ", ";
        }
        $query = substr($query,0, strlen($query)-2); // on retire la virgule moche
        $query .= " WHERE " . key($id) . "=:id";

        $statement = $this->pdoConnection->prepare($query);
        $statement->bindValue('id', $id[key($id)]);
        foreach($data as $key=>$value){
            $statement->bindValue($key, $value);
        }
        $statement->execute();
    }


    /**
     * Get first row from database.
     *
     * @return array
     */
    public function selectFirst()
    {
        return $this->pdoConnection->query('SELECT * FROM ' . $this->table . ' LIMIT 1 ', \PDO::FETCH_CLASS, $this->className)->fetch();
    }
}
