<?php

class HomeController extends RenderView
{
    public function index()
    {
        $users = new User();


        $this->render("home",[
            'title'=>'AQUI É A HOME', 
            'users'=>$users->fetch()
        ]);
    }
   
}

?>