<?php

namespace App\Tables;

use App\Models\Category;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class Categories extends AbstractTable
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
        return Category::query();
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(columns: ['name'])
            ->column('id', sortable: true)
            ->column('name', canBeHidden: false, sortable: true)
            ->column('slug')
            ->column('action', canBeHidden: false, exportAs: false)
            ->bulkAction(
                label: "Delete Categories",
                each: fn (Category $category) => $category->delete(),
                confirm: 'Delete Categories',
                confirmText: 'Are you sure you want to delete the categories?',
                confirmButton: 'Yes, delete all selected rows!',
                cancelButton: 'No, do not delete!',
                before: fn () => info('Deleting the selected projects'),
                after: fn () => Toast::info('Categories has been deleted!')->autoDismiss(3)
            )
            ->export();

        // ->searchInput()
        // ->selectFilter()
        // ->withGlobalSearch()

        // ->bulkAction()
    }
}
