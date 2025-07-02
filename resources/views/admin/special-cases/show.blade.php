@php
    use App\Enum\PermissionsEnum;
@endphp

<x-admin.layout>
    <div class="main-content-wrap">
        <x-admin.page-heading title="تفاصيل الحالة الخاصة" />

        <div class="wg-box">
            <div class="row g-4">
                {{-- Basic Information Card --}}
                <div class="col-md-6">
                    <div class="card mb-4 info-card">
                        <div class="card-body">
                            <h3 class="card-title mb-4">{{ $specialCase->title }}</h3>

                            <div class="info-item mb-4">
                                <h5 class="text-primary">الطبيب:</h5>
                                <p class="fs-4">{{ $specialCase->doctor->name ?? $specialCase->doctor_name }}</p>
                            </div>

                            <div class="info-item mb-4">
                                <h5 class="text-primary">عمر المريض:</h5>
                                <p class="fs-4">{{ $specialCase->patient_age }} سنة</p>
                            </div>

                            <div class="info-item mb-4">
                                <h5 class="text-primary">مدة العلاج:</h5>
                                <p class="fs-4">{{ $specialCase->treatment_duration }}</p>
                            </div>

                            <div class="info-item mb-4">
                                <h5 class="text-primary">الإجراءات:</h5>
                                <p class="fs-4">{{ $specialCase->procedures }}</p>
                            </div>

                            <div class="info-item mb-4">
                                <h5 class="text-primary">حالة خاصة:</h5>
                                @if ($specialCase->is_special_case)
                                    <span class="badge bg-success fs-5">نعم</span>
                                @else
                                    <span class="badge bg-secondary fs-5">لا</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Treatment Details Card --}}
                <div class="col-md-6">
                    <div class="card mb-4 treatment-card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">تفاصيل العلاج</h4>

                            <div class="info-item mb-4">
                                <h5 class="text-primary">نظرة عامة:</h5>
                                <p class="fs-4">{{ $specialCase->overview }}</p>
                            </div>

                            <div class="info-item mb-4 has-list">
                                <h5 class="text-primary">خطة العلاج:</h5>
                                <p class="fs-4 me-4">{!! $specialCase->treatment_plan !!}</p>
                            </div>

                            <div class="info-item mb-4">
                                <h5 class="text-primary">النتيجة:</h5>
                                <p class="fs-4">{{ $specialCase->result }}</p>
                            </div>

                            <div class="info-item mb-4">
                                <h5 class="text-primary">التقييم:</h5>
                                <p class="fs-4">{{ $specialCase->feedback }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Images Card --}}
                <div class="col-12">
                    <div class="card images-card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">صور الحالة</h4>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="image-wrapper">
                                        <h5 class="text-primary mb-3">صورة قبل:</h5>
                                        @if ($specialCase->before_image)
                                            <div class="image-container">
                                                <img src="{{ asset('storage/' . $specialCase->before_image) }}"
                                                    alt="Before" class="img-fluid rounded shadow-sm">
                                            </div>
                                        @else
                                            <div class="alert alert-secondary">
                                                <i class="icon-image"></i>
                                                لا توجد صورة
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="image-wrapper">
                                        <h5 class="text-primary mb-3">صورة بعد:</h5>
                                        @if ($specialCase->after_image)
                                            <div class="image-container">
                                                <img src="{{ asset('storage/' . $specialCase->after_image) }}"
                                                    alt="After" class="img-fluid rounded shadow-sm">
                                            </div>
                                        @else
                                            <div class="alert alert-secondary">
                                                <i class="icon-image"></i>
                                                لا توجد صورة
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="mt-4 d-flex gap-3">
                <a href="{{ route('admin.special-cases.index') }}" class="btn btn-secondary btn-lg">
                    <i class="icon-arrow-right"></i>
                    رجوع للقائمة
                </a>

                @can(PermissionsEnum::edit_case)
                    <a href="{{ route('admin.special-cases.edit', $specialCase) }}" class="btn btn-primary btn-lg">
                        <i class="icon-edit-3"></i>
                        تعديل
                    </a>
                @endcan

                @can(PermissionsEnum::delete_case)
                    <form action="{{ route('admin.special-cases.destroy', $specialCase) }}" method="POST"
                        class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-lg"
                            onclick="return confirm('هل أنت متأكد من حذف هذه الحالة؟')">
                            <i class="icon-trash-2"></i>
                            حذف
                        </button>
                    </form>
                @endcan
            </div>
        </div>
    </div>

    <style>
        .card {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08);
            border: none;
            border-radius: 1rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.12);
        }

        .card-title {
            color: #2c3e50;
            font-weight: 700;
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid #e9ecef;
        }

        .text-primary {
            color: #0d6efd !important;
            font-weight: 600;
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
        }

        .fs-4 {
            line-height: 1.8;
            color: #495057;
        }

        .info-item {
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 0.75rem;
            transition: background-color 0.2s ease;
        }

        .info-item:hover {
            background: #e9ecef;
        }

        .image-container {
            border-radius: 1rem;
            overflow: hidden;
            transition: transform 0.3s ease;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }

        .image-container img {
            width: 100%;
            /* height: 400px; */
            object-fit: cover;
        }

        .image-container:hover {
            transform: scale(1.02);
        }

        .image-wrapper {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 1rem;
        }

        .badge {
            padding: 0.5rem 1rem;
            font-weight: 500;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            border-radius: 0.75rem;
            transition: all 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }

        .has-list ul{
            margin-right: 8px ;
        }

        .has-list ul>li {
            list-style: disc;
            margin-bottom: 0.5rem;
        }

        .has-list ol>li {
            list-style: decimal;
            margin-bottom: 0.5rem;
        }

        .alert {
            border-radius: 0.75rem;
            padding: 1rem;
            font-size: 1.1rem;
        }
    </style>
</x-admin.layout>
