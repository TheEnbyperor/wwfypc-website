<?php 
include_once ("includes/includes.inc.php");
include_once("includes/header_unlock.php");
include_once("crud.php");

$make       = read('all', 'tbl_unlock_make', 'status = 1', 'id ASC');
$model      = read('all', 'tbl_unlock_model', 'status = 1', 'id ASC');
$network    = read('all', 'tbl_unlock_network', 'status = 1', 'id ASC');
?>

<style type="text/css">
    * {
        font-family: 'LucidaGrande', Tahoma, Verdana, Arial, sans-serif !important;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() {
        // $('#model').on('change', function() {
        //     var model = $('#model').val();
        //     var info = $('#model option:selected').data('info').split(',');
        //     var price = info[0];
        //     var days = info[1];

        //     $('#price').val(price);
        //     $('#days').val(days);

        //     $('#show_model').text(model);
        //     $('#show_price').text(price+ ' GBP');
        //     $('#show_days').text(days+' Days');
        // });

        $('#make, #model, #network').on('change', function() {
            var make    = $('#make').val();
            var model   = $('#model').val();
            var network = $('#network').val();

            if (make == '' || model == '' || network == '') {
                $('#network').val('');
                $('.payment').click();
                return false;
            }

            getData();
        });

        $('#make').on('change', function() {
            var make    = $('#make').val();
            $('.hide_model').hide();
            $('.m'+make).show();
        });

        $('#payment_form').on('submit', function(event) {
            event.preventDefault();
            var make    = $('#make').val();
            var model   = $('#model').val();
            var network = $('#network').val();
            var name    = $('#name').val();
            var phone   = $('#phone').val();
            var email   = $('#email').val();
            var imei    = $('#imei').val();
            var info    = $('#model option:selected').data('info').split(',');
            var price   = info[0];
            var days    = info[1];

            $.ajax({
                type: "POST",
                url: "unlock_payment.php",
                data:{'make':make, 'model':model, 'network':network, 'price':price, 'days':days, 'name':name, 'phone':phone, 'email':email, 'imei':imei},
                dataType: "html",
                success: function (res) {
                    console.log(res);
                }
            });
        });

        $('#imei').on('keyup', function () {
            isIMEI($(this).val());
        })
    });

    function getData() {
        var make    = $('#make').val();
        var model   = $('#model').val();
        var network = $('#network').val();

        $.ajax({
            type: "POST",
            url: "unlock_price_data.php",
            data:{'make':make, 'model':model, 'network':network},
            dataType: "json",
            success: function (res) {
                console.log(res);
                if (res.type == 1) {
                    $('.payment').removeAttr('disabled');
                    $('#price').val(res.data.price);
                    $('#days').val(res.data.days);

                    $('#show_model').text(res.data.model);
                    $('#show_price').text(res.data.price+ ' GBP');
                    $('#show_days').text(res.data.days+' Days');
                    $('#show_network').text(res.data.network);
                } else {
                    $('#network').val('');
                    $('#price').val('');
                    $('#days').val('');
                    $('.payment').prop('disabled', true);
                }
            }
        });
    }

    function isIMEI (code) {
        var reg = /^\d{15}$/;
        if(reg.test(code)){
            $('.imei_error').text('');
            $('.payment').removeAttr('disabled');
        }else{
            $('.imei_error').text('IMEI is invalid');
            $('.payment').prop('disabled', true);
        }
    }
</script>

<script type='text/javascript'>
  window.onload = function() {
    Worldpay.useTemplateForm({
      'clientKey':'T_C_52bc5b16-562d-4198-95d4-00b91f30fe2c',
      'form':'paymentForm',
      'paymentSection':'paymentSection',
      'display':'inline',
      'reusable':true,
      'saveButton':false,
      'callback': function(obj) {
        if (obj && obj.token) {
          var _el = document.createElement('input');
          _el.value = obj.token;
          _el.type = 'hidden';
          _el.name = 'token';
          document.getElementById('paymentForm').appendChild(_el);
          document.getElementById('paymentForm').submit();
        }
      }
    });
  }
</script>
    
<div class="col-md-12">
    <font color="#FF0000" size="1" face="Arial, Helvetica, sans-serif">
        <?php echo (isset($_GET['res']) && $_GET['res'] == 0) ? 'Payment Failed' : ''; ?>        
        <?php echo (isset($_GET['res']) && $_GET['res'] == 1) ? 'Payment Successfull' : ''; ?>        
    </font>
</div>

