<?php

namespace Shetabit\PageBuilder\Http\Controllers;

use Illuminate\Http\Request;
use Shetabit\PageBuilder\Page;
use Shetabit\Response\Response;
use App\Http\Controllers\Controller;
use Shetabit\PageBuilder\PagesRepository;
use Shetabit\PageBuilder\PageCategoriesRepository;
use Shetabit\PageBuilder\Http\Requests\PagesRequest;

class PagesController extends Controller
{

    private $pages;
    private $categories;

    public function __construct(
        PagesRepository $pages,
        PageCategoriesRepository $categories
    ) {
        $this->pages = $pages;
        $this->categories = $categories;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('shetabit-pagebuilder::index', [
            'pages' => $this->pages->all(),
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
    public function store(PagesRequest $request)
    {
        $page = $this->pages->create(
            $request->only($this->pages->model->getFillable())
        );

        return Response::success('با موفقیت ثبت شد', $page);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Shetabit\PageBuilder\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Shetabit\PageBuilder\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Shetabit\PageBuilder\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(PagesRequest $request, Page $page)
    {
        $page = $this->pages->update(
            $page, $request->only($page->getFillable())
        );

        if ($page instanceof Page) {
            return Response::success('با موفقیت ویرایش شد', $page);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Shetabit\PageBuilder\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        if ($page->delete()) {
            return Response::success('حذف شد');
        }

    }
}
