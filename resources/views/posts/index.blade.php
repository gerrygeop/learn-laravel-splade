<x-app-layout>
   <x-slot name="header">
      <div class="flex items-center justify-between">
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
         </h2>

         <Link href="{{ route('posts.create') }}"
            class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white font-semibold rounded-md">
         New Post
         </Link>
      </div>
   </x-slot>

   <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

         <x-splade-table :for="$posts">
            @cell('action', $post)
               <Link href="{{ route('posts.edit', $post->id) }}"
                  class="text-xs text-indigo-600 hover:text-indigo-700 font-bold tracking-wider uppercase">
               Edit
               </Link>
               <Link confirm="Enter the danger zone..." confirm-text="Are you sure?" confirm-button="Yes, take me there!"
                  cancel-button="No, keep me save!" href="{{ route('posts.destroy', $post) }}" method="DELETE"
                  class="text-xs text-red-500 hover:text-red-700 font-bold tracking-wider uppercase" preserve-scroll>
               Delete
               </Link>
            @endcell
         </x-splade-table>

      </div>
   </div>
</x-app-layout>
