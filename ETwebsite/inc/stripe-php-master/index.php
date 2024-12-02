<?php
require('config.php');
?>

<form action="submit.php" method="post">
   
    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button" data-key="<?php echo $Publishablekey; ?>" data-amount="500"
    data-name="DNyani EVENT"
    data-description="Nikhil Hadabe"
    data-image="download.jpeg"
    data-currency="inr"
    data-email="nikhilhadabe31@gmail.com";
    >
   </script>
</form>


