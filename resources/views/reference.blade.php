<link rel="icon" href="/img/logo_transmedia.png">
<title>Log Editing - Reference</title>
@include ('head+nav')

<form action="/reference/store_R" method="GET">
        <div class="col-md-12">
            <div class="col-sm-12">
                <div class="row m-5" style="padding-bottom: 2rem">
                    <div class="col-md-9">
                        <div class="card shadow-sm mb-2">
                            <div class="card-body">   
                                <h2 class="card-title" style="color:#1b215a;">Reference</h2>
                                <div class = "row m-1">
                                    <div class="col-md-2 col-form-label">
                                        Booking Editing ID
                                    </div>
                                    <div class="col-md-10 col-form-label">
                                        <input type="text" name="booking_id" id="booking_id" placeholder="Booking Editing ID" class="form-control" onkeyup="autofill_ID()" require/>
                                        <div id="bookingList"></div>
                                    </div>
                                    {{ csrf_field() }}
                                    <div class="col-md-2 col-form-label">
                                        Booking Editing Line
                                    </div>
                                    <div class="col-md-10 col-form-label">
                                        <input type="text" name="booking_line" id="booking_line" placeholder="Booking Editing Line" class="form-control"/>
                                    </div>
                                    <div class="col-md-2 col-form-label">
                                        Kode Eps
                                    </div>
                                    <div class="col-md-10 col-form-label">
                                        <input type="text" class="form-control" id="kode_eps" name="kode_eps" value="" placeholder="Episode Code" disabled/>
                                    </div>
                                    <div class="col-md-2 col-form-label">
                                        Editing Date
                                    </div>
                                    <div class="col-md-10 col-form-label">
                                        <input type="text" class="date form-control" id="editing_date" name="editing_date" value="" placeholder="Editing Date" disabled/>
                                    </div>
                                    <div class="col-md-2 col-form-label">
                                        Editing Shift
                                    </div>
                                    <div class="col-md-10 col-form-label">
                                        <input type="text" class="form-control" id="editing_shift" name="editing_shift" value="" placeholder="Editing Shift" disabled/>
                                    </div><br><br><br>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-blue btn-lg btn-block">GENERATE CODE</button>
                                    </div>
                                    <br><br><br>
                                    <div class="col-md-12 col-form-label">
                                        <h4 style="color:#1b215a;">Your Code</h4>
                                        <div class="card shadow-sm mb-2" style="padding:60px;">
                                            <!-- <center><H2 style="color:#1b215a;">172027124123691</H2></center> -->
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <h3 style="color:#1b215a;"> History</h3>
                        <table class="table table-sm-2 table-bordered">
                            <thead class="table-head text-center">
                                <th>Code</th>
                                <th>Date</th>
                                <th>Shift</th>
                            </thead>
                            @foreach($reference as $r)
                            <tbody>
                                    <td>{{ $r->logediting_code }}</td>
                                    <td>{{ $r->logediting_useddate }}</td>
                                    <td>{{ $r->logediting_usedshift }}</td>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
</form>
    <script type="text/javascript">
    function datepickerdate(){
        $('.date').datepicker({  
            format: 'mm-dd-yyyy'
        }); 
    }
    function autofill_ID(){
        $('#booking_id').keyup(function(){ 
                var query = $(this).val();
                if(query != '')
                {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('reference.autofill_ID') }}",
                        method:"POST",
                        data:{query:query, _token:_token},
                        success:function(data){
                            $('#bookingList').fadeIn("fast");  
                                    $('#bookingList').html(data, "fast");
                        }
                    });
                }
        });
            $(document).on('click', 'li', function(){  
                $('#booking_id').val($(this).text());  
                $('#bookingList').fadeOut("slow",function(){ $(this).remove() } );
            });  
    }
    </script> 

</body>