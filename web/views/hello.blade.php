<form method="post" action="">
    <input type="text" name="prix" placeholder="montant">
    <input type="submit" value="enregistrer">
</form>
<?php
use paiement\ModulePaiement\Controller\MonetbilController;
if (isset($_POST['prix'])){
        MonetbilController::setAmount($_POST['prix']);
        $a= MonetbilController::url();
    }
?>
<a href="<?php echo $a['payment_url']?>">Payer</a>
