<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Menu;
use App\Models\Content;
use App\Models\NewsEvent;
use App\Models\Fixbanner;

class BaseController extends Controller
{
    public $user;


    // protected $commonData;

    public function __construct()
    {
        
    }

    
    /* public function commonData()
    {
        return [
            'logos' => Fixbanner::where('status', 1)->orderBy('id', 'DESC')->first(),
            'menus' => Menu::with('subMenu', 'subMenu.lastMenu')->where('parent_id', null)->orderBy('sequence', 'asc')->get(),
            'contactus' => Content::where('menu_id', 1)->first(),
            'latestupdate' => NewsEvent::where('status', 1)->get(),
            'fixbanner' => Fixbanner::where('status', 1)->orderBy('id', 'DESC')->first(),
        ];
    } */
}
