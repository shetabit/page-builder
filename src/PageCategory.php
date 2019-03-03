<?php

namespace Shetabit\PageBuilder;

use Illuminate\Database\Eloquent\Model;

class PageCategory extends Model
{
    public $table = 'shetabit_page_builder_categories';

    protected $fillable = ['title'];
}
