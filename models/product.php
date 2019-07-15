<?php

class ProductModel extends Model {

    public function index() {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // Get the filters
        $this->query("SELECT DISTINCT(brand) FROM products ORDER BY id DESC");
        $brands = $this->resultSet();
        $this->query("SELECT DISTINCT(category) FROM products ORDER BY id DESC");
        $categories = $this->resultSet();
        $this->query("SELECT DISTINCT(color) FROM products ORDER BY id DESC");
        $colors = $this->resultSet();
        $this->query("SELECT DISTINCT(gender) FROM products ORDER BY id DESC");
        $genders = $this->resultSet();
        // Get all the products;
        $this->query('SELECT * FROM products');
        $products = $this->resultSet();
        // Eventually filter the products;
        if (isset($post['filter'])) {
            Messages::setMsg('Filtering complete', 'success');
            if ($post['filter']) {
                $query = "SELECT * FROM products WHERE 1";
            }
            // Brands filter;
            if (isset($post['brand'])) {
                $query .= ' AND ';
                $brand_filters = [];
                foreach ($post['brand'] as $brand) {
                    array_push($brand_filters, "brand = '$brand'");
                }
                $query .= implode(' OR ', $brand_filters);
            }
            // Category filter;
            if (isset($post['category'])) {
                $query .= ' AND ';
                $category_filters = [];
                foreach ($post['category'] as $category) {
                    array_push($category_filters, "category = '$category'");
                }
                $query .= implode(' OR ', $category_filters);
            }
            // Color filter;
            if (isset($post['color'])) {
                $query .= ' AND ';
                $color_filters = [];
                foreach ($post['color'] as $color) {
                    array_push($color_filters, "color = '$color'");
                }
                $query .= implode(' OR ', $color_filters);
            }
            // Gender filter;
            if (isset($post['gender'])) {
                $query .= ' AND ';
                $gender_filters = [];
                foreach ($post['gender'] as $gender) {
                    array_push($gender_filters, "gender = '$gender'");
                }
                $query .= implode(' OR ', $gender_filters);
            }
            $this->query($query);
            $products = $this->resultSet();
        } elseif ($post['search']) {
            Messages::setMsg('Searching complete', 'success');
            $search = $post['search'];
            $this->query("SELECT * FROM products WHERE brand LIKE '%$search%' OR category LIKE '$search' OR color LIKE '$search' OR gender LIKE '$search'");
            $products = $this->resultSet();
        }
        return [
            'products' => $products,
            'brands' => $brands,
            'categories' => $categories,
            'colors' => $colors,
            'genders' => $genders
        ];
    }

    public function details() {
        // Sanitize the get;
        $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        $id = $get['id'];
        // Select the product;
        $this->query('SELECT * FROM products WHERE id = :id');
        $this->bind(':id', $id);
        $item = $this->single();
        // Check if the product exists;
        if ($item) {
            // Select some related items by category in order to generate some adds;
            $this->query('SELECT * FROM products WHERE category = :variabila');
            $this->bind(':variabila', $item['category']);
            $related_items = $this->resultSet();
            if ($related_items) {
                return [
                    'item' => $item,
                    'related_items' => $related_items
                ];
            } else {
                return $item;
            }
        } else {
            Messages::setMsg('No such product in our store', 'error');
            header('Location: ' . ROOT_URL);
            return;
        }
    }

