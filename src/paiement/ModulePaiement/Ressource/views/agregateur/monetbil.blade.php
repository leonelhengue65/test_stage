<?php
use paiement\ModulePaiement\Controller\MonetbilController;
?>
<div class="container">
    <div class="row">
        <div class="col-md-5 " style="border: 1px solid #c8eedb;height: 285px">
            <img src="img/monet.png" style="width: 90%;padding-top:25%">
        </div>
        <div class="col-md-7">
            <form class="form-group" method="POST" action="" style="border: 1px solid #9de0f6;padding: 20px;height: 285px">
                <div class="input-group mb-2" style="padding-top: 16%">
                    <input type="text" style="height: 50px;" class="key form-control" id="inlineFormInputGroup" name="service_key"  required   placeholder="service key">
                    <div class="input-group-prepend">
                        <input type="submit" class="send btn btn-primary" value="Valider">
                    </div>
                </div><br>
                <?php
                if (isset($_POST['service_key'])){
                    MonetbilController::setServiceKey($_POST['service_key']);
                    if (MonetbilController::url()==""){
                        echo "<span class='fa fa-exclamation' style='font-size:15px;color: #ad1e40'>&ensp;&ensp;Erreur Veuillez verifier votre service key s'il vous plait</span>";
                    }
                    else{
                        echo "<span class='fa fa-check' style='font-size:15px;color: #ad1e40'>&ensp;&ensp;Votre service key a été  approuvé</span>";
                    }
                }
                ?>
            </form>
        </div>
    </div>
</div>

<script>
  if(window.addEventListener){
    window.addEventListener('load', maFonctionDeTest, false);
}else{
    window.attachEvent('onload', maFonctionDeTest);
}

function maFonctionDeTest()
{

    $('.send').click(function(){

    $.ajax
        ({
              url : __env+'api/add_cle',
              type : 'POST',
              data :{
                cle: $('.key').val(),
                agr: "<?php echo Request::get('route')?>"
                },
              dataType : 'text',
              success : function(code, statut){
                console.log(code);
              }
        });

    })

}
</script>