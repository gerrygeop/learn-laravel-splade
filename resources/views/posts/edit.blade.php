<x-app-layout>
   <x-slot name="header">
      <div class="flex items-center justify-between">
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
         </h2>
      </div>
   </x-slot>

   <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

         <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
               <x-splade-form :action="route('posts.update', $post)" :default="$post" method="PUT" class="max-w-2xl mx-auto">

                  <x-splade-select name="category_id" :options="$categories" label="Category" />

                  <x-splade-input name="title" label="Title" class="mt-2" />

                  <x-splade-input name="slug" label="Slug" class="mt-2" />

                  <x-splade-textarea name="description" label="Description" class="mt-2" autosize />

                  <x-splade-submit class="mt-4" />
               </x-splade-form>
            </div>
         </div>

      </div>
   </div>
</x-app-layout>
