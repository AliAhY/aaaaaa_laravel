@extends('layout')

@section('cssAndJs')
    <link rel="stylesheet" href="{{ asset('filepond/filepond.min.css') }}">

    <style>
        .status-message {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 65px;
            /* ارتفاع المنطقة */
            font-size: 24px;
            /* حجم الخط */
            color: white;
            /* لون الخط */
            margin: 20px 0;
            /* هامش أعلى وأسفل */
            border-radius: 8px;
            /* زوايا دائرية */
        }

        .completed {
            background-color: green;
            /* لون الخلفية للكورس المكتمل */
        }

        .not-completed {
            background-color: red;
            /* لون الخلفية للكورس غير المكتمل */
        }
    </style>

    <script src="{{ asset('filepond/filepond.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
@endsection

@section('main')
    <div class="card">
        <div class="card-header text-center">كورس {{ $course->name }}</div>
        <div class="status-message {{ $num_of_hours_remaining == 0 ? 'completed' : 'not-completed' }}">
            @if ($num_of_hours_remaining == 0)
                اكتمل الكورس
            @else
                لم يكتمل الكورس بعد
            @endif
        </div>
        <div class="card-body">

            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th> الاسم</th>
                        <th>عدد مرات الحضور</th>
                        <th>عدد الغيابات</th>
                        <th>الغيابات المبررة</th>
                        <th> عدد الجلسات المعطى</th>
                        <th>نسبة الحضور</th>
                        <th> حقق 80% حضور ؟</th>
                        <th> الشهادة</th>
                    </tr>
                </thead>


                <tbody>
                    @foreach ($course_members as $member)
                        <tr>
                            <td>{{ $member->member->full_name }}</td>
                            <td>
                                {{ $member->attendance }}
                            </td>
                            <td>
                                {{ $member->missed }}
                            </td>
                            <td>
                                {{ $member->missed_legal }}
                            </td>
                            <td>
                                {{ $count_of_session }}
                            </td>
                            <td>
                                @if ($count_of_session)
                                    {{ (((int) $member->attendance + (int) $member->missed_legal) * 100) / $count_of_session }}
                                    %
                                @else
                                    لايوجد
                                @endif
                            </td>
                            <td>
                                @if ((((int) $member->attendance + (int) $member->missed_legal) * 100) / $count_of_session >= 80)
                                    نعم
                                @else
                                    لا
                                @endif
                            </td>
                            <td>
                                @if ((((int) $member->attendance + (int) $member->missed_legal) * 100) / $count_of_session >= 80 && $num_of_hours_remaining == 0)
                                    <input type="file">
                                @else
                                     غير مستحق
                                @endif
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
