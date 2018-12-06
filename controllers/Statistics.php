<?php namespace Indikator\BlogStat\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Backend;
use RainLab\Blog\Models\Post;
use RainLab\Blog\Models\Category;

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

        $this->addCss('/plugins/indikator/blogstat/assets/css/statistics.css');

        $this->vars['countPost']     = Post::count();
        $this->vars['countCategory'] = Category::count();

        $this->getGraphs();
        $this->getPostsInfo();
        $this->getLongestPosts();
        $this->getShortestPosts();
    }

    public function getGraphs()
    {
        $this->vars['thisYear'] = $this->vars['lastYear'] = array_fill(0, 13, 0);
        $this->vars['now'] = date('Y');

        $blog = Post::where('published_at', '>', 0)->get();

        foreach ($blog as $item) {
            $year = substr($item->published_at, 0, 4);

            if ($year == $this->vars['now']) {
                $this->vars['thisYear'][(int)substr($item->published_at, 5, 2)]++;
            }

            else if ($year == $this->vars['now'] - 1) {
                $this->vars['lastYear'][(int)substr($item->published_at, 5, 2)]++;
                $this->vars['lastYear'][0]++;
            }
        }
    }

    public function getPostsInfo()
    {
        $blog = Post::get();
        $this->vars['length'] = $this->vars['title'] = [];

        foreach ($blog as $item) {
            $this->vars['length'][$item->id] = strlen(trim(preg_replace('/\s+/', ' ', strip_tags($item->excerpt.$item->content))));
            $this->vars['title'][$item->id]  = $item->title;
        }
    }

    public function getLongestPosts()
    {
        $length = $this->vars['length'];
        $title  = $this->vars['title'];

        arsort($length);

        $this->vars['longest'] = '';
        $index = 1;

        foreach ($length as $id => $value) {
            $this->vars['longest'] .= '
                <div class="col-md-1 col-sm-1">
                    '.$index.'.
                </div>
                <div class="col-md-9 col-sm-9">
                    <a href="'.Backend::url('rainlab/blog/posts/update/'.$id).'">'.$title[$id].'</a>
                </div>
                <div class="col-md-2 col-sm-2 text-right">
                    '.number_format($value, 0, '.', ' ').'
                </div>
                <div class="clearfix"></div>
            ';

            if ($index == 10) {
                break;
            }

            $index++;
        }
    }

    public function getShortestPosts()
    {
        $length = $this->vars['length'];
        $title  = $this->vars['title'];

        asort($length);

        $this->vars['shortest'] = '';
        $index = 1;

        foreach ($length as $id => $value) {
            $this->vars['shortest'] .= '
                <div class="col-md-1 col-sm-1">
                    '.$index.'.
                </div>
                <div class="col-md-9 col-sm-9">
                    <a href="'.Backend::url('rainlab/blog/posts/update/'.$id).'">'.$title[$id].'</a>
                </div>
                <div class="col-md-2 col-sm-2 text-right">
                    '.number_format($value, 0, '.', ' ').'
                </div>
                <div class="clearfix"></div>
            ';

            if ($index == 10) {
                break;
            }

            $index++;
        }
    }
}
