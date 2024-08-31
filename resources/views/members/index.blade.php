@extends('layout')

@section('main')
    <a class="btn btn-secondary" href="{{ url('members/create') }}">
        <i class="fa-solid fa-plus-square mx-2"></i>تسجيل شخص جديد</a>

    <a class="btn btn-secondary" href="{{ route('importform') }}">
        <i class="fa-solid fa-plus-square mx-2"></i>تحميل ملف إكسل</a>

    <div class="card my-4">
        <div class="card-header text-center">
            <h5>جدول بيانات المسجلين</h5>
        </div>
        {{-- style="overflow-x: auto;max-width: 100%;" --}}
        <div class="card-body">

            <table id="myTable" class="display" class="display nowrap" style="width:100%">

                <thead>
                    <tr>
                        <th scope="col">الاسم الثلاثي</th>
                        <th scope="col">اسم الأب</th>
                        <th scope="col">اسم الأم</th>
                        <th scope="col">اسم الدورة</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($members as $member)
                        <tr>
                            <td>{{ $member->full_name }}</td>
                            <td>{{ $member->father_name }}</td>
                            <td>{{ $member->mother_name }}</td>
                            <td>{{ $member->mother_name }}</td>

                            <td>
                                <form action="{{ route('members.destroy', [$member->id]) }}" method="post">
                                    @csrf
                                    @method('delete')

                                    <a href="{{ route('members.show', $member->id) }}" class="btn btn-success mx-2">
                                        <i class="fa-solid fa-eye mx-2"></i>
                                    </a>

                                    <a href="{{ url('members/' . $member->id . '/edit') }}" class="btn btn-success ">
                                        <i class="fa-solid fa-edit mx-2 text-white"></i>
                                    </a>

                                    <button type="submit" class="btn btn-danger ">
                                        <i class="fa-solid fa-trash mx-2 text-white"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

            <script>
                let table = new DataTable('#myTable', {
                    // config options...
                });
            </script>
        @endsection
