<?php


namespace App\Http\Middleware;
use MiladRahimi\PhpRouter\Router;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Closure;

class AdminAuthMiddleware
{
    public function handle(ServerRequestInterface $request, Closure $next)
    {
//        we will check for roles here

     echo "Hello Paople";
        return $next($request);

    }
}