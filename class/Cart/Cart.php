<?php

namespace App\Cart;


class Cart
{
    /**
     * An unique ID for the cart.
     *
     * @var string
     */
    protected $cartId;

    /**
     * Maximum item allowed in the cart.
     *
     * @var int
     */
    protected $cartMaxItem = 0;

    /**
     * Maximum quantity of a item allowed in the cart.
     *
     * @var int
     */
    protected $itemMaxQuantity = 0;

    /**
     * Enable or disable cookie.
     *
     * @var bool
     */
    protected $useCookie = true;

    /**
     * A collection of cart items.
     *
     * @var array
     */
    private $items = [];

    /* private $delivery;*/



    /**
     * Initialize cart.
     *
     * @param array $options
     */
    public function __construct($options = [])
    {
        if (!session_id()) {
            session_start();
        }

        if (isset($options['cartMaxItem']) && preg_match('/^\d+$/', $options['cartMaxItem'])) {
            $this->cartMaxItem = $options['cartMaxItem'];
        }

        if (isset($options['itemMaxQuantity']) && preg_match('/^\d+$/', $options['itemMaxQuantity'])) {
            $this->itemMaxQuantity = $options['itemMaxQuantity'];
        }

        if (isset($options['useCookie']) && $options['useCookie']) {
            $this->useCookie = true;
        }

        $this->cartId = md5((isset($_SERVER['HTTP_HOST'])) ? $_SERVER['HTTP_HOST'] : 'SimpleCart') . '_cart';

        $this->read();

    }

    /**
     * Get items in cart.
     *
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }


    public function getQtyOfItem($id)
    {
        if (isset($this->items[$id])) {
            return $this->items[$id][0]["quantity"];
        }
    }

    public function getIdCart()
    {
        return explode('_cart', $this->cartId)[0];
    }

    /**
     * Check if the cart is empty.
     *
     * @return bool
     */
    public function isEmpty()
    {
        return empty(array_filter($this->items));
    }

    /**
     * Get the total of item in cart.
     *
     * @return int
     */
    public function getTotalItem()
    {
        $total = 0;

        foreach ($this->items as $items) {
            foreach ($items as $item) {
                ++$total;
            }
        }

        return $total;
    }

    /**
     * Get the total of item quantity in cart.
     *
     * @return int
     */
    public function getTotalQuantity()
    {
        $quantity = 0;

        foreach ($this->items as $items) {
            foreach ($items as $item) {
                $quantity += $item['quantity'];
            }
        }

        return $quantity;
    }


    /**
     * Remove all items from cart.
     */
    public function clear()
    {
        $this->items = [];
        $this->write();
    }

    /**
     * Check if a item exist in cart.
     *
     * @param string $id
     * @param array  $attributes
     *
     * @return bool
     */
    public function isItemExists($id, $attributes = [])
    {
        $attributes = (is_array($attributes)) ? array_filter($attributes) : [$attributes];

        if (isset($this->items[$id])) {
            $hash = md5(json_encode($attributes));
            foreach ($this->items[$id] as $item) {
                if ($item['hash'] == $hash) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Add item to cart.
     *
     * @param string $id
     * @param int    $quantity
     * @param array  $attributes
     *
     * @return bool
     */
    public function add($id, $quantity = 1, $attributes = [])
    {
        $quantity = (preg_match('/^\d+$/', $quantity)) ? $quantity : 1;
        $attributes = (is_array($attributes)) ? array_filter($attributes) : [$attributes];
        $hash = md5(json_encode($attributes));

        if (count($this->items) >= $this->cartMaxItem && $this->cartMaxItem != 0) {
            return false;
        }

        if (isset($this->items[$id])) {
            foreach ($this->items[$id] as $index => $item) {
                if ($item['hash'] == $hash) {
                    $this->items[$id][$index]['quantity'] += $quantity;
                    $this->items[$id][$index]['quantity'] = ($this->itemMaxQuantity < $this->items[$id][$index]['quantity'] && $this->itemMaxQuantity != 0) ? $this->itemMaxQuantity : $this->items[$id][$index]['quantity'];

                    $this->write();

                    return true;
                }
            }
        }

        $this->items[$id][] = [
            'id' => $id,
            'quantity' => ($quantity > $this->itemMaxQuantity && $this->itemMaxQuantity != 0) ? $this->itemMaxQuantity : $quantity,
            'hash' => $hash,
            'attributes' => $attributes,
        ];

        $this->write();

        return true;
    }

    /**
     * Update item quantity.
     *
     * @param string $id
     * @param int    $quantity
     * @param array  $attributes
     *
     * @return bool
     */
    public function update($id, $quantity = 1, $attributes = [])
    {
        $quantity = (preg_match('/^\d+$/', $quantity)) ? $quantity : 1;

        if ($quantity == 0) {
            $this->remove($id, $attributes);

            return true;
        }

        if (isset($this->items[$id])) {
            $hash = md5(json_encode(array_filter($attributes)));

            foreach ($this->items[$id] as $index => $item) {
                if ($item['hash'] == $hash) {
                    $this->items[$id][$index]['quantity'] = $quantity;
                    $this->items[$id][$index]['quantity'] = ($this->itemMaxQuantity < $this->items[$id][$index]['quantity'] && $this->itemMaxQuantity != 0) ? $this->itemMaxQuantity : $this->items[$id][$index]['quantity'];

                    $this->write();

                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Remove item from cart.
     *
     * @param string $id
     * @param array  $attributes
     *
     * @return bool
     */
    public function remove($id, $attributes = [])
    {
        if (!isset($this->items[$id])) {
            return false;
        }

        if (empty($attributes)) {
            unset($this->items[$id]);

            $this->write();

            return true;
        }
        $hash = md5(json_encode(array_filter($attributes)));

        foreach ($this->items[$id] as $index => $item) {
            if ($item['hash'] == $hash) {
                unset($this->items[$id][$index]);

                $this->write();

                return true;
            }
        }

        return false;
    }

    /**
     * Destroy cart session.
     */
    public function destroy()
    {
        $this->items = [];

        if ($this->useCookie) {
            setcookie($this->cartId, '', -1);
        } else {
            unset($_SESSION[$this->cartId]);
        }
    }

    /**
     * Read items from cart session.
     */
    private function read()
    {
        $this->items = ($this->useCookie) ? json_decode((isset($_COOKIE[$this->cartId])) ? $_COOKIE[$this->cartId] : '[]', true) : json_decode((isset($_SESSION[$this->cartId])) ? $_SESSION[$this->cartId] : '[]', true);
    }

    /**
     * Write changes into cart session.
     */
    private function write()
    {
        if ($this->useCookie) {
            setcookie($this->cartId, json_encode(array_filter($this->items)), time() + 604800, '/');
        } else {
            $_SESSION[$this->cartId] = json_encode(array_filter($this->items));
        }
    }

}