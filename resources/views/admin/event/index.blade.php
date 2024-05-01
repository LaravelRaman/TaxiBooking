@extends('admin.layouts.app')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Event/Service Master<h3>
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item">Event Master</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong class>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-header">
                    <h5> Add Event/Service </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-5">
                            <form class="theme-form" action="{{ route('admin.add-event-master') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Type</label><span style="color: red; margin:4px;">*</span>
                                        <select class="form-control" id="" type="text" name="type">
                                            <option> -- select type -- </option>
                                            <option value="service">Service</option>
                                            <option value="event">Event</option> 
                                        </select>
                                        @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Title</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="" type="text" name="title" value="{{ old('title') }}" aria-describedby="emailHelp" placeholder="Enter Title">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Meta Keyword</label><span style="color: black; margin:4px;">(Optional)</span>
                                        <input class="form-control" id="" type="text" name="meta_keyword" value="{{ old('meta_keyword') }}" aria-describedby="emailHelp" placeholder="Enter Meta Keyword">
                                        @error('meta_keyword')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Meta Description</label><span style="color: black; margin:4px;">(Optional)</span>
                                        <input class="form-control" id="" type="text" name="meta_description" value="{{ old('meta_description') }}" aria-describedby="emailHelp" placeholder="Enter Service Name">
                                        @error('meta_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Event Location</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="" type="text" name="location" value="{{ old('location') }}" aria-describedby="emailHelp" placeholder="Enter Event Location" >
                                        @error('location')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Price Multiplier</label>
                                        <input class="form-control" id="" value="" type="number" name="price_multiplier" value="{{ old('price_multiplier') }}" aria-describedby="emailHelp" placeholder="Enter Event Price Multiplier">
                                        @error('price_multiplier')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Name</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="" type="text" name="event_name" value="{{ old('event_name') }}" aria-describedby="emailHelp" placeholder="Enter Event Name">
                                        @error('event_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <?php 
                                        $random_val = Str::random(8);
                                    ?>
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Slug</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="" value="{{ $random_val }}" type="text" name="slug" value="{{ old('slug') }}" aria-describedby="emailHelp" placeholder="Enter Service Slug">
                                        @error('slug')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Description Text</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="" type="text" name="event_text" value="{{ old('event_text') }}" aria-describedby="emailHelp" placeholder="Enter The Description Text Line">
                                        @error('event_text')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Status</label><span style="color: red; margin:4px;">*</span>
                                        <select class="form-select digits" id="exampleFormControlSelect9" name="status">
                                            <option value="ACTIVE">ACTIVE</option>
                                            <option value="INACTIVE" selected>INACTIVE</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">From Date</label><span style="color: red; margin:4px;">*</span>
                                        <input class="datepicker-here form-control digits"id="minMaxExample" type="text" data-language="en" name="from_date" value="{{ old('from_date') }}" placeholder="Enter Event Form Date">
                                        @error('from_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">To Date</label><span style="color: red; margin:4px;">*</span>
                                        <input class="datepicker-here form-control digits" id="minMaxExample" value="" type="text" name="to_date" value="{{ old('to_date') }}" data-language="en"  placeholder="Enter Event To Date">
                                        @error('to_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="col-form-label pt-0" for="tags">Tags</label><span style="color: black; margin:4px;">(Optional)</span>
                                        <textarea name="tags" class="form-control" rows="2">{{ old('tags') }}</textarea>
                                        @error('tags')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Thumbnail</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="" type="file" name="thumbnail" aria-describedby="emailHelp" placeholder="Enter Slider Tag Line">
                                        @error('thumbnail')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Banner Image</label><span style="color: red; margin:4px;">*</span>
                                        <input class="form-control" id="" type="file" name="banner_image" aria-describedby="emailHelp" placeholder="Enter Slider Title">
                                        <span style="color:red;">*Please add a image meeting dimensions (1600 x 729)</span><br>
                                        @error('banner_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3">
                                        <label class="col-form-label pt-0" for="exampleInputEmail1">Description</label><span style="color: red; margin:4px;">*</span>
                                        <textarea id="editor1" name="description" cols="30" rows="10">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="col-form-label pt-0" for="editor1">Service Details</label><span style="color: black; margin:4px;">(Optional)</span>
                                        <textarea id="editor1" name="long_description" class="form-control ckeditor" cols="30" rows="10">{{ old('long_description') }}</textarea>
                                        @error('long_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <button class="btn btn-primary" type="submit">Submit</button>
                                <button class="btn btn-secondary" type="reset">Cancel</button>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="stripe" id="example-style-8">
                            <thead>
                                <tr>
                                <th>SNo</th>
                                <th>Event Thumbnail</th>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($events as $event)
                                    <tr>
                                        <td>{{ !empty($event->sno)?$event->sno:'NA' }}</td>
                                        <td><img src="{{asset('uploads/event_thumbnail/'.$event->thumbnail) }}" alt="" srcset="" style="height: 188px;width: 188px;"></td>
                                        <td>{{ !empty($event->event_name)?$event->event_name:'NA' }}</td>
                                        <td>{{ !empty($event->location)?$event->location:'NA' }}</td>
                                        <td>{{ !empty($event->type)?$event->type:'NA' }}</td>
                                        <td>{{ !empty($event->status)?$event->status:'NA' }}</td>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.edit-event-master',['slug' => $event->event_slug]) }}"><button class="btn btn-warning" style="margin-bottom:2px;"><i class="fa fa-pencil"></i></button> </a>
                                            <a href="{{ route('admin.delete-event-master',['slug' => $event->event_slug]) }}"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                <th>Service Thumbnail</th>
                                <th>Name</th>
                                <th>Descrption Text</th>
                                <th>Status</th>
                                <th>Action</th>
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
@section('script')
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
@endsection