<div class="row text-center">
    <div class="col-md-12 text-center">
        <h1 style="color: #0088cc; font-weight: bold; margin: 40px 0px;">Phone Unlocking</h1>
    </div>

    <div class="col-md-4 text-center">
        <img class="pt-2 pb-2" src="https://via.placeholder.com/80x80.png" style="border-radius: 50%;">
        <h5 class="pt-2 pb-2" style="color: red;"><b><u>Fill Out The Form</u></b></h5>
        <p class="pt-2 pb-2" style="font-size: 15px; width: 70%; display: inline-flex; justify-content: center;">
            Fill out our easy to use form below and we'll do the complicated stuff.
        </p>
    </div>

    <div class="col-md-4 text-center">
        <img class="pt-2 pb-2" src="https://via.placeholder.com/80x80.png" style="border-radius: 50%;">
        <h5 class="pt-2 pb-2" style="color: red;"><b><u>Wait For The Specified Time</u></b></h5>
        <p class="pt-2 pb-2" style="font-size: 15px; width: 70%; display: inline-flex; justify-content: center;">
            Sometimes your phone may be unlocked sooner than the specified date.
        </p>
    </div>

    <div class="col-md-4 text-center">
        <img class="pt-2 pb-2" src="https://via.placeholder.com/80x80.png" style="border-radius: 50%;">
        <h5 class="pt-2 pb-2" style="color: red;"><b><u>Receive Notice Of Unlock</u></b></h5>
        <p class="pt-2 pb-2" style="font-size: 15px; width: 70%; display: inline-flex; justify-content: center;">
            We will email you once the phone is unlocked then your free to use any sim you like.
        </p>
    </div>
</div>

<form class="col-md-12" action="unlock_payment.php" id="paymentForm" method="post">
    <div class="row text-center">
        <div class="col-md-12 text-center">
            <h3 style="color: #0088cc; font-weight: bold; margin: 40px 0px;">Choose Your Service</h3>
        </div>

        <div class="col-md-6">
            <select class="form-control" name="make" id="make" style="width: 100%; height: 40px; background: #eee; font-size: 24px; font-weight: bold; padding-left: 10px; margin-bottom: 30px;" required>
                <option value="" selected>Make</option>
                <?php foreach ($make as $key => $v) { ?>
                    <option value="<?php echo $v->id; ?>"><?php echo $v->name; ?></option>
                <?php } ?>
            </select>

            <select class="form-control" name="model" id="model" style="width: 100%; height: 40px; background: #eee; font-size: 24px; font-weight: bold; padding-left: 10px; margin-bottom: 30px;" required>
                <option value="" selected>Model</option>
                <?php foreach ($model as $key => $v) { ?>
                    <option class="hide_model m<?php echo $v->make; ?>" value="<?php echo $v->id; ?>" data-info="<?php echo $v->price.','.$v->days; ?>"><?php echo $v->name; ?></option>
                <?php } ?>
            </select>

            <select class="form-control" name="network" id="network" style="width: 100%; height: 40px; background: #eee; font-size: 24px; font-weight: bold; padding-left: 10px; margin-bottom: 30px;" required>
                <option value="" selected>Network its locked to</option>
                <?php foreach ($network as $key => $v) { ?>
                    <option value="<?php echo $v->id; ?>"><?php echo $v->name; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="col-md-6">
            <div style="background: #eee;">
                <div style="width: 70%; padding: 20px; display: inline-flex; justify-content: center;">
                    <h4>Your <span id="show_model" style="color: red;">phone</span> can be unlocked from <span style="color: red;" id="show_network">Network</span></h4>
                </div>
                <div style="display: inline-flex; width: 70%; justify-content: center;">
                    <div style="width: 150px; background: #ccc; padding: 20px 30px; margin: 10px;">
                        Price<br><b id="show_price">30 GBP</b>
                    </div>

                    <div style="width: 150px; background: #ccc; padding: 20px 30px; margin: 10px;">
                        Time<br><b id="show_days">6 Days</b>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            <h3 style="color: #0088cc; font-weight: bold; margin: 40px 0px;">Enter Your Details</h3>
        </div>

        <div class="col-md-12 form-group">
            <label style="font-size: 16px;">Your Name: </label>
            <input class="form-control" type="text" name="name" id="name" required>
        </div>

        <div class="col-md-12 form-group">
            <label style="font-size: 16px;">Your Current Telephone Number: </label>
            <input class="form-control" type="text" name="phone" id="phone" required>
        </div>

        <div class="col-md-12 form-group">
            <label style="font-size: 16px;">Your Email Address: </label>
            <input class="form-control" type="text" name="email" id="email" required>
        </div>

        <div class="col-md-12 form-group">
            <label style="font-size: 16px;">Your IMEI Number: - Just Dial *#06# on your phone</label>
            <input class="form-control" type="text" name="imei" id="imei" required>
            <span class="text-danger imei_error"></span>
        </div>

        <div class="col-md-12 text-center">
            <div id='paymentSection'></div>
        </div>

        <div class="col-md-12">
            <font color="#FF0000" size="1" face="Arial, Helvetica, sans-serif">
                <?php echo (isset($_GET['res']) && $_GET['res'] == 0) ? 'Payment Failed' : ''; ?>
                <?php echo (isset($_GET['res']) && $_GET['res'] == 1) ? 'Payment Successfull' : ''; ?>        
            </font>
        </div>


        <div class="col-md-12 text-center">
            <input type="hidden" name="price" id="price">
            <input type="hidden" name="days" id="days">
            <br>
            <button class="btn btn-info payment" style="padding: 5px 100px; border-radius: 20px; margin: 40px 0px;" onclick="Worldpay.submitTemplateForm()">Complete Payment</button>
        </div>
    </div>
</form>

<?php include_once("includes/footer.php");?>