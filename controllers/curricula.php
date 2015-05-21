<?php


class curricula extends Controller
{
    function index()
    {
        $this->curricula = get_all("SELECT *FROM curriculum");
    }
}