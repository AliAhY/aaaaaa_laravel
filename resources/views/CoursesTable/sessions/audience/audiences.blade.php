@extends('layout')

@section('main')
    <div class="container  mb-4">
        <h1>حضور الدورة</h1>

        @if ($courseMembers && $courseMembers->isNotEmpty())
            <form action="{{ route('courses.audience.update', ['course' => $courseId, 'day' => $dayId]) }}" method="POST">
                @csrf
                @method('PUT')
                <table class="table">
                    <thead>
                        <tr>
                            <th>اسم العضو</th>
                            <th>الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courseMembers as $member)
                            <tr>
                                <td>{{ $member->member->full_name }}</td>
                                <td>
                                    <select name="status[{{ $member->member->id }}]" class="form-control">
                                        <option value="0" {{ $member->status == '0' ? 'selected' : '' }}>غائب</option>
                                        <option value="1" {{ $member->status == '1' ? 'selected' : '' }}>حاضر</option>
                                        <option value="2" {{ $member->status == '2' ? 'selected' : '' }}>مبرر</option>
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="text-align:center;">
                    <button type="submit" class="btn btn-primary">تحديث الحضور</button>
                </div>
            </form>
        @else
            <div style="text-align:center;">
                <p>لا يوجد أعضاء في الدورة.</p>
            </div>
        @endif
    </div>

    <div class="card">
        <div class="card-header text-center">جدول الحضور</div>
        <div class="card-body">

            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>الحالة</th>
                    </tr>
                </thead>


                <tbody>
                    @foreach ($daysMembers as $dayMember)
                        <tr>
                            <td>{{ $dayMember->member->full_name }}</td>
                            <td> @switch($dayMember->status)
                                    @case(0)
                                        غائب
                                    @break

                                    @case(1)
                                        حاضر
                                    @break

                                    @case(2)
                                        مبرر
                                    @break

                                    @default
                                        غير محدد
                                @endswitch </td>
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
