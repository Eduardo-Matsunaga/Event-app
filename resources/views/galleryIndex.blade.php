<x-main-layout>
    <!-- component -->
    <section class="bg-white dark:bg-gray-900">
        <div class="container px-6 py-10 mx-auto">
            <h1 class="text-3xl font-semibold text-gray-800 capitalize lg:text-4xl dark:text-white">All Galleries</h1>

            <div class="grid grid-cols-1 gap-8 mt-8 md:mt-16 md:grid-cols-2">
                @foreach ($galleries as $gallery)
                    <div class="lg:flex rounded-md" style="background-color: #222831;">
                        <img class="object-cover w-full h-56 rounded-lg lg:w-64"
                             src="{{ asset('/storage/' . $gallery->image) }}" alt="{{ $gallery->caption }}">
                        <div class="flex flex-col justify-center p-6">
                            <h2 class="text-sm text-white dark:text-gray-300 rounded-md p-2" style="background-color: #5C2FC2;">{{ $gallery->caption }}</h2>
                        </div>
                    </div>
                @endforeach
            </div>
            {{$galleries->links()}}
        </div>
    </section>
</x-main-layout>
