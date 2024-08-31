@extends('layout')

@section('cssAndJs')
    <link rel="stylesheet" href="{{ asset('filepond/filepond.min.css') }}">

    <script src="{{ asset('filepond/filepond.min.js') }}"></script>
@endsection

@section('main')
    @if ($errors->any())
        <ol>
            @foreach ($errors->all() as $error)
                <li style="color: red;font-size: 28px">{{ $error }}</li>
            @endforeach
        </ol>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('offered_corses.update', $offered_corses->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        {{-- @method('PUT') --}}
        <div class="card">
            <div class="card-header text-center bg-secondary text-white">
                <h5>تعديل الدورة</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="name" class="form-label">تعديل اسم الدورة</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $offered_corses->name }}">
                </div>
                

                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-secondary w-50">تحديث</button>
                </div>
            </div>
        </div>
    </form>

@endsection
