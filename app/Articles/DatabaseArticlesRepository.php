<?php

namespace App\Articles;

use App\Product;
use Illuminate\Database\Eloquent\Collection;

class DatabaseArticlesRepository implements ArticlesRepository
{
    public function search(string $search = ""): Collection
    {
        return Product::where(function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('summary', 'like', "%{$search}%");
            })
            ->get();
    }
}
