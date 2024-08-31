@extends('layout')

@section('main')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
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
                        <label for="full_name" class="form-label">الأسم والكنية</label>
                        <input type="text" class="form-control" name="full_name" id="full_name"
                            @if (!$errors->get('full_name')) value="{{ old('full_name', '') }}" @endif>
                        @error('full_name')
                            <div class="error text-danger">{{ $errors->first('full_name') }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-lg-4 my-1">
                        <label for="father_name" class="form-label">اسم الأب</label>
                        <input type="text" class="form-control" name="father_name" id="father_name"
                            @if (!$errors->get('father_name')) value="{{ old('father_name', '') }}" @endif>
                        @error('father_name')
                            <div class="error text-danger">{{ $errors->first('father_name') }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-lg-4 my-1">
                        <label for="mother_name" class="form-label">اسم الأم</label>
                        <input type="text" class="form-control" name="mother_name" id="mother_name"
                            @if (!$errors->get('mother_name')) value="{{ old('mother_name', '') }}" @endif>
                        @error('mother_name')
                            <div class="error text-danger">{{ $errors->first('mother_name') }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-lg-4 my-1">
                        <label for="gender" class="form-label">الجنس </label>
                        <select name="gender" id="gender" class="mt-2">
                            <option @if (old('gender', '') == 'ذكر') selected @endif value='ذكر'>ذكر</option>
                            <option @if (old('gender', '') == 'أنثى') selected @endif value='أنثى'>أنثى</option>
                        </select>
                    </div>

                    <div class="col-12 col-lg-4 my-1">
                        <label for="dob" class="form-label">تاريخ الولادة </label>
                        <input type="date" class="form-control" name="dob" id="dob"
                            @if (!$errors->get('dob')) value="{{ old('dob', '') }}" @endif>
                        @error('dob')
                            <div class="error text-danger">{{ $errors->first('dob') }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-lg-4 my-1">
                        <label for="lob" class="form-label">مكان الولادة </label>
                        <input type="text" class="form-control" name="lob" id="lob"
                            @if (!$errors->get('lob')) value="{{ old('lob', '') }}" @endif>
                        @error('lob')
                            <div class="error text-danger">{{ $errors->first('lob') }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-lg-4 my-1">
                        <label for="marital_status" class="form-label"> الحالة الإجتماعية</label>
                        <select name="marital_status" id="marital_status" class="mt-2">
                            <option @if (old('marital_status', '') == 'أعزب/ة') selected @endif value='أعزب/ة'>أعزب/ة</option>
                            <option @if (old('marital_status', '') == 'متزوج/ة') selected @endif value='متزوج/ة'>متزوج/ة</option>
                            <option @if (old('marital_status', '') == 'مطلق/ة') selected @endif value='مطلق/ة'>مطلق/ة</option>
                            <option @if (old('marital_status', '') == 'أرمل/ة') selected @endif value='أرمل/ة'>أرمل/ة</option>
                        </select>
                    </div>

                    <div class="col-12 col-lg-4 my-1">
                        <label for="family_member" class="form-label"> عدد أفراد الأسرة </label>
                        <input type="number" class="form-control" name="family_member" id="family_member"
                            @if (!$errors->get('family_member')) value="{{ old('family_member', '') }}" @endif>
                        @error('family_member')
                            <div class="error text-danger">{{ $errors->first('family_member') }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-lg-4 my-1">
                        <label for="disability" class="form-label">هل توجد إعاقة</label>
                        <select name="disability" id="disability" class="mt-2">
                            <option @if (old('disability', '') == 0) selected @endif value=0>لا</option>
                            <option @if (old('disability', '') == 1) selected @endif value=1>نعم</option>
                        </select>
                    </div>

                    <div class="col-12 col-lg-4 my-1" id="disability_type_div">
                        <label for="disability_type" class="form-label"> نوع الإعاقة</label>
                        <input type="text" class="form-control" name="disability_type" id="disability_type"
                            @if (!$errors->get('disability_type')) value="{{ old('disability_type', '') }}" @endif>
                        @error('disability_type')
                            <div class="error text-danger">{{ $errors->first('disability_type') }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-lg-4 my-1" id="disability_company_div">
                        <label for="disability_company" class="form-label"> في حال وجود إعاقة.. هل يوجد حاجة إلى
                            مرافق؟</label>
                        <select name="disability_company" id="disability_company" class="mt-2">
                            <option @if (old('disability_company', '') == 0) selected @endif value=0>لا</option>
                            <option @if (old('disability_company', '') == 1) selected @endif value=1>نعم</option>
                        </select>
                    </div>

                    <div class="col-12 col-lg-4 my-1">
                        <label for="family_disability" class="form-label"> هل توجد إعاقة لدى
                            أحد أفراد الأسرة</label>
                        <select name="family_disability" id="family_disability" class="mt-2">
                            <option @if (old('family_disability', '') == 0) selected @endif value=0>لا</option>
                            <option @if (old('family_disability', '') == 1) selected @endif value=1>نعم</option>
                        </select>
                    </div>

                    <div class="col-12 col-lg-4 my-1" id="family_disability_type_div">
                        <label for="family_disability_type" class="form-label"> نوع الإعاقة</label>
                        <input type="text" class="form-control" name="family_disability_type"
                            id="family_disability_type"
                            @if (!$errors->get('family_disability_type')) value="{{ old('family_disability_type', '') }}" @endif>
                        @error('family_disability_type')
                            <div class="error text-danger">{{ $errors->first('family_disability_type') }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-lg-4 my-1">
                        <label for="count_of_worker" class="form-label"> عدد المعيلين ضمن العائلة</label>
                        <input type="number" class="form-control" name="count_of_worker" id="count_of_worker"
                            @if (!$errors->get('count_of_worker')) value="{{ old('count_of_worker', '') }}" @endif>
                        @error('count_of_worker')
                            <div class="error text-danger">{{ $errors->first('count_of_worker') }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-lg-4 my-1">
                        <label for="father_job" class="form-label">عمل الأب / الزوج</label>
                        <select name="father_job" id="father_job" class="mt-2">
                            <option @if (old('father_job', '') == 'متقاعد') selected @endif value="متقاعد">متقاعد</option>
                            <option @if (old('father_job', '') == 'قطاع حكومي') selected @endif value="قطاع حكومي">قطاع حكومي
                            </option>
                            <option @if (old('father_job', '') == 'قطاع خاص') selected @endif value="قطاع خاص">قطاع خاص
                            </option>
                            <option @if (old('father_job', '') == 'أعمال حرة') selected @endif value="أعمال حرة">أعمال حرة
                            </option>
                            <option @if (old('father_job', '') == 'فاقد للمعيل') selected @endif value="فاقد للمعيل"> فاقد
                                للمعيل
                            </option>
                            <option @if (old('father_job', '') == 'عاطل عن العمل') selected @endif value="عاطل عن العمل"> عاطل عن
                                العمل</option>
                        </select>
                    </div>

                    <div class="col-12 col-lg-4 my-1">
                        <label for="mother_job" class="form-label">عمل الأم / الزوجة</label>
                        <select name="mother_job" id="mother_job" class="mt-2">
                            <option @if (old('mother_job', '') == 'ربة منزل') selected @endif value="ربة منزل">ربة منزل
                            </option>
                            <option @if (old('mother_job', '') == 'متقاعدة') selected @endif value="متقاعدة">متقاعدة
                            </option>
                            <option @if (old('mother_job', '') == 'قطاع حكومي') selected @endif value="قطاع حكومي">قطاع حكومي
                            </option>
                            <option @if (old('mother_job', '') == 'قطاع خاص') selected @endif value="قطاع خاص">قطاع خاص
                            </option>
                            <option @if (old('mother_job', '') == 'أعمال حرة') selected @endif value="أعمال حرة">أعمال حرة
                            </option>
                            <option @if (old('mother_job', '') == 'فاقد للمعيل') selected @endif value="فاقد للمعيل"> فاقد
                                للمعيل
                            </option>
                        </select>
                    </div>

                    <div class="col-12 col-lg-4 my-1" id="military_status_div">
                        <label for="military_status" class="form-label">حالة التجنيد</label>
                        <select name="military_status" id="military_status" class="mt-2">
                            <option @if (old('military_status', '') == 'معفى') selected @endif value="معفى">معفى </option>
                            <option @if (old('military_status', '') == 'مسرح') selected @endif value="مسرح">مسرّح </option>
                            <option @if (old('military_status', '') == 'معفى وحيد') selected @endif value="معفى وحيد">معفى وحيد
                            </option>
                            <option @if (old('military_status', '') == 'لم يخدم/مؤجل') selected @endif value="لم يخدم/مؤجل">لم يخدم /
                                مؤجل
                            </option>
                        </select>
                    </div>

                    <div class="col-12 col-lg-4 my-1">
                        <label for="city" class="form-label">المحافظة </label>
                        <select name="city" id="city" class="mt-2">
                            <option @if (old('city', '') == 'طرطوس') selected @endif value="طرطوس">طرطوس </option>
                            <option @if (old('city', '') == 'اللاذقية') selected @endif value="اللاذقية">اللاذقية
                            </option>
                            <option @if (old('city', '') == 'دمشق') selected @endif value="دمشق">دمشق</option>
                            <option @if (old('city', '') == 'ريف دمشق') selected @endif value="ريف دمشق">ريف دمشق
                            </option>
                            <option @if (old('city', '') == 'حمص') selected @endif value="حمص">حمص</option>
                            <option @if (old('city', '') == 'حماة') selected @endif value="حماة">حماة</option>
                            <option @if (old('city', '') == 'حلب') selected @endif value="حلب">حلب</option>
                            <option @if (old('city', '') == 'ادلب') selected @endif value="ادلب">ادلب</option>
                            <option @if (old('city', '') == 'السويداء') selected @endif value="السويداء">السويداء
                            </option>
                            <option @if (old('city', '') == 'درعا') selected @endif value="درعا">درعا</option>
                            <option @if (old('city', '') == 'القنيطرة') selected @endif value="القنيطرة">القنيطرة
                            </option>
                            <option @if (old('city', '') == 'دير الزور') selected @endif value="دير الزور">دير الزور
                            </option>
                            <option @if (old('city', '') == 'الحسكة') selected @endif value="الحسكة">الحسكة</option>
                            <option @if (old('city', '') == 'الرقة') selected @endif value="الرقة">الرقة</option>
                        </select>
                    </div>

                    <div class="col-12 col-lg-8 my-1">
                        <label for="address" class="form-label">العنوان </label>
                        <input type="text" class="form-control" name="address" id="address"
                            @if (!$errors->get('address')) value="{{ old('address', '') }}" @endif>
                        @error('address')
                            <div class="error text-danger">{{ $errors->first('address') }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-lg-4 my-1">
                        <label for="location_status" class="form-label">حالة السكن </label>
                        <select name="location_status" id="location_status" class="mt-2">
                            <option @if (old('location_status', '') == 'مقيم') selected @endif value="مقيم">مقيم </option>
                            <option @if (old('location_status', '') == 'وافد') selected @endif value="وافد">وافد </option>
                        </select>
                    </div>

                    <div class="col-12 col-lg-4 my-1">
                        <label for="phone1" class="form-label">رقم الموبايل</label>
                        <input type="number" class="form-control" name="phone1" id="phone1"
                            @if (!$errors->get('phone1')) value="{{ old('phone1', '') }}" @endif>
                        <ul>
                            @foreach ($errors->get('phone1') as $error)
                                <li class="error text-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="col-12 col-lg-4 my-1">
                        <label for="phone2" class="form-label">رقم الموبايل الثاني</label>
                        <input type="number" class="form-control" name="phone2" id="phone2"
                            @if (!$errors->get('phone2')) value="{{ old('phone2', '') }}" @endif>
                        <ul>
                            @foreach ($errors->get('phone2') as $error)
                                <li class="error text-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="col-12 col-lg-4 my-1">
                        <label for="national_id" class="form-label">الرقم الوطني</label>
                        <input type="number" class="form-control" name="national_id" id="national_id"
                            @if (!$errors->get('national_id')) value="{{ old('national_id', '') }}" @endif>
                        @error('national_id')
                            <div class="error text-danger">{{ $errors->first('national_id') }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="card my-3">
            <div class="card-header text-center text-white bg-primary">
                <h5>بيانات التعليم </h5>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-12 col-lg-4 my-1">
                        <label for="education_certificate" class="form-label"> نوع الشهادة</label>
                        <select name="education_certificate" id="education_certificate" class="mt-2">
                            <option @if (old('education_certificate', '') == 'دراسات عليا') selected @endif value="دراسات عليا">دراسات عليا
                            </option>
                            <option @if (old('education_certificate', '') == 'جامعي') selected @endif value="جامعي">جامعي </option>
                            <option @if (old('education_certificate', '') == 'معهد') selected @endif value="معهد"> معهد</option>
                            <option @if (old('education_certificate', '') == 'تعليم ثانوي') selected @endif value="تعليم ثانوي">تعليم ثانوي
                            </option>
                            <option @if (old('education_certificate', '') == 'تعليم أساسي') selected @endif value="تعليم أساسي">تعليم أساسي
                            </option>
                        </select>
                    </div>

                    <div class="col-12 col-lg-4 my-1" id="education_field_div">
                        <label for="education_field" class="form-label"> التخصص </label>
                        <input type="text" class="form-control" name="education_field" id="education_field"
                            @if (!$errors->get('education_field')) value="{{ old('education_field', '') }}" @endif>
                        @error('education_field')
                            <div class="error text-danger">{{ $errors->first('education_field') }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-lg-4 my-1">
                        <label for="date_of_certificate" class="form-label"> تاريخ الشهادة</label>
                        <input type="number" class="form-control" name="date_of_certificate" id="date_of_certificate"
                            @if (!$errors->get('date_of_certificate')) value="{{ old('date_of_certificate', '') }}" @endif>
                        @error('date_of_certificate')
                            <div class="error text-danger">{{ $errors->first('date_of_certificate') }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-lg-4 my-1" id="graduated_div">
                        <label for="graduated" class="form-label"> هل أنت متخرج؟</label>
                        <select name="graduated" id="graduated" class="mt-2">
                            <option @if (old('graduated', '') == 0) selected @endif value=0>لا</option>
                            <option @if (old('graduated', '') == 1) selected @endif value=1>نعم</option>
                        </select>
                    </div>

                    <div class="col-12 col-lg-4 my-1" id="university_year_div">
                        <label for="university_year" class="form-label"> السنة الدراسية (في حال عدم التخرج) </label>
                        <select name="university_year" id="university_year" class="mt-2">
                            <option @if (old('university_year', '') == 5) selected @endif value=5>الأخيرة</option>
                            <option @if (old('university_year', '') == 4) selected @endif value=4>الرابعة</option>
                            <option @if (old('university_year', '') == 3) selected @endif value=3>الثالثة</option>
                            <option @if (old('university_year', '') == 2) selected @endif value=2>الثانية</option>
                            <option @if (old('university_year', '') == 1) selected @endif value=1>الأولى</option>
                        </select>
                    </div>

                    <div class="col-12 col-lg-4 my-1">
                        <label for="icdl" class="form-label"> هل تملك شهادة قيادةالحاسب؟ </label>
                        <select name="icdl" id="icdl" class="mt-2">
                            <option @if (old('icdl', '') == 0) selected @endif value=0>لا</option>
                            <option @if (old('icdl', '') == 1) selected @endif value=1>نعم</option>
                        </select>
                    </div>

                    <div class="col-12 col-lg-4 my-1">
                        <label for="other_certificates" class="form-label"> ما هي الشهادات الأخرى في الحاسب؟</label>
                        <input type="text" class="form-control" name="other_certificates" id="other_certificates"
                            @if (!$errors->get('other_certificates')) value="{{ old('other_certificates', '') }}" @endif>
                        @error('other_certificates')
                            <div class="error text-danger">{{ $errors->first('other_certificates') }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-lg-4 my-1">
                        <label for="previous_courses" class="form-label"> الدورات التدريبية السابقة</label>
                        <input type="text" class="form-control" name="previous_courses" id="previous_courses"
                            @if (!$errors->get('previous_courses')) value="{{ old('previous_courses', '') }}" @endif>
                        @error('previous_courses')
                            <div class="error text-danger">{{ $errors->first('previous_courses') }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-lg-4 my-1">
                        <label for="beneficial_undp" class="form-label"> هل أستفدت سابقاً من أحد مشاريع UNDP?</label>
                        <select name="beneficial_undp" id="beneficial_undp" class="mt-2">
                            <option @if (old('beneficial_undp', '') == 0) selected @endif value=0>لا</option>
                            <option @if (old('beneficial_undp', '') == 1) selected @endif value=1>نعم</option>
                        </select>
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
                        <label for="current_volunteer" class="form-label"> هل أنت متطوع حالي في أي جمعية
                            أهلية؟</label>
                        <select name="current_volunteer" id="current_volunteer" class="mt-2">
                            <option @if (old('current_volunteer', '') == 0) selected @endif value=0>لا</option>
                            <option @if (old('current_volunteer', '') == 1) selected @endif value=1>نعم</option>
                        </select>
                    </div>

                    <div class="col-12 col-lg-4 my-1" id="organization_name_div">
                        <label for="organization_name" class="form-label"> اسم الجمعية الأهلية</label>
                        <input type="text" class="form-control" name="organization_name" id="organization_name"
                            @if (!$errors->get('organization_name')) value="{{ old('organization_name', '') }}" @endif>
                        @error('organization_name')
                            <div class="error text-danger">{{ $errors->first('organization_name') }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-lg-4 my-1">
                        <label for="previous_experiences" class="form-label"> الخبرات المهنية السابقة </label>
                        <input type="text" class="form-control" name="previous_experiences" id="previous_experiences"
                            @if (!$errors->get('previous_experiences')) value="{{ old('previous_experiences', '') }}" @endif>
                        @error('previous_experiences')
                            <div class="error text-danger">{{ $errors->first('previous_experiences') }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-lg-4 my-1">
                        <label for="work_now" class="form-label"> هل تعمل حالياً؟</label>
                        <select name="work_now" id="work_now" class="mt-2">
                            <option @if (old('work_now', '') == 0) selected @endif value=0>لا</option>
                            <option @if (old('work_now', '') == 1) selected @endif value=1>نعم</option>
                        </select>
                    </div>

                    <div class="col-12 col-lg-4 my-1" id="current_job_div">
                        <label for="current_job" class="form-label">العمل الحالي</label>
                        <input type="text" class="form-control" name="current_job" id="current_job"
                            @if (!$errors->get('current_job')) value="{{ old('current_job', '') }}" @endif>
                        @error('current_job')
                            <div class="error text-danger">{{ $errors->first('current_job') }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-lg-4 my-1">
                        <label for="favorite_job" class="form-label">هل تفضل العمل ضمن: </label>
                        <select name="favorite_job" id="favorite_job" class="mt-2">
                            <option @if (old('favorite_job', '') == 'قطاع خاص') selected @endif value="قطاع خاص">قطاع خاص
                            </option>
                            <option @if (old('favorite_job', '') == 'قطاع عام') selected @endif value="قطاع عام">قطاع عام
                            </option>
                            <option @if (old('favorite_job', '') == 'افتتاح مشروع صغير') selected @endif value="افتتاح مشروع صغير">
                                افتتاح
                                مشروع صغير</option>
                        </select>
                    </div>

                    <div class="col-12 col-lg-4 my-1">
                        <label for="course_chosen_id" class="form-label">الدورة التي ترغب بالتسجيل بها</label>
                        <select name="course_chosen_id" id="course_chosen_id" class="mt-2">
                            @foreach ($courses as $course)
                            <option value="{{$course->id}}">{{$course->name}}</option>                                
                            @endforeach
                        </select>
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

                    <div class="col-12 col-lg-2 my-1">
                        <label for="fragility_father_job" class="form-label">عمل الأب</label>
                        <input type="number" class="form-control" name="fragility_father_job" id="fragility_father_job"
                            @if (!$errors->get('fragility_father_job')) value="{{ old('fragility_father_job', '') }}" @endif>
                        @error('fragility_father_job')
                            <div class="error text-danger">{{ $errors->first('fragility_father_job') }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-lg-2 my-1">
                        <label for="fragility_mother_job" class="form-label">عمل الأم</label>
                        <input type="number" class="form-control" name="fragility_mother_job" id="fragility_mother_job"
                            @if (!$errors->get('fragility_mother_job')) value="{{ old('fragility_mother_job', '') }}" @endif>
                        @error('fragility_mother_job')
                            <div class="error text-danger">{{ $errors->first('fragility_mother_job') }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-lg-2 my-1">
                        <label for="fragility_disability" class="form-label">الإعاقة</label>
                        <input type="number" class="form-control" name="fragility_disability" id="fragility_disability"
                            @if (!$errors->get('fragility_disability')) value="{{ old('fragility_disability', '') }}" @endif>
                        @error('fragility_disability')
                            <div class="error text-danger">{{ $errors->first('fragility_disability') }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-lg-2 my-1">
                        <label for="fragility_family_member" class="form-label">عدد أفراد الأسرة</label>
                        <input type="number" class="form-control" name="fragility_family_member"
                            id="fragility_family_member"
                            @if (!$errors->get('fragility_family_member')) value="{{ old('fragility_family_member', '') }}" @endif>
                        @error('fragility_family_member')
                            <div class="error text-danger">{{ $errors->first('fragility_family_member') }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-lg-2 my-1">
                        <label for="fragility_family_worker" class="form-label">عدد المعيلين </label>
                        <input type="number" class="form-control" name="fragility_family_worker"
                            id="fragility_family_worker"
                            @if (!$errors->get('fragility_family_worker')) value="{{ old('fragility_family_worker', '') }}" @endif>
                        @error('fragility_family_worker')
                            <div class="error text-danger">{{ $errors->first('fragility_family_worker') }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-lg-2 my-1">
                        <label for="fragility_military" class="form-label">التجنيد - مسرح </label>
                        <input type="number" class="form-control" name="fragility_military" id="fragility_military"
                            @if (!$errors->get('fragility_military')) value="{{ old('fragility_military', '') }}" @endif>
                        @error('fragility_military')
                            <div class="error text-danger">{{ $errors->first('fragility_military') }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <input type="hidden" class="form-control" name="final_result" id="final_result">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">ملاحظات</label>
                        <textarea type="number" class="form-control" name="description" id="description">
                            {{ old('description', '') }}
                        </textarea>
                        @error('description')
                            <div class="error text-danger">{{ $errors->first('description') }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-secondary w-50">إضافة</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        new TomSelect("#gender", {});
        new TomSelect("#marital_status", {});
        new TomSelect("#disability", {});
        new TomSelect("#disability_company", {});
        new TomSelect("#family_disability", {});
        new TomSelect("#father_job", {});
        new TomSelect("#mother_job", {});
        new TomSelect("#military_status", {});
        new TomSelect("#city", {});
        new TomSelect("#location_status", {});
        new TomSelect("#education_certificate", {});
        new TomSelect("#graduated", {});
        new TomSelect("#university_year", {});
        new TomSelect("#icdl", {});
        new TomSelect("#beneficial_undp", {});
        new TomSelect("#current_volunteer", {});
        new TomSelect("#work_now", {});
        new TomSelect("#favorite_job", {});
        new TomSelect("#course_chosen_id", {});

        $(document).ready(function() {

            if ($('#gender').val() == 'أنثى') $('#military_status_div').hide();
            $('#gender').change(function() {
                if ($(this).val() == 'أنثى') {
                    $('#military_status_div').hide();
                } else {
                    $('#military_status_div').show();
                }
            });

            if ($('#disability').val() == 0) $('#disability_company_div').hide();
            if ($('#disability').val() == 0) $('#disability_type_div').hide();
            $('#disability').change(function() {
                if ($(this).val() == 0) {
                    $('#disability_type_div').hide();
                    $('#disability_company_div').hide();
                } else {
                    $('#disability_type_div').show();
                    $('#disability_company_div').show();
                }
            });

            if ($('#family_disability').val() == 0) $('#family_disability_type_div').hide();
            $('#family_disability').change(function() {
                if ($(this).val() == 0) {
                    $('#family_disability_type_div').hide();
                } else {
                    $('#family_disability_type_div').show();
                }
            });

            if ($('#work_now').val() == 0) $('#current_job_div').hide();
            $('#work_now').change(function() {
                if ($(this).val() == 0) {
                    $('#current_job_div').hide();
                } else {
                    $('#current_job_div').show();
                }
            });

            if ($('#current_volunteer').val() == 0) $('#organization_name_div').hide();
            $('#current_volunteer').change(function() {
                if ($(this).val() == 0) {
                    $('#organization_name_div').hide();
                } else {
                    $('#organization_name_div').show();
                }
            });


            if ($('#education_certificate').val() == "تعليم أساسي") {
                $('#education_field_div').hide();
                $('#graduated_div').hide();
                $('#university_year_div').hide();
            } else {
                if ($('#education_certificate').val() == "تعليم ثانوي") {
                    $('#education_field_div').show();
                    $('#graduated_div').hide();
                    $('#university_year_div').hide();
                } else {
                    $('#education_field_div').show();
                    $('#graduated_div').show();
                    $('#university_year_div').show();
                }
            }
            $('#education_certificate').change(function() {
                if ($(this).val() == "تعليم أساسي") {
                    $('#education_field_div').hide();
                    $('#graduated_div').hide();
                    $('#university_year_div').hide();
                } else {
                    if ($(this).val() == "تعليم ثانوي") {
                        $('#education_field_div').show();
                        $('#graduated_div').hide();
                        $('#university_year_div').hide();
                    } else {
                        $('#education_field_div').show();
                        $('#graduated_div').show();
                        $('#university_year_div').show();
                    }
                }
            });

            if ($('#graduated').val() == 1) $('#university_year_div').hide();
            $('#graduated').change(function() {
                if ($(this).val() == 0) {
                    $('#university_year_div').show();
                } else {
                    $('#university_year_div').hide();
                }
            });
        });
    </script>
@endsection
