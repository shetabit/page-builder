<?php

namespace Shetabit\PageBuilder;

use Shetabit\Base\Traits\Images;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Images;

    public $table = 'shetabit_page_builder_pages';

    protected $fillable = [
        'title',
        'creator_id',
        'category_id',
        'brief_text',
        'content',
        'thumbnail',
        'status',
    ];


    public function category()
    {
        return $this->belongsTo('\Shetabit\PageBuilder\PageCategory', 'category_id')->withDefault([
            'id' => 1,
            'section_id' => '',
            'title' => 'عمومی'
        ]);;
    }

    public function setThumbnailAttribute($thumbnail)
    {
        $path = config('shetabit.pagebuilder.img_dir');
        $this->attributes['thumbnail'] = $thumbnail ? $this->storeImage($thumbnail, $path, 300) : null;
    }
}
