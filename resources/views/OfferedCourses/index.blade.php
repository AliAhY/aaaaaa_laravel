@extends('layout')

@section('main')
    <div class="card">
        <div class="card-header text-center">الدورات المتوفرة</div>
        <div class="card-body">
            <a class="btn btn-secondary" href="{{ url('/offered_courses/create') }}">اضافة دورة</a>
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>تعديل / حذف</th>
                    </tr>
                </thead>


                <tbody>
                    @foreach ($offerdcourses as $offerdcourse)
                        <tr>
                            <td>{{ $offerdcourse->name }}</td>
                            <td>
                                <form action="{{ route('offered_courses.destroy', $offerdcourse->id) }}" method="post">
                                    @csrf
                                    @method('delete')

                                    <a href="{{ route('offered_courses.edit', $offerdcourse->id) }}"
                                        class="btn btn-primary mx-2">
                                        <i class="fa-solid fa-edit mx-2"></i>
                                    </a>

                                    <button type="submit" class="btn btn-danger mx-2"><i
                                            class="fa-solid fa-trash mx-2"></i>
                                    </button>
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
    </script>
@endsection
