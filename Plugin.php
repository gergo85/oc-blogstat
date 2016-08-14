<?php namespace Indikator\BlogStat;

use System\Classes\PluginBase;
use Backend;
use Event;

class Plugin extends PluginBase
{
    public $require = ['RainLab.Blog'];

    public function pluginDetails()
    {
        return [
            'name'        => 'indikator.blogstat::lang.plugin.name',
            'description' => 'indikator.blogstat::lang.plugin.description',
            'author'      => 'indikator.blogstat::lang.plugin.author',
            'icon'        => 'icon-area-chart',
            'homepage'    => 'https://github.com/gergo85/oc-blogstat'
        ];
    }

    public function boot()
    {
        Event::listen('backend.menu.extendItems', function($manager)
        {
            $manager->addSideMenuItems('RainLab.Blog', 'blog', [
                'statistics' => [
                    'label' => 'indikator.blogstat::lang.menu.statistics',
                    'icon'  => 'icon-area-chart',
                    'code'  => 'statistics',
                    'owner' => 'Indikator.BlogStat',
                    'url'   => Backend::url('indikator/blogstat/statistics')
                ]
            ]);
        });
    }

    public function registerReportWidgets()
    {
        return [
            'Indikator\BlogStat\ReportWidgets\Posts' => [
                'label'   => 'indikator.blogstat::lang.widget.posts',
                'context' => 'dashboard'
            ],
            'Indikator\BlogStat\ReportWidgets\Categories' => [
                'label'   => 'indikator.blogstat::lang.widget.categories',
                'context' => 'dashboard'
            ]
        ];
    }

    public function registerPermissions()
    {
        return [
            'indikator.blogstat.statistics' => [
                'tab'   => 'rainlab.blog::lang.blog.tab',
                'label' => 'indikator.blogstat::lang.permission.statistics'
            ]
        ];
    }
}
