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

        $this->vars['countPost']     = Post::count();
        $this->vars['countCategory'] = Category::count();

        $this->getGraphs();
        $this->getPostsInfo();
        $this->getLongestPosts();
        $this->getShortestPosts();
    }

    public function getGraphs()
    {
        $thisYear = $lastYear = [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0, 11 => 0, 12 => 0];
        $this->vars['now'] = $now = date('Y');

        $blog = Post::where('published_at', '>', 0)->get()->all();

        foreach ($blog as $item) {
            $year = substr($item->published_at, 0, 4);

            if ($year == $now) {
                $thisYear[(int)substr($item->published_at, 5, 2)]++;
            }

            else if ($year == $now - 1) {
                $lastYear[(int)substr($item->published_at, 5, 2)]++;
                $lastYear[0]++;
            }
        }

        $this->vars['thisYear'] = $thisYear;
        $this->vars['lastYear'] = $lastYear;
    }

    public function getPostsInfo()
    {
        $blog = Post::get()->all();
        $length = $title = [];

        foreach ($blog as $item) {
            $length[$item->id] = strlen(strip_tags($item->excerpt.$item->content));
            $title[$item->id]  = $item->title;
        }

        $this->vars['length'] = $length;
        $this->vars['title']  = $title;
    }

    public function getLongestPosts()
    {
        $length = $this->vars['length'];
        $title  = $this->vars['title'];

        arsort($length);

        $longest = '';
        $index = 1;

        foreach ($length as $id => $value) {
            $longest .= '
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

        $this->vars['longest'] = $longest;
    }

    public function getShortestPosts()
    {
        $length = $this->vars['length'];
        $title  = $this->vars['title'];

        asort($length);

        $shortest = '';
        $index = 1;

        foreach ($length as $id => $value) {
            $shortest .= '
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

        $this->vars['shortest'] = $shortest;
    }
}
