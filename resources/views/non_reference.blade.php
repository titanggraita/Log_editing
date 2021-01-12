<link rel="icon" href="/img/logo.png">
<title>Log Editing - Non Reference</title>
@include ('head+nav')

<form action="/non_reference/store_NR" method="GET">
        <div class="col-md-12">
            <div class="col-sm-12">
                <div class="row m-5" style="padding-bottom: 2rem">
                    <div class="col-md-12">
                        <div class="card shadow-sm mb-2">
                            <div class="card-body">   
                            <h2 class="card-title" style="color:#1b215a;">Non Reference</h2>
                                <div class = "row m-1">
                                    <div class="col-md-2 col-form-label">
                                        Editing Date
                                    </div>
                                    <div class="col-md-10 col-form-label">
                                        <input type="date" class="form-control" name="editing_date" value="" placeholder="Selected Date" required>
                                    </div>
                                    <div class="col-md-2 col-form-label">
                                        Editing Shift
                                    </div>
                                    <div class="col-md-10 col-form-label">
                                        <input type="text" class="form-control" name="editing_shift" value="" placeholder="Input Editing Shift (1, 2, or 3)" required>
                                    </div>
                                    <div class="col-md-2 col-form-label">
                                        Editing Reason
                                    </div>
                                    <div class="col-md-10 col-form-label">
                                        <input type="text" class="form-control" name="editing_reason" value="" placeholder="Input Editing Reason" required>
                                    </div>
                                    <div class="col-md-2 col-form-label">
                                        Booking Editing ID
                                    </div>
                                    <div class="col-md-10 col-form-label">
                                        <select name="bookingediting_id" id="bookingediting_id" class="form-control dynamic" data-dependent="bookingeditingdetail_line">
                                            <option value="" selected="false">--Select Booking Editing ID--</option>
                                            @foreach ($non_reference_B as $a)
                                                <option value="{{$a->bookingediting_id}}">{{$a->bookingediting_id}}</option>
                                                @endforeach
                                        </select>
                                        <p style="color:grey;">*Ketik Booking Editing ID (JIKA ADA - TIDAK WAJIB DIISI)
                                    </div>
                                    
                                    <div class="col-md-2 col-form-label">
                                        Booking Editing Line
                                    </div>
                                    <div class="col-md-10 col-form-label">
                                        <select name="booking_line" id="booking_line" class="form-control">
                                            <option value="" selected="false">--Select Booking Editing Line--</option>
                                        </select>
                                        <p style="color:grey;">*Pilih Booking Editing Line (JIKA ADA - TIDAK WAJIB DIISI)</p>
                                    </div>
                                    <div class="col-md-2 col-form-label">
                                        Kode Eps
                                    </div>
                                    <div class="col-md-10 col-form-label">
                                        <input type="text" class="form-control" id="kode_eps" name="kode_eps" value="" placeholder="Episode Code" readonly/>
                                    </div>
                                    <br><br><br>
                                    <div class="col-md-12">
                                        <button type="submit" id="btnSubmit" class="btn btn-blue btn-lg btn-block">GENERATE CODE</button>
                                    </div>
                                    <br><br><br>
                                    <div class="col-md-12 col-form-label">
                                        <h4 style="color:#1b215a;">Your Code</h4>
                                        <div class="card shadow-sm mb-2" style="padding:60px;">
                                            <center><H2 style="color:#1b215a;">
                                            <?php 
                                                if (isset($_POST["btnSubmit"])){
                                                    echo ($reference->logediting_code);
                                                }
                                            ?>
                                            </H2></center>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <br>
                        <h3 style="color:#1b215a;"> History</h3>
                        <br>
                        <table class="table table-sm-9 table-bordered">
                            <thead class="table-head text-center">
                                <th>Code</th>
                                <th>Booking Editing ID</th>
                                <th>Booking Editing Line</th>
                                <th>Kode Eps</th>
                                <th>Editing Date</th>
                                <th>Editing Shift</th>
                                <th>Generated By</th>
                                <th>Generated Datetime</th>
                                <th>Login Detail Status</th>
                            </thead>
                           
                            @foreach($non_reference_N as $n)
                            <tbody class="table-body text-center">
                                    <td>{{ $n->logediting_code }}</td>
                                    <td>{{ $n->logediting_reference_id }}</td>
                                    <td>{{ $n->logediting_reference_line }}</td>
                                    <td>{{ $n->logediting_reference_code }}</td>
                                    <td>{{ $n->logediting_useddate }}</td>
                                    <td>{{ $n->logediting_usedshift }}</td>
                                    <td>{{ $n->logediting_generatedby }}</td>
                                    <td>{{ $n->logediting_generateddate }}</td>
                                    <td>
                                        <button type="button" id="myBtn" class="btn btn-blue btn-sm" onclick="popup_N()">View Detail
                                        </button>
                                        <!-- The Modal -->
                                        <div id="myModal" class="modal">

                                        <!-- Modal content -->
                                            <div class="modal-content">
                                                <h3 class="modal-header" style="color:#1b215a;">Detail Login Status <span class="close">&times;</span></h3>
                                                <div class="row m-1">
                                                    <div class="col-sm-4 col-form-label">
                                                        <p style="font-size:17px;">Code</p>
                                                    </div>
                                                    <div class="col-sm-8 col-form-label">
                                                        <p style="font-size:17px;">{{ $n->logediting_code }}</p>
                                                    </div>
                                                    <div class="col-sm-4 col-form-label">
                                                        <p style="font-size:17px;">Status Login</p>
                                                    </div>
                                                    <div class="col-sm-8 col-form-label">
                                                        <p style="font-size:17px;">
                                                            <?php 
                                                                if ($n->logediting_logindate != NULL){
                                                                    echo "Sudah Login";
                                                                }else{
                                                                    echo "Belum Login";
                                                                }
                                                            ?>
                                                        
                                                        </p>
                                                    </div>
                                                    <div class="col-sm-4 col-form-label">
                                                        <p style="font-size:17px;">Login By</p>
                                                    </div>
                                                    <div class="col-sm-8 col-form-label">
                                                        <p style="font-size:17px;">
                                                        <?php 
                                                        if (($n->logediting_loginnik != NULL) && ($n->logediting_loginname != NULL)){
                                                            echo $n->logediting_loginnik."/".$n->logediting_loginname;
                                                        }else{
                                                            echo "- -";
                                                        }
                                                        ?>
                                                        </p>
                                                    </div>
                                                    <div class="col-sm-4 col-form-label">
                                                        <p style="font-size:17px;">Login Time</p>
                                                    </div>
                                                    <div class="col-sm-8 col-form-label">
                                                        <p style="font-size:17px;">
                                                        <?php 
                                                        if ($n->logediting_logindate != NULL){
                                                            echo date('d M Y', strtotime($n->logediting_logindate));
                                                        }else{
                                                            echo "-";
                                                        }
                                                        ?> 
                                                        <?php 
                                                        if ($n->logediting_logintime != NULL){
                                                            echo $n->logediting_logintime;
                                                        }else{
                                                            echo "-";
                                                        }
                                                        ?>
                                                        </p>
                                                    </div>
                                                    <div class="col-sm-4 col-form-label">
                                                        <p style="font-size:17px;">Status Logout</p>
                                                    </div>
                                                    <div class="col-sm-8 col-form-label">
                                                        <p style="font-size:17px;">
                                                            <?php 
                                                                if ($n->logediting_logoutdate != NULL){
                                                                    echo "Sudah Logout";
                                                                }else{
                                                                    echo "Belum Logout";
                                                                }
                                                            ?>
                                                        </p>
                                                    </div>
                                                    <div class="col-sm-4 col-form-label">
                                                        <p style="font-size:17px;">Logout Time</p>
                                                    </div>
                                                    <div class="col-sm-8 col-form-label">
                                                        <p style="font-size:17px;">
                                                        <?php 
                                                        if ($n->logediting_logoutdate != NULL){
                                                            echo date('d M Y', strtotime($n->logediting_logoutdate));
                                                        }else{
                                                            echo "-";
                                                        }
                                                        ?> 
                                                        <?php 
                                                        if ($n->logediting_logouttime != NULL){
                                                            echo $n->logediting_logouttime;
                                                        }else{
                                                            echo "-";
                                                        }
                                                        ?>
                                                        </p>
                                                    </div>
                                                    <div class="col-sm-4 col-form-label">
                                                        <p style="font-size:17px;">Remark Logout</p>
                                                    </div>
                                                    <div class="col-sm-8 col-form-label">
                                                        <p style="font-size:17px;">
                                                        <?php 
                                                        if ($n->logediting_remark != NULL){
                                                            echo $n->logediting_remark;
                                                        }else{
                                                            echo "- -";
                                                        }
                                                        ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
</form>
    <script type="text/javascript">
    function popup_N(){
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }
    </script>
    
    
</body>