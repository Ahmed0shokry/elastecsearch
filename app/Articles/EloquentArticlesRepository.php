<?php
/**
 * Created by PhpStorm.
 * User: abd-elrahman-dev
 * Date: 1/25/20
 * Time: 1:03 PM
 */
namespace App\Articles;

use App\Product;
use Illuminate\Database\Eloquent\Collection;

class EloquentArticlesRepository implements ArticlesRepository
{
    public function search(string $query = ""): Collection
    {
        return Product::where('name', 'like', "%{$query}%")
            ->orWhere('summery', 'like', "%{$query}%")
            ->get();
    }
}
