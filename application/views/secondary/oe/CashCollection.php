<?php include_once BASEPATH . ('../application/views/template/leftsidebar.php'); ?>

<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <h1>

            Cash Collection

            <small>Secondary Sales O/E Transactions </small>

        </h1>

        <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Secondary Sales Order Entry Module</li>

        </ol>

    </section>



    <!-- Main content -->

    <section class="content">

        <div class="row">

            <div class="col-md-12">

                <div id="successMessage" class="hideDiv">Updated Successfully! </div>

                <div id="errorMessage" class="hideDiv">Invalid Data! Please Try Again. </div>

                <div class="keepgap"></div> 

                <div class="row" style="overflow-x: scroll;">
                    <div class="col-md-12">
                        <form class="form-horizontal" id="OrderData" action="<?= base_url('Salesoetransaction/addCollections') ?>" method="post" novalidate="novalidate">
                            <div class="col-md-6">                            
                                <div class="form-group">
                                    <label class="col-md-2">Date <span class="text-red">*</span></label>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <input type="text" name="post[user][date]" class="form-control pull-right" placeholder="Date"id="datepicker" value="" required >

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-2">Territory <span class="text-red">*</span></label>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <input type="text" name="post[user][territory]" class="form-control" id="Territory" placeholder="Territory" value="" required/>

                                        </div>
                                    </div>
                                </div>                            
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-2">Cash Collector <span class="text-red">*</span></label>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <input type="text" name="post[user][Cash]" class="form-control" id="Cash" placeholder="Cash Collector" value="" required/>

                                        </div>
                                    </div>
                                </div>                            
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-2">Start Mileage <span class="text-red">*</span></label>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <input type="text" name="post[user][smileage]" class="form-control" id="StartMileage" placeholder="KM" value="" required/>

                                        </div>
                                    </div>
                                </div>                            
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-2">End Mileage <span class="text-red">*</span></label>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <input type="text" name="post[user][emileage]" class="form-control" id="EndMileage" placeholder="KM" value="" required/>

                                        </div>
                                    </div>
                                </div>                            
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-2">Total Sell <span class="text-red">*</span></label>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <input type="text" name="post[user][totalsell]" class="form-control" id="TotalSell" placeholder="Total Sell" value="" required/>

                                        </div>
                                    </div>
                                </div>                            
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-2">Bill Number <span class="text-red">*</span></label>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <input type="text" name="post[user][billnumber]" class="form-control" id="BillNumber" placeholder="Bill Number" value="" required/>

                                        </div>
                                    </div>
                                </div>                            
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-2">Name<span class="text-red">*</span></label>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <input type="text" name="post[user][name]" class="form-control" id="Name" placeholder="Name" value="" required/>

                                        </div>
                                    </div>
                                </div>                            
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-2">Value<span class="text-red">*</span></label>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">
                                            <input type="text" name="post[user][value]" class="form-control" id="Value" placeholder="Value" value="" required/>

                                        </div>
                                    </div>
                                </div>                            
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-2">Cash type<span class="text-red">*</span></label>
                                    <div class="col-md-6">
                                        <div class="checkbox icheck">
                                            <input type="checkbox"  value="1" name="post[user][cash]">Mark As Cash<br>
                                            <input type="checkbox"  value="2" name="post[user][loan]">Mark As Loan<br>
                                            <input type="checkbox"  value="3" name="post[user][check]"> Mark As Check<br>



                                        </div>
                                    </div>
                                </div>                            
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-2">Check Number<span class="text-red">*</span></label>
                                    <div class="col-md-6">
                                        <div class="form-group has-feedback">

                                            <input type="text" name="post[user][cnumber]" class="form-control" id="Cnumber" placeholder="Check Number" value="" /> <br>


                                        </div>
                                    </div>
                                </div>                            
                            </div>



                            <div class="col-md-6">  
                                <div class="form-group">

                                    <div class="col-md-2">
                                        <!-- /.input group -->
                                    </div><!-- /.form group -->	
                                    <div class="col-md-2"><input type="submit" class="btn btn-danger" id="Add" value="Add"  onclick="Addrow()">
                                    </div>
                                </div>
                            </div>

                        </form>
                        <!--<div class="form-group">
                            <input type="button" class="btn btn-success" id="excel" name="excel" onclick="ExportExcel('table-area', 'Outlets')" value="Excel">
                        </div>-->
                    </div>
                    <div class="col-md-12" style="overflow-x: scroll;">
                        <div class="box">
                            <div class=" box-header with-border ">   

                                <h3>

                                    Cash Collection Details 

                                    <small></small>

                                </h3>
                            </div>
                            <div class="box-body">

                                <?php
                                echo "<table class=\"table table-dark table-striped\" id=\"example1\">";
                                echo "<thead>";
                                echo "<tr>"
                                . "<th>Id</th>"
                                . "<th>Bill Number</th>"
                                . "<th>Name</th>"
                                . "<th>Value</th>"
                                . "<th>Cash</th>"
                                /* . "<th>Manualt_mileage</th>"
                                  . "<th>Additional Diesel</th>" */
                                . "<th>Check</th>"
                                . "<th>Loan</th>"
                                . "<th></th>"
                                . "<th>Check Number</th>"
                                . "</tr>"
                                . "</thead>";

                                echo "<tbody>";

                                echo "</tbody>";
                                echo "</table>";
                                ?>



                            </div>
                        </div>
                    </div>
                </div>

            </div>



        </div>
    </section>
    <script>

        $(document).on('change', '#areaid', function () {
            var modID = $('#areaid').val();
            $('#territoryList').empty();
            //alert(modID);
            $.ajax({
                type: "post",
                url: "<?php echo base_url('index.php/master/getOperationAreasTerritoryAjax'); ?>",
                data: 'opid=' + modID,
                success: function (feed) {
                    $('#uploading').modal('hide');
                    //alert(feed);
                    $('#territoryList').empty().append(feed);

                },
                error: function (feed) {
                    console.log('Ajax request not recieved!' + feed);
                    $('#uploading').modal('hide');
                }
            });
            return false;
        });
    </script>
    <script>
        var list1 = [];
        var list2 = [];
        var list3 = [];
        var list4 = [];
        var list5 = [];
        var list6 = [];
        var list7 = [];
        var n = 1;
        var x = 0;
        function Addrow() {
            var Addrown = document.getElementById('table table-dark table-striped');
            var NewRow = Addrown.inserRow(n);

            list1[x] = document.getElementById("billnumber").value;
            list2[x] = document.getElementById("name").value;
            list3[x] = document.getElementById("value").value;
            list4[x] = document.getElementById("cash").value;
            list5[x] = document.getElementById("loan").value;
            list6[x] = document.getElementById("check").value;
            list7[x] = document.getElementById("cnumber").value;

            var cel1 = NewRow.insertCell(0);
            var cel2 = NewRow.insertCell(0);
            var cel3 = NewRow.insertCell(0);
            var cel4 = NewRow.insertCell(0);
            var cel5 = NewRow.insertCell(0);
            var cel6 = NewRow.insertCell(0);
            var cel7 = NewRow.insertCell(0);

            cel1.innerHTML = list1[x];
            cel2.innerHTML = list2[x];
            cel3.innerHTML = list3[x];
            cel4.innerHTML = list4[x];
            cel5.innerHTML = list5[x];
            cel6.innerHTML = list6[x];
            cel7.innerHTML = list7[x];

            n++;
            x++;



        }
    </script>
    <!-- /.content -->

</div><!-- /.content-wrapper -->


