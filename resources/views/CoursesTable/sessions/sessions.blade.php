@extends('layout')

@section('cssAndJs')
    <link rel="stylesheet" href="{{ asset('filepond/filepond.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fordate/jquery-ui.css') }}" />

    <script src="{{ asset('filepond/filepond.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/fordate/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/fordate/datepicker-ar.js') }}"></script>
@endsection

@section('main')
    @if ($num_of_hours_remaining > 0)
        <form action="{{ url("/course/$id/add_session") }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card">

                <div class="card-header text-center bg-secondary text-white">
                    <h5>كورس {{ $course->name }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="date_of_day" class="form-label">تاريخ الجلسة </label>
                        <input type="text" style="width:500px" class="form-control" name="date_of_day" id="date_of_day"
                            @if (!$errors->get('date_of_day')) value="{{ old('date_of_day', '') }}" @endif>
                        @error('date_of_day')
                            <div class="error text-danger">{{ $errors->first('date_of_day') }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="num_of_sess" class="form-label">عدد الساعات المعطاة في هذه الجلسة </label>
                        <input type="number" style="width:500px" class="form-control" name="number_of_hours"
                            id="number_of_hours"
                            @if (!$errors->get('number_of_hours')) value="{{ old('number_of_hours', '') }}" @endif>

                        @error('number_of_hours')
                            <div class="error text-danger">{{ $errors->first('number_of_hours') }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-secondary w-50">اضافة</button>
                    </div>
                </div>
            </div>
        </form>
    @else
        <div class="card">

            <div class="card-header text-center bg-secondary text-white">
                <h5>كورس {{ $course->name }}</h5>
            </div>
    @endif
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-3 col-sm-6 mb-4"> <!-- تباعد متساوي بين الأعمدة -->
                <div class="card h-100">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fa-solid fa-calendar opacity-10" style="color: #3befff;"></i>
                        </div>
                        <div class="text-start pt-1">
                            <p class="text-sm mb-0 text-capitalize">عدد الجلسات</p>
                            <h4 class="mb-0">{{ $count_of_session }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0 text-start">
                            <span class="text-success text-sm font-weight-bolder ms-1">
                                @php
                                    use Carbon\Carbon;

                                    Carbon::setLocale('ar');

                                    if ($date_sess_from) {
                                        $date = Carbon::parse($date_sess_from->date_of_day);
                                        $diff = $date->format('Y-m-d');;
                                        $message_date =  $date;
                                        $message = "بدأ الكورس  $diff";
                                    } else {
                                        $message = 'ليس هناك أي جلسة';
                                    }
                                @endphp
                            </span>
                            {{ $message }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 mb-4"> <!-- تباعد متساوي بين الأعمدة -->
                <div class="card h-100">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fa-solid fa-clock opacity-10" style="color: #11e24c;"></i>
                        </div>
                        <div class="text-start pt-1">
                            <p class="text-sm mb-0 text-capitalize">اجمالي عدد الساعات</p>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0 text-start">
                            <span class="text-success text-sm font-weight-bolder ms-1">{{ $totalHours }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 mb-4"> <!-- تباعد متساوي بين الأعمدة -->
                <div class="card h-100">
                    <div class="card-header p-3 pt-2">
                        <div class="text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fa-solid fa-hourglass-half opacity-10" style="color: #ffb73b;"></i>
                        </div>
                        <div class="text-start pt-1">
                            <p class="text-sm mb-0 text-capitalize">عدد الساعات المتبقية</p>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0 text-start">
                            <span class="text-success text-sm font-weight-bolder ms-1">{{ $num_of_hours_remaining }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 mb-4"> <!-- تباعد متساوي بين الأعمدة -->
                <div class="card h-100">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fa-solid fa-cog opacity-10"></i>
                        </div>
                        <div class="text-start pt-1">
                            <p class="text-sm mb-0 text-capitalize">اجمالي التنفيذ</p>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0 text-start">
                            <span class="text-success text-sm font-weight-bolder ms-1">{{ $percentage_completion }}
                                %</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 mb-4"> <!-- تباعد متساوي بين الأعمدة -->
                <div class="card h-100">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fa-solid fa-percent opacity-10 text-success"></i>
                        </div>
                        <div class="text-start pt-1">
                            <p class="text-sm mb-0 text-capitalize"> نسبة حضور المسجلين </p>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0 text-start">
                            <span class="text-success text-sm font-weight-bolder ms-1"><a
                                    href="{{ url('courses/' . $course->id . '/attendance_rate') }}"
                                    class="text-success">اضغط
                                    هنا</a></span>
                        </p>
                    </div>
                </div>
            </div>

            @if ($num_of_hours_remaining <= 0)
                <div class="col-lg-3 col-sm-6 mb-4"> <!-- تباعد متساوي بين الأعمدة -->
                    <div class="card h-100">
                        <div class="card-header p-3 pt-2 bg-success text-white">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                <i class="fa-solid fa-check-circle opacity-10"></i>
                            </div>
                            <div class="text-start pt-1">
                                <p class="text-sm mb-0 text-capitalize">تم اكمال الكورس بنجاح</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="card">
        <div class="card-header text-center">الجلسات</div>
        <div class="card-body">

            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>رقم الجلسة</th>
                        <th>التاريخ</th>
                        <th>عدد الساعات</th>
                        <th>الحضور</th>
                        <th>تم تأكيد الحضور؟</th>
                        <th>حذف</th>
                    </tr>
                </thead>


                <tbody>
                    <?php $id = 1; ?>
                    @foreach ($days as $day)
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td>{{ $day->date_of_day }}</td>
                            <td>{{ $day->number_of_hours }}</td>
                            <td>
                                <a href="{{ route('courses.audience.show', ['course' => $course->id, 'day' => $day->id]) }}"
                                    class="btn btn-success mx-2"><i class="fa-solid fa-users mx-2"></i>
                                </a>
                            </td>
                            <td>
                                @if (isset($attendanceMessages[$day->id]))
                                    @if (strpos($attendanceMessages[$day->id], 'لم يتم اضافة تفقد .') !== false)
                                        <span class="text-danger"> <!-- استخدم class text-danger من Bootstrap -->
                                            <i class="fa-solid fa-times-circle"></i>
                                            {{ $attendanceMessages[$day->id] }}
                                        </span>
                                    @else
                                        <span class="text-success"> <!-- حالة أخرى يمكن أن تكون إيجابية -->
                                            <i class="fa-solid fa-check-circle"></i>
                                            {{ $attendanceMessages[$day->id] }}
                                        </span>
                                    @endif
                                @else
                                    <span>لا توجد معلومات</span>
                                @endif
                            </td>
                            <td>
                                <form id="delete-form-{{ $day->id }}"
                                    action="{{ route('sessions.destroy', $day->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger mx-2"
                                        onclick="confirmDelete({{ $day->id }})">
                                        <i class="fa-solid fa-trash mx-2"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php $id++; ?>
                    @endforeach
                </tbody>

        </div>
    </div>



    <script>
        let table = new DataTable('#myTable', {
            // config options
        });


        $(function() {
            // تعيين الإعدادات الإقليمية للغة العربية  
            $.datepicker.setDefaults($.datepicker.regional['ar']);

            $("#date_of_day").datepicker({
                dateFormat: 'yy-mm-dd', // تنسيق التاريخ  
                changeMonth: true,
                changeYear: true
            });
        });

        function confirmDelete(dayId) {
            Swal.fire({
                title: 'هل أنت متأكد من حذف هذه الجلسة؟',
                // text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'نعم، احذف',
                cancelButtonText: 'لا، ألغِ'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + dayId).submit();
                }
            });
        }
    </script>
@endsection
