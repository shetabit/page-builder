<?php
namespace Shetabit\PageBuilder;

use Shetabit\Base\Repository;

class PageCategoriesRepository extends Repository
{

    public function model()
    {
        return \Shetabit\PageBuilder\PageCategory::class;
    }
}