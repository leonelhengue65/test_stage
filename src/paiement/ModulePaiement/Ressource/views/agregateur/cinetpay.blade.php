<div class="container">
    <div class="row">
        <div class="col-md-5 " style="border: 1px solid #c8eedb;height: 285px">
            <img src="img/cinetpay.png" style="width: 75%;padding-left: 50px">
        </div>
        <div class="col-md-7">
            <form class="form-group" method="POST" style="border: 1px solid #9de0f6;padding: 20px;height: 285px">
                <input type="text" style="height: 45px;" name="service_key" class="form-control" required  placeholder="Service key" ><br>
                <input type="text" style="height: 45px;" name="cout" class="form-control" required  placeholder="Montant"><br>
                <input type="text" style="height: 45px;" name="logo" class="form-control"   placeholder="entrer l'url du logo"><br>
                <div class="input-group mb-2">
                    <!-- Target -->
                    <input type="text" style="height: 45px;" class="form-control" id="inlineFormInputGroup"  disabled  placeholder="API" value="<?php echo $payment_url?>">
                    <div class="input-group-prepend">
                        <span class="copy btn btn-primary" data-clipboard-action="copy" data-clipboard-target="#inlineFormInputGroup"><span class="fa fa-copy" style="padding-top: 10px">&ensp;Copy</span></span>
                    </div>
                </div><br>
                <input type="submit" class="btn btn-danger text-uppercase btn-lg" style="float: right" value="generer API"><br><br>
            </form>

        </div>
    </div>
</div>
<script src="js/clipboard.min.js"></script>
<script>
    var clipboard = new ClipboardJS('.copy');

    if (document.getElementById('inlineFormInputGroup').value !=''){
        document.getElementById('inlineFormInputGroup').disabled=false;
    }
    else {
    }


</script>
