<?php


class curricula extends Controller
{
    function index()
    {
        $this->curricula = get_all("SELECT *FROM curriculum");
    }
    function view()
    {
        $this->curriculum = get_first("SELECT *FROM curriculum WHERE curriculum_id={$this->params[0]}");
    }
}