<?php namespace Indikator\BlogStat\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Statistics extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('RainLab.Blog', 'blog', 'statistics');
    }
}
