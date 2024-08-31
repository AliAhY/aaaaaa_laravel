@extends('layout')

@section('main')

    <body>
        @if (session('success'))
            <p>{{ session('success') }}</p>
        @endif

        <form action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="file" class="form-label" style="font-size: 20px;font-weight:bold">تحميل ملف الإكسل</label>
            <input type="file" name="file" id="file" class="form-control my-3 w-50" required>
            <button type="submit" class="btn btn-secondary ">تحميل</button>
        </form>
    @endsection
