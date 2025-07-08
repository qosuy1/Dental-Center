@php
    use app\Enum\PermissionsEnum;
@endphp

<x-admin.layout>

    <div class="main-content-wrap">

        <x-admin.page-heading title="تفاصيل المقال" :msg="session('msg')" />


        <div class="card mt-5">
            <div class="card-header">
                <h3 class="fs-1 my-4">{{ $blog->title }}</h3>
                <p class="me-4">{{ $blog->smallDesc }}</p>
            </div>
            <div class="card-body">
                <!-- Photo Section -->
                @empty(!$blog->image)
                    <div class="row justify-content-center mb-4"> <!-- Center the image horizontally -->
                        <div class="col-12 col-md-8 col-lg-4"> <!-- Adjust column width for different screen sizes -->
                            <img src="{{ asset( $blog->image) }}" alt="{{ $blog->title }}"
                                class="img-fluid rounded">
                        </div>
                    </div>
                @endempty

                <div class="divider"></div>



                <div class="body-text my-4 p-5">
                    <div class="has-list">
                        {!! $blog->content !!}
                    </div>
                </div>

                <div class="divider"></div>
                <div class="my-2">
                    <p><strong>الكاتب : </strong>{{ $blog->doctor->name ?? $blog->doctor_name }}</p>
                    <div class="d-flex justify-content-between">
                        <p><strong>التاريخ : </strong> {{ date('M j, Y \a\t g:i A', strtotime($blog->updated_at)) }}</p>
                        <p><strong>تاريخ الإنشاء : </strong>
                            {{ date('M j, Y \a\t g:i A', strtotime($blog->created_at)) }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-between" st>
                <a href="{{ route('admin.blogs.index') }}" class="tf-button tf-button-small style-1"
                    style="font-size: 14px">Back to blogs</a>

                <div class="d-flex justify-content-between gap-3">
                    @can(PermissionsEnum::edit_blog)
                        <a href="{{ route('admin.blogs.edit', $blog) }}" class="tf-button tf-button-small style-1"
                            style="font-size: 14px">تعديل المقال</a>
                    @endcan
                    @can(PermissionsEnum::delete_blog)
                        <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="delete"
                                class="tf-button tf-button-small style-3 btn-delete"style="font-size: 14px">
                                حذف</button>
                        </form>
                    @endcan
                </div>

            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .img-fluid {
                max-width: 50%;
                display: block;
                margin: 0 auto;
                padding: 3% 0;
            }


            ol>li {
                list-style: decimal;
            }


            .has-list>ul li {
                list-style: disc;
                margin-bottom: 0.5rem;
            }

            .menu-list>.menu-item {
                list-style: none;
            }
        </style>
    @endpush

</x-admin.layout>
