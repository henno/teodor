<?php

class thesises extends Controller
{

    function index(){
        $this->thesises = get_all("SELECT * FROM `thesis`");
    }

}