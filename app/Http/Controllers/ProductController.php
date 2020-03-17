<?php

namespace App\Http\Controllers;

use App\Articles\ArticlesRepository;
use App\Articles\DatabaseArticlesRepository;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index() {
        return dd(array_column(array_slice(Product::all()->toArray(),0,20),  'summary', 'name'));
    }

    public function search (ArticlesRepository $repository) {

        $products = $repository->search((string) request('q'));

        return view('welcome', [
            'products' => $products,
        ]);
    }
}
