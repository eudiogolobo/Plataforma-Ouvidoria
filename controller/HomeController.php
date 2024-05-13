<?php

class HomeController extends RenderView
{
    public function index()
    {
        $this->render("home",['title'=>'AQUI É A HOME', 'user'=>'Diogo']);
    }
   
}

?>