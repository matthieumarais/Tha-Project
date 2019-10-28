<?php

namespace App\Products;

use App\Connexion\AbstractManager;

class Products extends AbstractManager
{


    /**
     *
     */
    const TABLE = 'products';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    public function selectColors(int $idProduct)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM colors WHERE c_id_product=:id");
        $statement->bindValue('id', $idProduct, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function selectSizes(int $idProduct)
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM sizes WHERE s_id_product=:id");
        $statement->bindValue('id', $idProduct, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function getImages(string $idProduct): array
    {
        $path = dirname(__DIR__, 2) . "/assets/img/img_" . $idProduct . "_*";
        return glob($path) ;
    }

    public function calcPrice(int $qty, float $unitPrice)
    {
        return $qty * $unitPrice;
    }

    public function sumAllPrices(array $allItems)
    {
        $total = 0;
        $test = 0;
        foreach ($allItems as $items) {
            foreach ($items as $item) {
            $price = $this->selectOneById($item['id']);
            if($item['id'] == 99 && $item['quantity'] > 9){
                $priceItem = $this->calcPrice($item['quantity'], $price['p_price_3']); 
            }elseif($item['id'] == 99 && ($item['quantity'] > 3 && $item['quantity'] <= 9)){
                $priceItem = $this->calcPrice($item['quantity'], $price['p_price_2']); 
            }else{
                $priceItem = $this->calcPrice($item['quantity'], $price['p_price']); 
            }
            
            
            $total+= $priceItem;
            }
        }       
        return $total;
    }

    public function getGoodPrice(array $item): string
    {
        if($item['id'] == 99 && $item['quantity'] > 9){
            return 'p_price_3';
        }elseif($item['id'] == 99 && ($item['quantity'] > 3 && $item['quantity'] <= 9)){
            return 'p_price_2';
        }else{
            return 'p_price';
        }
    }

}
