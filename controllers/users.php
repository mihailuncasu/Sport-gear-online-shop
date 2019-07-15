<?php

class Users extends Controller {

    protected function register() {
        $viewmodel = new UserModel();
        $this->returnView($viewmodel->register(), true);
    }

    protected function activate() {
        $viewmodel = new UserModel();
        $this->returnView($viewmodel->activate(), true);
    }

    protected function login() {
        $viewmodel = new UserModel();
        $this->returnView($viewmodel->login(), true);
    }
    
    protected function recover() {
        $viewmodel = new UserModel();
        $this->returnView($viewmodel->recover(), true);
    }
    
    protected function reset() {
        $viewmodel = new UserModel();
        $this->returnView($viewmodel->reset(), true);
    }

    protected function profile() {
        if ($_SESSION['is_logged_in']) {
            $viewmodel = new UserModel();
            $this->returnView($viewmodel->profile(), true);
        }         
    }

    protected function logout() {
        unset($_SESSION['is_logged_in']);
        unset($_SESSION['user_data']);
        session_destroy();
        // Redirect
        header('Location: ' . ROOT_URL);
    }

    protected function history() {
        $viewmodel = new UserModel();
        $this->returnView($viewmodel->history($_SESSION['user_data']['id']), true);
    }
}
