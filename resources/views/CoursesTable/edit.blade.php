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
    <form action="{{ route('courses.update', $courses->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header text-center bg-secondary text-white">
                <h5>تعديل الدورة</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="name" class="form-label">اسم الدورة</label>
                    <input type="text" style="width:500px" class="form-control" name="name" id="name"
                        value="{{ $courses->name }}">
                    @error('name')
                        <div class="error text-danger">{{ $errors->first('name') }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="start_date" class="form-label">تاريخ البدء</label>
                    <input type="text" style="width:500px" class="form-control" name="start_date" id="start_date"
                        value="{{ $courses->start_date }}">
                    @error('start_date')
                        <div class="error text-danger">{{ $errors->first('start_date') }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="end_date" class="form-label">تاريخ الانتهاء</label>
                    <input type="text" style="width:500px" class="form-control" name="end_date" id="end_date"
                        value="{{ $courses->end_date }}">
                    @error('end_date')
                        <div class="error text-danger">{{ $errors->first('end_date') }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="num_of_sess" class="form-label">عدد الجلسات المتوقع</label>
                    <input type="number" style="width:500px" class="form-control" name="num_of_sess" id="num_of_sess"
                        value="{{ $courses->num_of_sess }}">
                    @error('num_of_sess')
                        <div class="error text-danger">{{ $errors->first('num_of_sess') }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="number_of_hours" class="form-label">عدد الساعات الكلي</label>
                    <input type="number" style="width:500px" class="form-control" name="number_of_hours"
                        id="number_of_hours" value="{{ $courses->number_of_hours }}">

                    @error('num_of_sess')
                        <div class="error text-danger">{{ $errors->first('number_of_hours') }}</div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="resoureceName" class="form-label">حالة الدورة</label>
                    <select class="form-select" name="status" style="width: 500px">
                        <option value="قيد التحضير" @if ($courses->status == 'قيد التحضير') selected @endif>قيد التحضير</option>
                        <option value="قيد التنفيذ" @if ($courses->status == 'قيد التنفيذ') selected @endif>قيد التنفيذ</option>
                        <option value="مكتمل" @if ($courses->status == 'مكتمل') selected @endif>مكتمل</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">محتوى الدورة</label>
                    <textarea class="form-control" name="content" id="content" rows="3" cols="5">{{ $courses->content }}</textarea>
                    @error('content')
                        <div class="error text-danger">{{ $errors->first('content') }}</div>
                    @enderror
                </div>

                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-secondary w-50">تحديث</button>
                </div>

            </div>
    </form>

    <script>
        $(function() {
            // تعيين الإعدادات الإقليمية للغة العربية  
            $.datepicker.setDefaults($.datepicker.regional['ar']);

            $("#start_date").datepicker({
                dateFormat: 'yy-mm-dd', // تنسيق التاريخ  
                changeMonth: true,
                changeYear: true
            });
            $("#end_date").datepicker({
                dateFormat: 'yy-mm-dd', // تنسيق التاريخ  
                changeMonth: true,
                changeYear: true
            });
        });
    </script>
@endsection
