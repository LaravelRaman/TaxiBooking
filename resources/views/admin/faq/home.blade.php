@extends('admin.layouts.app')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>FAQ</h3>
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">FAQ</li>
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
                            <h5> FAQs </h5>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('admin.add-faq') }}"><button class="btn btn-primary" style="float:right;">Add New FAQs</button></a>
                        </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong class>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="stripe" id="example-style-8">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($faqs as $faq)
                                <tr>
                                    <td><input type="text" style="width:50px;" onChange="ChangeSNo(this,'{{url('admin/faq-sequence/'.$faq->slug)}}')" value="{{$faq->sno}}" /></td>
                                    <td>{{ !empty($faq->question)?$faq->question:'' }}</td>
                                    <td>{!! !empty($faq->answer)?$faq->answer:'' !!}</td>
                                    <td>
                                        <a href="{{ route('admin.edit-faq',['slug' => $faq->slug]) }}"><button class="btn btn-warning" style="margin-bottom:2px;"><i class="fa fa-pencil"></i></button> </a>
                                        <a href="{{ url('admin.delete-faq',['slug' => $faq->slug]) }}"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Thumbnail</th>
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        </table>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div> 
@endsection