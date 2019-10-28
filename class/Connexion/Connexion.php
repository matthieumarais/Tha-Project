<?php
/**
 * Database Connexion
 *
 * @link   http://fr3.php.net/manual/fr/book.pdo.php classe PDO
 */

namespace App\Connexion;

use \PDO;

/**
 *
 * This class only make a PDO object instanciation. Use it as below :
 *
 * <pre>
 *  $db = new Connexion();
 *  $conn = $db->getPdoConnexion();
 * </pre>
 */

//Affichage des erreurs
define('APP_DEV', true);

class Connexion
{

    /**
     * @var PDO
     *
     * @access private
     */
    private $pdoConnexion;


    private $APP_DB_USER = '****';
    private $APP_DB_PWD = '****';
    private $APP_DB_HOST = '****';
    private $APP_DB_NAME = '****';

    /**
     * Initialize Connexion
     *
     * @access public
     */
    public function __construct()
    {

               

        try {
            
                $this->pdoConnexion = new PDO(
                    'mysql:host=' . $this->APP_DB_HOST . '; dbname=' . $this->APP_DB_NAME . '; charset=utf8',
                    $this->APP_DB_USER,
                    $this->APP_DB_PWD
                );
            
            $this->pdoConnexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            // show errors in DEV environment
            if (APP_DEV) {
                $this->pdoConnexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        } catch (\PDOException $e) {
            die('<div class="error">Error !: ' . $e->getMessage() . '</div>');
        }
    }

    /**
     * @return $pdo
     */
    public function getPdoConnexion(): PDO
    {
        return $this->pdoConnexion;
    }
}
