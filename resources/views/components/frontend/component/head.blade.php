@props(['title' => 'default title', 'description' => 'default description'])

<!--  Header -->
<div class="bg-indigo-300 pt-20 pb-8">
    <div class="max-w-6xl mx-auto px-4 text-center">
        <h1 class="text-2xl md:text-4xl font-bold text-gray-800 mb-4">
            {{ $title }}
        </h1>
        <p class="text-base md:text-xl text-gray-600 max-w-3xl mx-auto">
            {{ $description }}
        </p>
    </div>
</div>
