<?php

namespace App\Connexion;

use App\Connexion\Connexion;

/**
 * Abstract class handling default manager.
 */
abstract class AbstractManager
{
    /**
     * @var \PDO
     */
    protected $pdo; //variable de connexion

    /**
     * @var string
     */
    protected $table;
    /**
     * @var string
     */


    /**
     * Initializes Manager Abstract class.
     * @param string $table
     * @param \PDO $pdo
     */
    public function __construct(string $table)
    {
        $this->table = $table;
        //$this->className = __NAMESPACE__ . '\\' . ucfirst($table);
        $this->pdo = (new Connexion())->getPdoConnexion();
    }

    /**
     * Get all row from database.
     *
     * @return array
     */
    public function selectAll(string $items): array
    {
        return $this->pdo->query('SELECT ' . $items . ' FROM ' . $this->table . ' WHERE id != 99')->fetchAll();
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
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

}
