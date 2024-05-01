@extends('admin.layouts.app')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Events Master<h3>
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">Event Master</li>
                         <li class="breadcrumb-item">Edit Event Master</li>
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
                    <h5> Edit Events </h5>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="mb-5">
                            <form class="theme-form" action="{{ route('admin.update-event-master',['slug' => $event->event_slug]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Type</label><span style="color: red; margin:4px;">*</span>
                                        <select class="form-control" id="" type="text" name="type">
                                            <option> -- select type -- </option>
                                            <option value="service" {{ $event->type == "service"?'selected':'' }}>Service</option>
                                            <option value="event" {{ $event->type == "event"?'selected':'' }}>Event</option>
                                        </select>
                                        @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Title</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="" type="text" name="title" value="{{ !empty($event->title)?$event->title:'' }}" aria-describedby="emailHelp" placeholder="Enter Title">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>  
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Meta Keyword</label><span style="color: black; margin:4px;">(Optional)</span>
                                        <input class="form-control" id="" type="text" name="meta_keyword" value="{{ !empty($event->meta_keyword)?$event->meta_keyword:'' }}" aria-describedby="emailHelp" placeholder="Enter Meta Keyword">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Meta Description</label><span style="color: black; margin:4px;">(Optional)</span>
                                        <input class="form-control" id="" type="text" name="meta_description" value="{{ !empty($event->meta_description)?$event->meta_description:'' }}" aria-describedby="emailHelp" placeholder="Enter Service Name">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Event Location</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="" type="text" name="location" value="{{ !empty($event->location)?$event->location:'' }}" aria-describedby="emailHelp" placeholder="Enter Event Location" >
                                        @error('location')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Price Multiplier</label>
                                        <input class="form-control" id="" type="text" name="price_multiplier" value="{{ !empty($event->price_multiplier)?$event->price_multiplier:'' }}" aria-describedby="emailHelp" placeholder="Enter Event Price Multiplier">
                                        @error('price_multiplier')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Name</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="" type="text" name="event_name" value="{{ !empty($event->event_name)?$event->event_name:'' }}" aria-describedby="emailHelp" placeholder="Enter Event Name">
                                        @error('event_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Slug</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="" value="{{ !empty($event->slug)?$event->slug:'' }}" type="text" name="slug" aria-describedby="emailHelp" placeholder="Enter Service Slug">
                                        <input type="hidden" name="event_slug" value="{{ $event->event_slug }}">
                                        @error('slug')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Description Text</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="" type="text" name="event_text" value="{{ !empty($event->event_text)?$event->event_text:'' }}" aria-describedby="emailHelp" placeholder="Enter The Description Text Line">
                                        @error('event_text')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Status</label><span style="color: red; margin:4px;">*</span>
                                        <select class="form-select digits" id="exampleFormControlSelect9" name="status">
                                            <option value="ACTIVE" {{ $event->status == "ACTIVE"?'selected':'' }}>ACTIVE</option>
                                            <option value="INACTIVE" {{ $event->status == "INACTIVE"?'selected':'' }}>INACTIVE</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">From Date</label><span style="color: red; margin:4px;">*</span>
                                        <input class="datepicker-here form-control digits" id="minMaxExample" type="text" value="{{ !empty($event->from_date)?$event->from_date:'' }}" name="from_date" data-language="en" placeholder="Enter Event Form Date">
                                        @error('from_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">To Date</label><span style="color: red; margin:4px;">*</span>
                                        <input class="datepicker-here form-control digits" id="minMaxExample" type="text" value="{{ !empty($event->to_date)?$event->to_date:'' }}" name="to_date" data-language="en"  placeholder="Enter Event To Date">
                                        @error('to_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="col-form-label pt-0" for="tags">Tags</label><span style="color: black; margin:4px;">(Optional)</span>
                                        <textarea name="tags" class="form-control" rows="2">{{ !empty($event->tags)?$event->tags:'' }}</textarea>
                                        @error('tags')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Thumbnail</label><span style="color: black; margin:4px;">(Optional)</span>
                                        <input class="form-control" id="" type="file" name="thumbnail" aria-describedby="emailHelp" placeholder="Enter Slider Tag Line">
                                        @error('event_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Banner Image</label><span style="color: black; margin:4px;">(Optional)</span>
                                        <input class="form-control" id="" type="file" name="banner_image" aria-describedby="emailHelp" placeholder="Enter Slider Title">
                                        <span style="color:red;">*Please add a image meeting dimensions (1600 x 729)</span>
                                        @error('event_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Description</label><span style="color: red; margin:4px;">*</span>
                                        <textarea id="editor1" name="description" cols="30" rows="10">{{ !empty($event->description)?$event->description:'' }}</textarea>
                                        @error('event_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="col-form-label pt-0" for="editor1">Service Details</label><span style="color: black; margin:4px;">(Optional)</span>
                                        <textarea id="editor1" name="long_description" class="form-control ckeditor" cols="30" rows="10">{{ !empty($event->long_description)?$event->long_description:'' }}</textarea>
                                        @error('long_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <button class="btn btn-primary" type="submit">Update</button>
                                <a href="{{ route('admin.event-master') }}"><button class="btn btn-secondary" type="button">Back</button></a>
                            </form>
                        </div>
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