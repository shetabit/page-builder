<?php
namespace Shetabit\PageBuilder;

use Shetabit\Base\Repository;

class PagesRepository extends Repository
{

    public function model()
    {
        return \Shetabit\PageBuilder\Page::class;
    }


    public function all()
    {
        return $this->model->with('category')->get();
    }
}