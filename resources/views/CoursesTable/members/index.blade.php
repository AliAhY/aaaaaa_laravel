@extends('layout')

@section('main')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header text-center bg-secondary text-white">
            <h5>اضافة اعضاء الى دورة {{ $course->name }}</h5>
        </div>
    </div>

    <form action='{{ url("/course/$id/add_member") }}' method="post">
        @csrf
        <select name="member_id">
            @foreach ($members as $member)
                <option value="{{ $member->id }}">{{ $member->full_name }}</option>
            @endforeach
        </select>
        <button class="btn btn-secondary" type="submit">add</button>
    </form>


    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>اسم الأم</th>
                <th> حذف</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($data as $item)
                <tr>
                    <th>{{ $item->member->full_name }} </th>
                    <th>{{ $item->member->mother_name }} </th>
                    <th>
                        <form id="delete-form-{{ $item->id }}" action="{{ route('members.destroy', $item->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger mx-2" onclick="confirmDelete({{ $item->id }})">
                                <i class="fa-solid fa-trash mx-2"></i>
                            </button>
                        </form>

                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        let table = new DataTable('#myTable', {
            // config options
        });

        function confirmDelete(itemId) {
            Swal.fire({
                title: 'هل أنت متأكد من حذف هذاالشخص؟',
                // text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'نعم، احذف',
                cancelButtonText: 'لا، ألغِ'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + itemId).submit();
                }
            });
        }
    </script>
@endsection


</div>
</div>
