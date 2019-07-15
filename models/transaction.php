<?php

class TransactionModel extends Model {

    public function createTransaction($product, $user) {
        $this->query('INSERT INTO transactions (id_user, id_product, quantity) VALUES(:id_user, :id_product, :quantity)');
        $this->bind(':id_user', $user['id']);
        $this->bind(':id_product', $product['id']);
        $this->bind(':quantity', $product['quantity']);
        $this->execute();
        if ($this->lastInsertId()) {
            return true;
        } else {
            return false;
        }
    }

}
