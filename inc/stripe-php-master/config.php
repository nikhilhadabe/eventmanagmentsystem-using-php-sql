<?php 

require('stripe-php-master/init.php');

$Publishablekey="pk_test_51OvKrOSDsFnCZWFTFvYNqaeF5VP6jgB0qWh5dOramhRt9KLfktjbNQ1M0zWG1inJguYYb9FuNnYJz1e8sFypXYxP00kxvKdfzB";

$Secretkey="sk_test_51OvKrOSDsFnCZWFTGqapKlVPMte0JqGQBiFlr54ahTQT6zIsjadZ9oqINUlPS0aWQEcseiZjfil5i2Kwh8c38c5t00viUwbLZd";

\stripe\stripe ::setApiKey($Secretkey);




?>