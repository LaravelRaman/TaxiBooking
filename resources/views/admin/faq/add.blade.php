@extends('admin.layouts.app')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Add FAQs</h3>
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">FAQs</li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/vehicle-type') }}">Add FAQs</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h5> Add FAQ </h5>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('admin.faq') }}"><button class="btn btn-danger" style="float:right;">Back</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="theme-form" action="{{ route('admin.add-faq-save') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Question ?</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="question" type="text" name="question" value="{{ old('question') }}" aria-describedby="emailHelp" placeholder="Enter Vehicle Name">
                                        @error('question')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Answer</label><span style="color: red; margin:4px;">*</span>
                                        <textarea class="form-control ckeditor" id="answer" type="text" name="answer" value="" aria-describedby="emailHelp" placeholder="Enter Vehicle Slug">{{ old('answer') }}</textarea>
                                        @error('answer')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <?php 
                                        $random_val = Str::random(8);
                                    ?>
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">FAQ Slug</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="vehicle_slug" type="text" name="slug" Value="{{ $random_val }}" aria-describedby="emailHelp" placeholder="Enter Vehicle Slug">
                                        @error('slug')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Submit</button>
                                <button class="btn btn-secondary" type="reset">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div> 
@endsection
@section('script')
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
@endsection