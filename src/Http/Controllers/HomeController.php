<?php
namespace Shetabit\PageBuilder\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Shetabit\PageBuilder\PageBuilder;

class HomeController extends Controller
{

    public function index()
    {
        PageBuilder::all();
        return view('shetabit-pagebuilder::index');
    }

    public function store(Request $request)
    {

    }
}
