<?php


class curricula extends Controller
{
    function index()
    {
        $this->curriculums = get_all("SELECT *FROM curriculums");
    }
    function view()
    {
        $this->curriculums = get_first("SELECT *FROM curriculums WHERE curriculum_id={$this->params[0]}");
    }
}