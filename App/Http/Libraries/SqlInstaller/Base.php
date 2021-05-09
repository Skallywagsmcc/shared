<?php

namespace App\Http\Libraries\SqlInstaller;

use App\Http\Libraries\Authentication\Auth;
use App\Http\Models\SiteSettings;
use App\Http\Models\Profile;
use App\Http\Models\User;
use Illuminate\Database\Capsule\Manager as Capsule;

class Base
{

    public function index()
    {

//        Create Model Called User
        Capsule::schema()->create("users", function ($table) {
            $table->id();
            $table->string("username");
            $table->string("email");
            $table->string("password");
            $table->integer("is_admin");
            $table->rememberToken();
            $table->timestamps();
        });

//        Twofactor auth

        Capsule::schema()->create("two_factor_auths", function ($table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->string("hex");
            $table->string("code");
            $table->string("expire"); //expires in time() + 900 = 15 mins
            $table->timestamps();
        });

//        Csrf

        Capsule::schema()->create("tokens", function ($table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->string("key");
            $table->datetime("expires");
            $table->timestamps();
            
        });

        Capsule::schema()->create("featured_images",function($table)
        {
            $table->id();
            $table->foreignId('image_id')->nullable()->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->biginteger("status");
            $table->string("expires")->nullable();
            $table->timestamps();
        });


        Capsule::schema()->create("articles", function ($table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->string("title");
            $table->string("slug");
            $table->longtext("content");
            $table->timestamps();
        });

        Capsule::schema()->create("charters",function($table)
        {
            $table->id();
            $table->string("title");
            $table->string("slug");
            $table->text("content");
//            pinned will be used to change the default page
            $table->integer("pinned");
            $table->timestamps();
        });

        Capsule::schema()->create("events",function($table)
        {
            $table->id();
            $table->string("title");
            $table->string("slug");
            $table->longtext("content");
            $table->datetime("start")->nullable();
            $table->datetime("end")->nullable();
            $table->longtext("address")->nullable();
            $table->timestamps();

        });






//Profiles

        Capsule::schema()->create("profiles", function ($table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->string("first_name", 50);
            $table->string("last_name", 50);
            $table->longtext("about")->nullable();
            $table->date("dob")->nullable();
            $table->string("profile_pic")->nullable();
            $table->timestamps();
        });


        Capsule::schema()->create("user_settings", function ($table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate("cascade")->onDelete("cascade");
//            if set to 1  twofactor auth will be enable if set to 1.
            $table->integer("two_factor_auth");
//            this will stop the website emailing the use if they choose to set this to 0.
            $table->integer("display_email");
//            this will not display if it is set to 0
            $table->integer("display_dob");
//       this will show the username instead if the display is set to 0;
            $table->integer("display_full_name");
            $table->timestamps();
            
        });

        Capsule::schema()->create("images", function ($table) {
            $table->id();
//            this will link to the user
            $table->foreignId('user_id')->nullable()->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->foreignId('article_id')->nullable()->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->string("image_name");
            $table->string("image_size");
            $table->string("image_type");
            $table->string("title");
            $table->text("description");
            $table->BigInteger("featured");
            $table->date("expires");
            $table->timestamps();
        });

        Capsule::schema()->create("featured",function($table)
        {
            $table->id();
            $table->foreignId('image_id')->nullable()->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->biginteger("status");
            $table->string("expires");
            $table->timestamps();
        });

        Capsule::schema()->create("comments", function ($table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->foreignId('image_id')->nullable()->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->foreignId('page_id')->nullable()->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->string("comment");
            $table->timestamps();
            
        });

        Capsule::schema()->create("site_settings", function ($table)
        {
            $table->id();
            $table->biginteger("allow_comments")->default(1);
            $table->biginteger("login")->default(1);
            $table->string("email");
//          Block Registration option
            $table->biginteger("registration")->nullable()->default(0);
            $table->string("facebook")->nullable();
            $table->string("twitter")->nullable();
            $table->string("linkedin")->nullable();
            $table->string("discord")->nullable();
            $table->timestamps();
            

        });

        Capsule::schema()->create("password_requests", function ($table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate("cascade")->onDelete("cascade");
            $table->string("hex");
            $table->biginteger("key");
            $table->string("expires");
            $table->timestamps();

        });
    }


    public function update()
    {
//        Capsule::schema()->create("featured_images",function($table)
//        {
//            $table->id();
//            $table->foreignId('image_id')->nullable()->constrained()->onUpdate("cascade")->onDelete("cascade");
//            $table->biginteger("status");
//            $table->string("expires")->nullable();
//            $table->timestamps();
//        });

//        charters
//
//        Capsule::schema()->create("articles", function ($table) {
//            $table->id();
//            $table->foreignId('user_id')->nullable()->constrained()->onUpdate("cascade")->onDelete("cascade");
//            $table->string("title");
//            $table->string("slug");
//            $table->longtext("content");
//            $table->timestamps();
//        });

//        Capsule::schema()->create("charters",function($table)
//        {
//            $table->id();
//            $table->string("title");
//            $table->string("slug");
//            $table->text("content");
////            pinned will be used to change the default page
//            $table->integer("pinned");
//            $table->timestamps();
//        });
//
//        Capsule::schema()->create("events",function($table)
//        {
//            $table->id();
//            $table->string("title");
//            $table->string("slug");
//            $table->longtext("content");
//            $table->datetime("start")->nullable();
//            $table->datetime("end")->nullable();
//            $table->longtext("address")->nullable();
//            $table->timestamps();
//
//        });



    }
}