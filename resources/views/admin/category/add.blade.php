@extends('admin.users.main')

@section('header')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <form action="" method="POST">
        <div class="card-body">
            @include('admin.users.alert')
            <div class="form-group">
                <label for="category">Name</label>
                <input type="text" name="name" class="form-control" id="category" placeholder="Enter name">
            </div>
            <div class="form-group">
                <label>Category</label>
                <select class="form-control" name="parent_id" id="">
                    <option value="0">Parent_Category</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="short-description">Short Description</label>
                <textarea name="description" class="form-control" id="short-description"></textarea>
            </div>
            <div class="form-group">
                <label>Detail Description</label>
                <textarea name="content" id="content-ckeditor" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="">Active</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" value="1" id="customRadio1" name="active"  checked>
                    <label for="customRadio1" class="custom-control-label">Yes</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" value="0" id="customRadio2" name="active" >
                    <label for="customRadio2" class="custom-control-label">No</label>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Create</button>
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