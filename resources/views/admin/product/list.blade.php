@extends('admin.users.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Price Sale</th>
                <th>Active</th>
                <th>Update</th>
                {{-- <th>Description</th> --}}
                <th style="width: 100px">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            {{-- {!! \App\Helpers\Helper::category($categories) !!} --}}
            @foreach ($products as $key => $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->price_sale }}</td>
                    <td>{!! \App\Helpers\Helper::active($product->active) !!}</td>
                    <td>{{ $product->updated_at }}</td>
                    <td>
                        <a href="/admin/products/edit/{{ $product->id }}" class="btn btn-primary btn-sm">
                            <i class="far fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm"
                            onclick="removeRow({{ $product->id }}, '/admin/products/destroy')">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {!! $products->links() !!}
@endsection
