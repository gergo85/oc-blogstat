<?php namespace Indikator\BlogStat\ReportWidgets;

use Backend\Classes\ReportWidgetBase;
use Exception;
use RainLab\Blog\Models\Category;
use Db;

class Categories extends ReportWidgetBase
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
                'default'           => 'rainlab.blog::lang.blog.categories',
                'type'              => 'string',
                'validationPattern' => '^.+$',
                'validationMessage' => 'backend::lang.dashboard.widget_title_error'
            ],
            'total' => [
                'title'   => 'indikator.blogstat::lang.widgets.show_total',
                'default' => true,
                'type'    => 'checkbox'
            ],
            'empty' => [
                'title'   => 'indikator.blogstat::lang.widgets.show_empty',
                'default' => true,
                'type'    => 'checkbox'
            ]
        ];
    }

    protected function loadData()
    {
        $this->vars['total'] = Category::count();

        $empty = 0;
        $categories = Category::all();

        foreach ($categories as $category) {
            if (Db::table('rainlab_blog_posts_categories')->where('category_id', $category->id)->count() == 0) {
                $empty++;
            }
        }

        $this->vars['empty'] = $empty;
    }
}
