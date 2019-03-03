<?php

namespace Shetabit\PageBuilder\Http\Controllers;

use App\Classes\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Shetabit\PageBuilder\PageCategoriesRepository;
use Shetabit\PageBuilder\Http\Requests\PageCategoriesRequest;

class PageCategoriesController extends Controller
{

    private $pageCategories;

    public function __construct(PageCategoriesRepository $pageCategories)
    {
        $this->pageCategories = $pageCategories;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('shetabit-pagebuilder::categories', [
            'categories' => $this->pageCategories->all()
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
        $item = $this->pageCategories->create(
            $request->only($this->pageCategories->model->getFillable())
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
    public function update(Request $request, PageCategory $pageCategory)
    {
        $this->authorize('update', $pageCategory);

        $item = $this->pageCategories->update($request, $pageCategory);
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
        $this->authorize('delete', $pageCategory);
        $pageCategory->delete();
        return Response::success('دسته‌بندی حذف شد');
    }
}
