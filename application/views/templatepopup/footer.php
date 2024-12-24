<div class="modal" id="uploading">

    <div class="modal-dialog">

        <div class="modal-content">      

            <div class="modal-body">

                Processing Your Request...

                <div style="width:100%;margin:0 auto;text-align:center;"><img src="<?= base_url('adminlte/dist/img/uploading.gif') ?>" style="width:100px;height:80px; text-align:center;margin-top:10%;" /></div>

            </div>      

        </div>

    </div>

</div>

</body>



<!-- jQuery 2.1.4 -->

<script src="<?= base_url('adminlte/plugins/jQuery/jQuery-2.1.4.min.js') ?>" type="text/javascript"></script>

<!-- Bootstrap 3.3.2 JS -->

<script src="<?= base_url('adminlte/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>       





<!-- iCheckx-->

<!--<script src="<?= base_url('adminlte/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>-->



<!-- DATA TABES SCRIPT -->

<script src="<?= base_url('adminlte/plugins/datatables/jquery.dataTables.min.js') ?>" type="text/javascript"></script>

<script src="<?= base_url('adminlte/plugins/datatables/dataTables.bootstrap.min.js') ?>" type="text/javascript"></script>

<!-- SlimScroll -->

<script src="<?= base_url('adminlte/plugins/slimScroll/jquery.slimscroll.min.js') ?>" type="text/javascript"></script>

<!-- FastClick -->

<script src='<?= base_url('adminlte/plugins/fastclick/fastclick.min.js') ?>'></script>

<!-- AdminLTE App -->

<script src="<?= base_url('adminlte/dist/js/app.min.js') ?>" type="text/javascript"></script>





<script>

    $(function() {

        $('input').iCheck({

            checkboxClass: 'icheckbox_square-blue',

            radioClass: 'iradio_square-blue',

            increaseArea: '20%' // optional

        });

    });

</script>





<!-- page script -->

<script type="text/javascript">



    //$(function () {

    $("#example1").dataTable();

    $('#example2').dataTable({

        "bPaginate": true,

        "bLengthChange": false,

        "bFilter": false,

        "bSort": true,

        "bInfo": true,

        "bAutoWidth": false

    });

    $("#example4").dataTable(

            {

                "columnDefs": [{

                        orderable: false,

                        className: 'select-checkbox',

                        targets: 0

                    }]

            }

    );

    //});

</script>





<script type="text/javascript">

    

    $('#mailform').submit(function() {

        $('#uploading').modal('show');

        var jid = $('#jobid').val();

        var cus = $('#cus_name').val();

        var email = $('#email').val();

        $.ajax({

            type: "post",

            url: "<?php echo base_url('index.php/jobs/sendEmail/'); ?>",

            data: 'jobid=' + jid + '&cus_name=' + cus + '&email=' + email,

            success: function(feed) {

                $('#uploading').modal('hide');

                if (feed.trim() == 'ok') {

                    alert('Email Sent');

                } else {

                    alert('Email Sending fail');

                }

            },

            error: function(feed) {

                alert('Email Sending fail!');

            }

        });

        $('#uploading').modal('hide');

        return false;

    });





    $('#mailinv').submit(function() {

        $('#uploading').modal('show');

        var jid = $('#invid').val();

        var cus = $('#cus_name').val();

        var email = $('#email').val();

        $.ajax({

            type: "post",

            url: "<?php echo base_url('index.php/jobs/sendEmailInv/'); ?>",

            data: 'invid=' + jid + '&cus_name=' + cus + '&email=' + email,

            success: function(feed) {

                $('#uploading').modal('hide');

                if (feed.trim() == 'ok') {

                    alert('Email Sent');

                } else {

                    alert('Email Sending fail');

                }

            },

            error: function(feed) {

                alert('Email Sending fail!');

            }

        });

        $('#uploading').modal('hide');

        return false;

    });

    

</script>    



<script type="text/javascript">

    

    function printdoc() {

            $('#printing').hide();

            window.print(this);    

    }

//Print Page



</script>

<script>
    
        $('#grade').change(function(){
            alert(this.value);
            $('.grades').hide();
            $('#' + $(this).val()).show();
        });
</script>

</body>

</html>