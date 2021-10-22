@extends('admin.users.main')

@section('header')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"  placeholder="Enter product name">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="category_id">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="number" name="price" value="{{ old('price') }}"  class="form-control" >
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Price Sale</label>
                        <input type="number" name="price_sale" value="{{ old('price_sale') }}"  class="form-control" >
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Description </label>
                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label>Detail Description</label>
                <textarea name="content" id="content-ckeditor" class="form-control">{{ old('content') }}</textarea>
            </div>

            <div class="form-group">
                <label for="">Image</label>
                <input type="file"  class="form-control" id="upload">
                <div id="image_show">

                </div>
                <input type="hidden" name="thumb" id="thumb">
            </div>

            <div class="form-group">
                <label>Active</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="">
                    <label for="active" class="custom-control-label">Yes</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" >
                    <label for="no_active" class="custom-control-label">No</label>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
<script>
    // Replace the <textarea id="editor1"> with a CKEditor 4
    // instance, using default configuration.
    CKEDITOR.replace( 'content-ckeditor' );
</script>
@endsection