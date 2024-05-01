@extends('admin.layouts.app')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3>Invoice Detail</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item">Invoices </li>
                            <li class="breadcrumb-item">Invoice Preview</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- Container-fluid starts-->
            <div class="container invoice">
                <div class="row" style="height: 800px;">
                    <div class="card">
                        <div class="card-body">
                            <iframe src="{{ route('admin.generate-invoice',['id'=>$booking_id]) }}" frameborder="1" style="width: 100%; height: 100%;"></iframe>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-bottom:10px;">
                    <div class="col-12 text-center">
                        <a href="{{ route('admin.generate-pdf',['id'=>$booking_id]) }}"><button class="btn btn-primary">Print</button></a>
                        <a href="{{ route('admin.invoices') }}"><button class="btn btn-secondary">Back</button></a>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
        </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
      $('#myCheckbox').change(function() {
        if($(this).is(':checked')) {
          $('#myDiv').show();
        } else {
          $('#myDiv').hide();
        }
      });
    });
  </script>
<script type="text/javascript">
    $(".download-pdf").click(function(){
        var data = '';
        $.ajax({
            type: 'GET',
            url: "{{route('admin.generate-pdf')}}",
            data: data,
            xhrFields: {
                responseType: 'blob'
            },
            success: function(response){
                var blob = new Blob([response]);
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "techsolutionstuff.pdf";
                link.click();
            },
            error: function(blob){
                console.log(blob);
            }
        });
    });

</script>
<script>
    $('#mySelect').on('change', function() {
        if (this.value == 'CONFIRMED' || this.value == 'FULFILLED') {
            $('#myButtonBlock').show();
        } else {
            $('#myButtonBlock').hide();
        }
    });
</script>
<script>
    $('#mySelect').on('change', function() {
        $('#save_status').show();
    });
</script>
  
@endsection
