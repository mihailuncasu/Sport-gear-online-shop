<?php

class UserModel extends Model {

    public function register() {
        // Sanitize POST;
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // We don't keep passwords as plain text in the db;
        $password = md5($post['password']);

        // Empty post means that we just accesed this page of the application;
        if ($post['submit']) {
            // Check data inserted by the user;
            if (!$this->checkRegisterPost($post)) {
                return;
            }
            $token = rand();
            // Insert into MySQL
            $this->query('INSERT INTO users (name, email, password, token) VALUES(:name, :email, :password, :token)');
            $this->bind(':name', $post['name']);
            $this->bind(':email', $post['email']);
            $this->bind(':password', $password);
            $this->bind(':token', $token);
            $this->execute();
            // Check if the insert was ok and send a mail to the user to go further with the registration process;
            if ($id = $this->lastInsertId()) {
                // Set success register message;
                Messages::setMsg('Successfully registered. Please check your email in order to activate the account.', 'success');
                // Send a mail to the user with the activation link;
                Mailer::sendMail($post['email'], 1, $id, md5($token));
            } else {
                Messages::setMsg('Internal server error. Please try again later.', 'error');
            }
        }
        return;
    }

    public function activate() {
        // Sanitize GET;
        $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        $id = $get['user'];
        $token = $get['token'];

        // Search the user after id;
        $this->query('SELECT * FROM users WHERE id = :id');
        $this->bind(':id', $id);
        $row = $this->single();
        if ($row) {
            if (md5($row['token']) == $token) {
                // Activate the user after his id;
                $this->query('UPDATE users SET status = :status, token = :token WHERE id = :id ');
                $status = 'active';
                $token = rand();
                $this->bind(':token', $token);
                $this->bind(':status', $status);
                $this->bind(':id', $id);
                $this->execute();
                Messages::setMsg('Activation complete.', 'success');
            } else {
                // The link is invalid;
                Messages::setMsg('The link has expired.', 'error');
            }
        }
    }

    public function profile() {
        // Sanitize POST;
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // Get the user data in order to complete the fields;
        $this->query('SELECT * FROM users WHERE email = :email');
        $this->bind(':email', $_SESSION['user_data']['email']);
        $row = $this->single();
        $id = $row['id'];
        $password = $row['password'];
        // Edit profile request;
        if ($post['submit']) {
            // The update will also affect password field;
            if ($post['password']) {
                // Check if passwords are changed or not;
                if ($post['password'] != $post['password_confirm']) {
                    Messages::setMsg('In order to change your password, Password and Confirm password have to be the same!', 'error');
                    return;
                } else {
                    $password = md5($post['password']);
                }
            }
            $this->query('UPDATE users SET password = :password, phone_number = :phone_number, address = :address WHERE id = :id ');
            $this->bind(':password', $password);
            $this->bind(':phone_number', $post['phone_number']);
            $this->bind(':address', $post['address']);
            $this->bind(':id', $id);
            $this->execute();
            Messages::setMsg('Your changes have been updated!', 'error');
        }
        return $row;
    }

    public function login() {
        // Sanitize POST;
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $password = md5($post['password']);

        if ($post['submit']) {
            // Check login user data;
            $this->query('SELECT * FROM users WHERE email = :email AND password = :password AND status = "active"');
            $this->bind(':email', $post['email']);
            $this->bind(':password', $password);

            $row = $this->single();

            if ($row) {
                $_SESSION['is_logged_in'] = true;
                $_SESSION['user_data'] = array(
                    "id" => $row['id'],
                    "name" => $row['name'],
                    "email" => $row['email'],
                    "role" => $row['role']
                );
                header('Location: ' . ROOT_URL . 'products');
            } else {
                Messages::setMsg('Incorrect email or password!', 'error');
            }
        }
        return;
    }

    public function recover() {
        // Sanitize POST;
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if ($post['submit']) {
            $email = $post['email'];
            $this->query('SELECT * FROM users WHERE email = :email');
            $this->bind(':email', $email);
            $row = $this->single();
            if (empty($row)) {
                Messages::setMsg('Invalid email!', 'error');
                return;
            }
            Messages::setMsg('An email with the reset link has been sent to you. Check your mail!', 'success');
            Mailer::sendMail($post['email'], 2, $row['id'], md5($row['token']));
        }
        return;
    }

    public function reset() {
        // Sanitize GET;
        $get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $id = $get['user'];
        $token = $get['token'];
        if ($post['submit']) {
            // Check if passwords match;
            if ($post['password'] != $post['password_confirm']) {
                Messages::setMsg('Password and Confirm password have to be the same!', 'error');
                return;
            }
            // Search the user after id;
            $this->query('SELECT * FROM users WHERE id = :id');
            $this->bind(':id', $id);
            // Fetch the user in order to check his token;
            $row = $this->single();
            if ($row) {
                if (md5($row['token']) == $token) {
                    // Activate the user after his id;
                    $this->query('UPDATE users SET password = :password, token = :token WHERE id = :id ');
                    $token = rand();
                    $this->bind(':token', $token);
                    $this->bind(':password', md5($post['password']));
                    $this->bind(':id', $id);
                    $this->execute();
                    Messages::setMsg('Password has been reset.', 'success');
                } else {
                    // The link is invalid;
                    Messages::setMsg('The link has expired.', 'error');
                }
            }
        }
    }
    
    public function history($id) {
        // Check if the email already exists in our database;
        $this->query('SELECT * FROM transactions WHERE id_user = :id_user');
        $this->bind(':id_user', $id);
        $rows = $this->resultSet();
        $products = [];
        $productModel = new ProductModel();
        foreach ($rows as $product) {
            $orderedProduct = $productModel->findById($product['id_product']);
            $orderedProduct['quantity'] = $product['quantity'];
            array_push($products, $orderedProduct);
        }
        return $products;
    }

    protected function checkEmail($email) {
        // Check if the email already exists in our database;
        $this->query('SELECT * FROM users WHERE email = :email');
        $this->bind(':email', $email);
        $row = $this->single();
        if (empty($row)) {
            return false;
        }
        return true;
    }

    // Returns true if everything is ok;
    protected function checkRegisterPost($post) {
        // Check for empty fields;
        if ($post['name'] == '' || $post['email'] == '' || $post['password'] == '' || $post['password_confirm'] == '') {
            Messages::setMsg('Please fill in all fields!', 'error');
            return false;
        }
        // Check if passwords match;
        if ($post['password'] != $post['password_confirm']) {
            Messages::setMsg('Password and Confirm password have to be the same!', 'error');
            return false;
        }
        // Check for users with the same email;
        if ($this->checkEmail($post['email'])) {
            Messages::setMsg('Email is already used!', 'error');
            return false;
        }
        return true;
    }

}