    public function add() {
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $id = $post['id'];
        $quantity = $post['quantity'];

        $product = $this->findById($id);
        // Some checks;
        if (is_null($product)) {
            return [
                'code' => 'error',
                'msg' => 'The product dosen\'t exist',
                'data' => NULL
            ];
        }
        /* Check the stocks;
          if ($product['stock'] < $quantity) {
          return [
          'code' => 'error',
          'msg' => 'Stocks empty for this product',
          'data' => NULL
          ];
          } */
        // Check for existing shopping cart sessions or create a new one;
        if (isset($_SESSION['shopping_cart'])) {
            // Supposing that the session exists;
            $isNew = true;
            foreach ($_SESSION['shopping_cart'] as $key => $item) {
                if ($item['id'] == $product['id']) {
                    $_SESSION['shopping_cart'][$key]['quantity'] += $quantity;
                    $isNew = false;
                    return [
                        'code' => 'success',
                        'msg' => 'Added new quantity to the existing product',
                        'data' => NULL
                    ];
                }
            }
            // Supposing that the product is new in the cart;
            if ($isNew) {
                $numberOfProducts = count($_SESSION['shopping_cart']);
                // Setting the quantity for the shopping cart;
                $product['quantity'] = $quantity;
                $_SESSION['shopping_cart'][$numberOfProducts] = $product;
                return [
                    'code' => 'success',
                    'msg' => 'Added new product in the cart',
                    'data' => NULL
                ];
            }
        } else {
            // A new shopping cart session will be created;
            $product['quantity'] = $quantity;
            $_SESSION['shopping_cart'][0] = $product;
            return [
                'code' => 'success',
                'msg' => 'Created new shopping cart session. Added new product in the cart',
                'data' => NULL
            ];
        }
    }

    public function change() {
        // Filter the POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $id = $post['id'];
        $quantity = $post['quantity'];
        // Calculate the total;
        $total = 0;
        // Search for the specific product in the shopping cart session;
        foreach ($_SESSION['shopping_cart'] as $key => $item) {
            if ($item['id'] == $id) {
                if ($quantity) {
                    $_SESSION['shopping_cart'][$key]['quantity'] = $quantity;
                    $total += $quantity * ($item['price'] - $item['price'] * $item['promo'] / 100);
                } else {
                    unset($_SESSION['shopping_cart'][$key]);
                }
            } else {
                $total += $item['quantity'] * ($item['price'] - $item['price'] * $item['promo'] / 100);
            }
        }
        if (count($_SESSION['shopping_cart']) == 0) {
            unset($_SESSION['shopping_cart']);
        }
        return [
            'code' => 'success',
            'msg' => 'Updated the cart',
            'data' => round($total, 2)
        ];
    }

    public function placeorder() {
        // Place the order;
        // Step 1:retrieve the user data used for the order;
        $this->query('SELECT * FROM users WHERE email = :email');
        $this->bind(':email', $_SESSION['user_data']['email']);
        $row = $this->single();
        // Step 2: retrieve all the details regarding the order;
        $total = 0;
        foreach ($_SESSION['shopping_cart'] as $item) {
            $total += $item['quantity'] * ($item['price'] - $item['price'] * $item['promo'] / 100);
        }
        return [
            'user' => $row,
            'order' => $total
        ];
    }

    public function order() {        
        // 1) Check if all the products from the shopping cart have sufficient stocks;
        $badStocks = [];
        $transactionModel = new TransactionModel();
        foreach ($_SESSION['shopping_cart'] as $key => $product) {
            if ($product['quantity'] > $this->findById($product['id'])['stock']) {
                array_push($badStocks, $product);
            }
        }
        // 2) If so, place order;
        if (empty($badStocks)) {
            // 2.1) A transaction will be made and the shopping cart will be emptyed;
            foreach ($_SESSION['shopping_cart'] as $key => $product) {
                // Returns TRUE if the transaction was successfull;
                if ($transactionModel->createTransaction($product, $_SESSION['user_data'])) {
                    // 2.2) Also, substract from the stocks;
                    $this->substractQuantity($product);
                    unset($_SESSION['shopping_cart'][$key]);
                }
            }
            return [
                'status' => TRUE,
            ];
        } else {
            return [
                'status' => FALSE,
                'products' => $badStocks
            ];
        }
    }

    public function findById($id) {
        // Search after the product in the db using the id;
        $this->query('SELECT * FROM products WHERE id = :id');
        $this->bind(':id', $id);
        return $this->single();
    }
    
    protected function substractQuantity($product) {
        $this->query('UPDATE products SET stock = stock - :quantity WHERE id = :id ');
        $this->bind(':quantity', $product['quantity']);
        $this->bind(':id', $product['id']);
        $this->execute();
    }

}
