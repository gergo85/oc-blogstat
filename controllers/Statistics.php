<?php namespace Indikator\BlogStat\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Statistics extends Controller
{
    public $requiredPermissions = ['indikator.blogstat.statistics'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('RainLab.Blog', 'blog', 'statistics');
    }

    public function index()
    {
        $this->pageTitle = 'indikator.blogstat::lang.menu.statistics';
    }
}
