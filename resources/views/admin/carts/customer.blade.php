@extends('admin.users.main')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Customer Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Order Date</th>
            <th>Status</th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($customers as $key => $customer)
            <tr>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->phone }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->created_at }}</td>
                
                <td>{!! \App\Helpers\Helper::statusOrder($customer->status) !!}</td>
                <td>
                    {{-- <a class="btn btn-primary btn-sm" href="/admin/carts/customers/edit/{{$customer->id}}">
                        <i class="fas fa-edit"></i>
                    </a> --}}
                    <a class="btn btn-info btn-sm" href="/admin/carts/customers/view/{{ $customer->id }}">
                        <i class="fas fa-eye"></i>
                    </a>
                    {{-- <a href="#" class="btn btn-danger btn-sm"
                       onclick="removeRow({{ $customer->id }}, '/admin/carts/customers/destroy')">
                        <i class="fas fa-trash"></i>
                    </a> --}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="card-footer clearfix">
        {!! $customers->links() !!}
    </div>
@endsection