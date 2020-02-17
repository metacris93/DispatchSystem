<?php

namespace App\Http\Controllers;
use App\Store;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::all()->toJson();
        return response($stores, Response::HTTP_OK);
    }
}
