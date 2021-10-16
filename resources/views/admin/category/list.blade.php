@extends('admin.users.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Active</th>
                <th>Update</th>
                {{-- <th>Description</th> --}}
                <th style="width: 100px">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            {!! \App\Helpers\Helper::category($categories) !!}
        </tbody>
    </table>
@endsection