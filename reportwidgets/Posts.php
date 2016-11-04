<?php namespace Indikator\BlogStat\ReportWidgets;

use Backend\Classes\ReportWidgetBase;
use Exception;

class Posts extends ReportWidgetBase
{
    public function render()
    {
        try {
            $this->loadData();
        }
        catch (Exception $ex) {
            $this->vars['error'] = $ex->getMessage();
        }

        return $this->makePartial('widget');
    }

    public function defineProperties()
    {
        return [
            'title' => [
                'title'             => 'backend::lang.dashboard.widget_title_label',
                'default'           => 'rainlab.blog::lang.blog.posts',
                'type'              => 'string',
                'validationPattern' => '^.+$',
                'validationMessage' => 'backend::lang.dashboard.widget_title_error'
            ],
            'total' => [
                'title'             => 'indikator.blogstat::lang.widgets.show_total',
                'default'           => true,
                'type'              => 'checkbox'
            ],
            'active' => [
                'title'             => 'indikator.blogstat::lang.widgets.show_active',
                'default'           => true,
                'type'              => 'checkbox'
            ],
            'inactive' => [
                'title'             => 'indikator.blogstat::lang.widgets.show_inactive',
                'default'           => true,
                'type'              => 'checkbox'
            ]
        ];
    }

    protected function loadData()
    {
        $this->vars['active']   = \RainLab\Blog\Models\Post::where('published', true)->count();
        $this->vars['inactive'] = \RainLab\Blog\Models\Post::where('published', false)->count();
        $this->vars['total']    = $this->vars['active'] + $this->vars['inactive'];
    }
}
