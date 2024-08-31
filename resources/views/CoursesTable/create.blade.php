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

    <form action="{{ route('courses.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header text-center bg-secondary text-white">
                <h5>اضافة دورة تدريبية</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="name" class="form-label">اسم الدورة</label>
                    <input type="text" style="width:500px" class="form-control" name="name" id="name"  @if (!$errors->get('name')) value="{{ old('name', '') }}" @endif>
                        @error('name')
                            <div class="error text-danger">{{ $errors->first('name') }}</div>
                        @enderror
                </div>
                <div class="mb-3">
                    <label for="start_date" class="form-label">تاريخ البدء</label>
                    <input type="text" style="width:500px" class="form-control" name="start_date" id="start_date" @if (!$errors->get('start_date')) value="{{ old('start_date', '') }}" @endif>
                    @error('start_date')
                        <div class="error text-danger">{{ $errors->first('start_date') }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="end_date" class="form-label">تاريخ الانتهاء</label>
                    <input type="text" style="width:500px" class="form-control" name="end_date" id="end_date" @if (!$errors->get('end_date')) value="{{ old('end_date', '') }}" @endif>
                    @error('end_date')
                        <div class="error text-danger">{{ $errors->first('end_date') }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="num_of_sess" class="form-label">عدد الجلسات المتوقع</label>
                    <input type="number" style="width:500px" class="form-control" name="num_of_sess" id="num_of_sess" @if (!$errors->get('num_of_sess')) value="{{ old('num_of_sess', '') }}" @endif>

                    @error('num_of_sess')
                        <div class="error text-danger">{{ $errors->first('num_of_sess') }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="number_of_hours" class="form-label">عدد الساعات الكلي</label>
                    <input type="number" style="width:500px" class="form-control" name="number_of_hours" id="number_of_hours" @if (!$errors->get('number_of_hours')) value="{{ old('number_of_hours', '') }}" @endif>

                    @error('num_of_sess')
                        <div class="error text-danger">{{ $errors->first('number_of_hours') }}</div>
                    @enderror
                </div>



                <div class="mb-3">
                    <label for="resoureceName" class="form-label">حالة الدورة</label>
                    <select class="form-select" name="status" style="width: 500px" >
                        <option value="قيد التحضير">قيد التحضير</option>
                        <option value="قيد التنفيذ">قيد التنفيذ</option>
                        <option value="مكتمل">مكتمل</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">محتوى الدورة</label>
                    <textarea class="form-control" name="content" id="content" rows="3" cols="5" @if (!$errors->get('content')) value="{{ old('content', '') }}" @endif></textarea>
                    @error('content')
                        <div class="error text-danger">{{ $errors->first('content') }}</div>
                    @enderror
                </div>

                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-secondary w-50">اضافة</button>
                </div>
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
