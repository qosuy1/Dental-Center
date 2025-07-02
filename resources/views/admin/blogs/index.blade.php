@php
    use App\Enum\PermissionsEnum;
@endphp

<x-admin.layout>


    <div class="main-content-wrap">

        <x-admin.page-heading title="كل المقالات " />


        <div class="wg-box">

            <x-admin.search-bar-add-button placeholder="(عنوان المقال)" :create_route="route('admin.blogs.create')" :can="PermissionsEnum::create_blog->value" />


            @foreach ($blogs as $blog)
                {{-- {{dd($blog->content)}} --}}
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mt-4">
                            <!-- Post Title -->
                            <h5 class="card-title">{{ $blog->title }}</h5>
                            <p class="fw-bold text-primary">{{ $blog->doctor->name ?? $blog->doctor_name }}</p>
                        </div>

                        <div class="fs-3 card-text my-4">
                            {{ $blog->smallDesc }}
                            <a href="{{ route('admin.blogs.show', $blog) }}" style="color: rgb(109, 109, 228)">read more</a>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <div class="d-flex justify-content-between gap-1">
                                <!-- Post Buttons -->
                                <a href="{{ route('admin.blogs.show', $blog) }}"
                                    class="tf-button tf-button-small style-1">View
                                    Post</a>

                                @can(PermissionsEnum::edit_blog)
                                    <a href="{{ route('admin.blogs.edit', $blog) }}"
                                        class="tf-button tf-button-small style-1">Edit</a>
                                @endcan
                                @can(PermissionsEnum::delete_blog)
                                    <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="delete"
                                            class="tf-button tf-button-small style-1 btn-delete">Delete</button>
                                    </form>
                                @endcan
                            </div>

                            <!-- Post Date (Right Corner) -->
                            <div class="text-end text-muted fs-5 mb-2">
                                {{-- {{ date('M j, Y \a\t g:i A', time()) }} --}}
                                {{ date('M j, Y \a\t g:i A', strtotime($blog->updated_at)) }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


            <div class="divider"></div>
            <x-admin.pagination :attribute="$blogs" />
        </div>
    </div>


</x-admin.layout>
