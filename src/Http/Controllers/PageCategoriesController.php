<?php

namespace Shetabit\PageBuilder\Http\Controllers;

use Illuminate\Http\Request;
use Shetabit\Response\Response;
use App\Http\Controllers\Controller;
use Shetabit\PageBuilder\PageCategory;
use Shetabit\PageBuilder\PageCategoriesRepository;
use Shetabit\PageBuilder\Http\Requests\PageCategoriesRequest;

class PageCategoriesController extends Controller
{

    private $categories;

    public function __construct(PageCategoriesRepository $categories)
    {
        $this->categories = $categories;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('shetabit-pagebuilder::categories', [
            'categories' => $this->categories->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageCategoriesRequest $request)
    {
        $item = $this->categories->create(
            $request->only($this->categories->model->getFillable())
        );

        return Response::success('دسته‌بندی با موفقیت ثبت شد', $item);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PageCategory  $pageCategory
     * @return \Illuminate\Http\Response
     */
    public function show(PageCategory $pageCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PageCategory  $pageCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(PageCategory $pageCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PageCategory  $pageCategory
     * @return \Illuminate\Http\Response
     */
    public function update(PageCategoriesRequest $request, PageCategory $pageCategory)
    {
        $item = $this->categories->update(
            $pageCategory, $request->only($pageCategory->getFillable())
        );

        return Response::success('دسته‌بندی با موفقیت ویرایش شد', $item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PageCategory  $pageCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(PageCategory $pageCategory)
    {
        $pageCategory->delete();

        return Response::success('دسته‌بندی حذف شد');
    }
}
