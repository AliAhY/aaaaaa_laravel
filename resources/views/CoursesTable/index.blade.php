@extends('layout')

@section('main')
    <div class="card">
        <div class="card-header text-center">الدورات المعروضة</div>
        <div class="card-body">
            <a class="btn btn-secondary" href="{{ url('/courses/create') }}">اضافة دورة</a>
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        {{-- <th>الوصف</th> --}}
                        <th>تاريخ البدء</th>
                        <th>تاريخ الانتئهاء</th>
                        <th>عدد الجلسات المتوقع</th>
                        <th>الحالة</th>
                        <th>عدد الساعات الكلي</th>
                        <th> تعديل / حذف /المسجلين / الجلسات</th>
                    </tr>
                </thead>


                <tbody>
                    @foreach ($allcourses as $course)
                        <tr>
                            <td>{{ $course->name }}</td>
                            {{-- <td>{{ $course->content }}</td> --}}
                            <td>{{ $course->start_date }}</td>
                            <td>{{ $course->end_date }}</td>
                            <td>{{ $course->num_of_sess }}</td>
                            <td>{{ $course->status }}</td>
                            <td>{{ $course->number_of_hours }}</td>
                            <td>
                                <form id="delete-form-{{ $course->id }}"
                                    action="{{ route('courses.destroy', $course->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-primary mx-2">
                                        <i class="fa-solid fa-edit mx-2"></i>
                                    </a>

                                    <button type="button" class="btn btn-danger mx-2"
                                        onclick="confirmDelete({{ $course->id }})">
                                        <i class="fa-solid fa-trash mx-2"></i>
                                    </button>

                                    <a href="{{ url('course/' . $course->id . '/members') }}"
                                        class="btn btn-warning mx-2"><i class="fa-solid fa-users mx-2"></i>
                                    </a>

                                    <a href="{{ url('course/' . $course->id . '/sessions') }}"
                                        class="btn btn-secondary mx-2"><i class="fa-solid fa-chair mx-2"></i>
                                    </a>
                                </form>

                            </td>
                        </tr>
                    @endforeach

                </tbody>

        </div>
    </div>



    <script>
        let table = new DataTable('#myTable', {
            // config options
        });



        function confirmDelete(courseId) {
            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "سيتم حذف هذه الدورة وكل البيانات التي تخصها!",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'نعم، احذفها!',
                cancelButtonText: 'لا، ألغِ'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + courseId).submit();
                }
            });
        }
    </script>
@endsection
