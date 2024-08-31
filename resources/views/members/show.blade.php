@extends('layout')

@section('main')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <ol>
            @foreach ($errors->all() as $error)
                <li style="color: red;font-size: 28px">{{ $error }}</li>
            @endforeach
        </ol>
    @endif

    <form action="{{ route('members.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header text-center text-white bg-info">
                <h5>البيانات الشخصية</h5>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-12 col-lg-4 my-1">
                        <label for="full_name" class="form-label">الأسم والكنية: {{ $member->full_name }}</label>
                    </div>
                    <div class="col-12 col-lg-4 my-1">
                        <label for="full_name" class="form-label">اسم الأب: {{ $member->father_name }}</label>
                    </div>
                    <div class="col-12 col-lg-4 my-1">
                        <label for="full_name" class="form-label">اسم الأم : {{ $member->mother_name }}</label>
                    </div>


                    <div class="col-12 col-lg-4 my-1">
                        <label for="full_name" class="form-label"> الجنس: {{ $member->gender }}</label>
                    </div>
                    <div class="col-12 col-lg-4 my-1">
                        <label for="full_name" class="form-label"> تاريخ الولادة: {{ $member->dob }}</label>
                    </div>
                    <div class="col-12 col-lg-4 my-1">
                        <label for="full_name" class="form-label"> مكان الولادة: {{ $member->lob }}</label>
                    </div>


                    <div class="col-12 col-lg-4 my-1">
                        <label for="full_name" class="form-label"> الحالة الإجتماعية: {{ $member->marital_status }}</label>
                    </div>
                    <div class="col-12 col-lg-4 my-1">
                        <label for="full_name" class="form-label"> عدد أفراد الأسرة: {{ $member->family_member }}</label>
                    </div>
                    <div class="col-12 col-lg-4 my-1">
                        <label for="full_name" class="form-label"> هل توجد إعاقة:
                            {{ $member->disability == 0 ? 'لا' : 'نعم' }}</label>
                    </div>


                    <div class="col-12 col-lg-4 my-1 {{ $member->disability==0 ? 'd-none' : '' }}">
                        <label for="full_name" class="form-label"> نوع الإعاقة: {{ $member->disability_type }}</label>
                    </div>

                    <div class="col-12 col-lg-4 my-1 {{ $member->disability==0 ? 'd-none' : '' }}">
                        <label for="full_name" class="form-label"> هل يوجد حاجة إلى مرافق؟:
                            {{ $member->disability_company }}</label>
                    </div>

                    <div class="col-12 col-lg-4 my-1">
                        <label for="full_name" class="form-label"> هل توجد إعاقة لدى أحد أفراد الأسرة :
                            {{ $member->family_disability == 0 ? 'لا' : 'نعم' }}</label>
                    </div>

                    <div class="col-12 col-lg-4 my-1 {{ $member->family_disability==0 ? 'd-none' : '' }}">
                        <label for="full_name" class="form-label"> نوع الإعاقة: {{ $member->family_disability_type }}</label>
                    </div>



                    <div class="col-12 col-lg-4 my-1">
                        <label for="full_name" class="form-label"> عدد المعيلين ضمن العائلة:
                            {{ $member->count_of_worker }}</label>
                    </div>
                    <div class="col-12 col-lg-4 my-1">
                        <label for="full_name" class="form-label"> عمل الأب / الزوج: {{ $member->father_job }}</label>
                    </div>


                    <div class="col-12 col-lg-4 my-1">
                        <label for="full_name" class="form-label"> عمل الأم / الزوجة: {{ $member->mother_job }}</label>
                    </div>


                    <div class="col-12 col-lg-4 my-1 {{ $member->gender=='أنثى' ? 'd-none' : '' }}">
                        <label for="full_name" class="form-label"> حالة التجنيد: {{ $member->military_status }}</label>
                    </div>



                    <div class="col-12 col-lg-4 my-1">
                        <label for="full_name" class="form-label"> المحافظة: {{ $member->city }}</label>
                    </div>

                    <div class="col-12 col-lg-4 my-1">
                        <label for="full_name" class="form-label"> العنوان: {{ $member->address }}</label>
                    </div>
                    <div class="col-12 col-lg-4 my-1">
                        <label for="full_name" class="form-label"> حالة السكن: {{ $member->location_status }}</label>
                    </div>
                    <div class="col-12 col-lg-4 my-1">
                        <label for="full_name" class="form-label"> رقم الموبايل: 0{{ $member->phone1 }}</label>
                    </div>


                    <div class="col-12 col-lg-4 my-1">
                        <label for="full_name" class="form-label"> رقم الموبايل الثاني: 0{{ $member->phone2 }}</label>
                    </div>
                    <div class="col-12 col-lg-4 my-1">
                        <label for="full_name" class="form-label">الرقم الوطني: {{ $member->national_id }}</label>
                    </div>


                    <div class="card my-3">
                        <div class="card-header text-center text-white bg-primary">
                            <h5>بيانات التعليم </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">


                                <div class="col-12 col-lg-4 my-1">
                                    <label for="full_name" class="form-label">نوع الشهادة :
                                        {{ $member->education_certificate }}</label>
                                </div>
                                <div class="col-12 col-lg-4 my-1">
                                    <label for="full_name" class="form-label"> التخصص:
                                        {{ $member->education_field }}</label>
                                </div>
                                <div class="col-12 col-lg-4 my-1">
                                    <label for="full_name" class="form-label"> تاريخ الشهادة:
                                        {{ $member->date_of_certificate }}</label>
                                </div>


                                <div class="col-12 col-lg-4 my-1">
                                    <label for="full_name" class="form-label">هل أنت متخرج؟ :
                                        {{ $member->graduated == 1 ? 'نعم' : 'لا' }}</label>
                                </div>



                                <div class="col-12 col-lg-4 my-1 {{ $member->graduated==1 ? 'd-none' : '' }}">
                                    <label for="full_name" class="form-label">السنة الدراسية (في حال عدم التخرج):
                                        {{ $member->university_year }}</label>
                                </div>



                                <div class="col-12 col-lg-4 my-1">
                                    <label for="full_name" class="form-label">هل تملك شهادة قيادةالحاسب؟ :
                                        {{ $member->icdl == 1 ? 'نعم' : 'لا' }}</label>
                                </div>
                                <div class="col-12 col-lg-4 my-1">
                                    <label for="full_name" class="form-label">ما هي الشهادات الأخرى في الحاسب؟ :
                                        {{ $member->other_certificates }}</label>
                                </div>

                                <div class="col-12 col-lg-4 my-1">
                                    <label for="full_name" class="form-label">الدورات التدريبية السابقة:
                                        {{ $member->previous_courses }}</label>
                                </div>
                                <div class="col-12 col-lg-4 my-1">
                                    <label for="full_name" class="form-label">هل أستفدت سابقاً من أحد مشاريع UNDP? :
                                        {{ $member->beneficial_undp == 1 ? 'نعم' : 'لا' }}</label>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="card my-3">
                        <div class="card-header text-center text-white bg-info">
                            <h5>بيانات العمل </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">


                                <div class="col-12 col-lg-4 my-1">
                                    <label for="full_name" class="form-label"> هل أنت متطوع حالي في أي جمعية أهلية؟:
                                        {{ $member->current_volunteer == 0 ? 'لا' : 'نعم' }}</label>
                                </div>


                                <div class="col-12 col-lg-4 my-1 {{ $member->current_volunteer==0 ? 'd-none' : '' }}">
                                    <label for="full_name" class="form-label"> اسم الجمعية الأهلية:
                                        {{ $member->organization_name }}</label>
                                </div>


                                <div class="col-12 col-lg-4 my-1">
                                    <label for="full_name" class="form-label"> الخبرات المهنية السابقة:
                                        {{ $member->previous_experiences }}</label>
                                </div>
                                <div class="col-12 col-lg-4 my-1">
                                    <label for="full_name" class="form-label"> هل تعمل حالياً؟:
                                        {{ $member->work_now == 0 ? 'لا' : 'نعم' }}</label>
                                </div>


                                <div class="col-12 col-lg-4 my-1 {{ $member->work_now==0 ? 'd-none' : '' }}">
                                    <label for="full_name" class="form-label"> العمل الحالي :
                                        {{ $member->current_job }}</label>
                                </div>


                                <div class="col-12 col-lg-4 my-1">
                                    <label for="full_name" class="form-label"> هل تفضل العمل ضمن:
                                        {{ $member->favorite_job }}</label>
                                </div>
                                <div class="col-12 col-lg-4 my-1">
                                    <label for="full_name" class="form-label"> الدورة التي ترغب بالتسجيل بها:
                                        {{ $member->course_chosen_id }}</label>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="card my-3">
                        <div class="card-header text-center text-white bg-primary">
                            <h5>معايير الهشاشة </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-12 col-lg-4 my-1">
                                    <label for="full_name" class="form-label">عمل الأب:
                                        {{ $member->fragility_father_job }}</label>
                                </div>
                                <div class="col-12 col-lg-4 my-1">
                                    <label for="full_name" class="form-label">عمل الأم:
                                        {{ $member->fragility_mother_job }}</label>
                                </div>
                                <div class="col-12 col-lg-4 my-1">
                                    <label for="full_name" class="form-label">الإعاقة :
                                        {{ $member->fragility_disability }}</label>
                                </div>

                                <div class="col-12 col-lg-4 my-1">
                                    <label for="full_name" class="form-label">عدد أفراد الأسرة:
                                        {{ $member->fragility_family_member }}</label>
                                </div>
                                <div class="col-12 col-lg-4 my-1">
                                    <label for="full_name" class="form-label">عدد المعيلين:
                                        {{ $member->fragility_family_worker }}</label>
                                </div>
                                <div class="col-12 col-lg-4 my-1">
                                    <label for="full_name" class="form-label">التجنيد - مسرح :
                                        {{ $member->fragility_military }}</label>
                                </div>


                                <div class="col-12 col-lg-4 my-1">
                                    <label for="full_name" class="form-label"> ملاحظات:
                                        {{ $member->description }}</label>
                                </div>



                            </div>
                        </div>
                    </div>
    </form>

    <!DOCTYPE html>
    <html lang="ar" dir="rtl">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Blog Post - Start Bootstrap Template</title>
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    </head>

    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <article>
                        <header class="mb-4 ">
                            <h1 class="fw-bolder mb-1"> بيانات الطالب: {{ $member->full_name }} </h1>
                            <div class="text-muted fst-italic mb-2">{{ $member->created_at }} تمت الإضافة في: </div>
                        </header>
                        {{--
                    <div class="text-muted fst-italic mb-2">Image Of Blog </div>
                    <figure class="mb-4"><img src="{{ url('/storage/media/blogs/' . $member->image) }}"
                            style="width: 600px"></figure> --}}
                        {{-- <div class="card mb-4">
                        <div class="card-header">Blog Content</div>
                        <div class="card-body">
                            <li><a>{{ $member->content }}</a></li>
                        </div> --}}
                    </article>

    </body>

    </html>
@endsection
