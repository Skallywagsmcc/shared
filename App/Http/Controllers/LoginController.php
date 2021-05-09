<?php


namespace App\Http\Controllers;


use App\Http\Functions\TemplateEngine;
use App\Http\Functions\Validate;
use App\Http\Libraries\Authentication\Cookies;
use App\Http\Libraries\Authentication\Csrf;
use App\Http\Libraries\Authentication\Sessions;
use App\Http\Models\User;
use MiladRahimi\PhpRouter\Url;

class LoginController
{

    public function index(Url $url)
    {
        echo TemplateEngine::View("Pages.Auth.Login.index", ["url" => $url]);
    }

    public function store(Url $url, Validate $validate,Csrf $csrf)
    {
        $username = $validate->Required("username")->Post();
        $password = $validate->Required("password")->Post();
        if($validate::isRequired($validate::$values) == false)
        {
            $error = "required";
        }
        else
        {
            $user = User::where("username", $username)->orwhere("email", $username)->get();
            if($user->count() == 1)
            {
                $user = $user->first();
                echo $user->id;
                if(password_verify($password,$user->password))
            {
                if($validate->Post("remember") == 1)
                {
                    Cookies::Create("id", $user->id)->Days(7)->Http(true)->Save();
                }
                else
                {
                    Sessions::Create("id",$user->id);
                }
                $csrf->GenerateToken($user->id);
                redirect($url->make("profile.home",['username'=>$user->username]));
            }
            else
            {
                $error = "Sorry the password does not match our database: Please try again";
            }
            }
            else
            {
                $error = "Sorry the user you have entered does not seem to exist in our database : Please try again";
            }
        }
        echo TemplateEngine::View("Pages.Auth.Login.index", ["url" => $url,"error"=>$error,"validate"=>$validate]);
    }

    public function logout(Url $url)
    {

        if(isset($_SESSION['id']))
        {
            echo "Im a session";
            Sessions::Destroy("id");
        }

        if(isset($_COOKIE['id']))
        {
            setcookie("id",'',time()-3600,'/');
        }

//        Destroy Other Sessions and cookies
        Sessions::Destroy("tfa_approved");
        Sessions::Destroy("csrf_expire");
            redirect($url->make("login"));


    }

}