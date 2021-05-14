<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use App\Http\Models\Charter;
use MiladRahimi\PhpRouter\Url;

class ChartersController
{

    public function index(Url $url)
    {
      $sidebar = Charter::all();
        $charter = Charter::where("pinned","1")->get();
        if($charter->count() == 1)
        {
            redirect($url->make("charters.view",["slug"=>$charter->first()->slug]));
        }
        else
        {
            redirect($url->make("charters.home"));
        }

//        echo TemplateEngine::View("Pages.Frontend.Charters.index",["url"=>$url,"charter"=>$charter,"sidebar"=>$sidebar]);
    }

    public function show($slug,Url $url)
    {
        $charter = Charter::where("slug","$slug")->get()->first();
        $sidebar = Charter::all();
       echo TemplateEngine::View("Pages.Frontend.Charters.view",["url"=>$url,"charter"=>$charter,"sidebar"=>$sidebar,"class"=>baseclass($this)]);
    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }

}