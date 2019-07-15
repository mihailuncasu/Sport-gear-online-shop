<?php

class Products extends Controller {
    
    protected function Index() {
        $viewmodel = new ProductModel();
        $this->returnView($viewmodel->index(), true);
    }
    
    protected function Details() {
        $viewmodel = new ProductModel();
        $this->returnView($viewmodel->details(), true);
    }
    
    protected function Add() {
        $viewmdoel = new ProductModel();
        echo json_encode($viewmdoel->add());
    }
    
    protected function Cart() {
        if (isset($_SESSION['shopping_cart'])) {
            $this->returnView($_SESSION['shopping_cart'], true);
        } else {
            $this->returnView(NULL, true);
        }
    }
    
    protected function Change() {
        $viewmodel = new ProductModel();
        echo json_encode($viewmodel->change());
    }
    
    protected function Placeorder() {
        $viewmodel = new ProductModel();
        $this->returnView($viewmodel->placeorder(), true);
    }
    
    protected function Order() {
        $viewmodel = new ProductModel();
        $this->returnView($viewmodel->order(), true);
    }
        
}
