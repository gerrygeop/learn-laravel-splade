<?php

namespace App\Tables;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class Posts extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('title', 'LIKE', "%{$value}%")
                        ->orWhere('slug', 'LIKE', "%{$value}%");
                });
            });
        });

        return QueryBuilder::for(Post::class)
            ->defaultSort('title')
            ->allowedSorts(['title', 'slug'])
            ->allowedFilters(['title', 'slug', 'category_id', $globalSearch]);
    }

    public function configure(SpladeTable $table)
    {
        $categories = Category::pluck('name', 'id')->toArray();

        $table
            ->withGlobalSearch()
            ->column('id', sortable: true)
            ->column('title', canBeHidden: false, sortable: true)
            ->column('slug', sortable: true)
            ->column('action', canBeHidden: false, exportAs: false)
            ->rowLink(function (Post $post) {
                return route('posts.edit', $post);
            })
            ->selectFilter('category_id', $categories)
            ->export()
            ->paginate(10);

        // ->bulkAction()
    }
}
