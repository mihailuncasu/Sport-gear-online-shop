<?php

class HomeModel extends Model {

    public function Index() {
        $this->query('SELECT * FROM products WHERE promo >= 40');
        $products = $this->resultSet();
        return [
            'products' => $products,
            'total' => count($products)
        ];
    }

}
