<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SubstyleMedia Online Store</title>
    <link rel="stylesheet" href="style.css">
</head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<body>

<?php
//Include db configuration file
include 'dbConfig.php';

//PayPal API URL
$paypalURL = 'https://www.sandbox.paypal.com/cgi-bin/webscr';

//PayPal Business Email
$paypalID = 'store@substyleprod.com';
?>

<?php include 'sections/navbar.php';?>
<div class="container">
<?php
    //Fetch products from the database
    $results = $db->query("SELECT * FROM products");
    while($row = $results->fetch_assoc()){
?>
<div class="card-deck">
<div class="card">
    <div class="card-body">
        <img class="card-img-top" src="images/<?php echo $row['image']; ?>"/>
        <h4 class="card-title">Name: <?php echo $row['name']; ?></h4>
        <p class="card-text">Price: <?php echo $row['price']; ?></p>
        <form target="_self" action="<?php echo $paypalURL; ?>" method="post">
            <!-- Identify your business so that you can collect the payments. -->
            <input type="hidden" name="business" value="<?php echo $paypalID; ?>">
            
            <!-- Specify a PayPal Shopping Cart Add to Cart button. -->
            <input type="hidden" name="cmd" value="_cart">
            <input type="hidden" name="add" value="1">
            
            <!-- Specify details about the item that buyers will purchase. -->
            <input type="hidden" name="item_name" value="<?php echo $row['name']; ?>">
            <input type="hidden" name="item_number" value="<?php echo $row['id']; ?>">
            <input type="hidden" name="amount" value="<?php echo $row['price']; ?>">
            <input type="hidden" name="currency_code" value="USD">
            
            <!-- Specify URLs -->
            <input type='hidden' name='cancel_return' value='http://localhost/codex/cancel.php'>
            <input type='hidden' name='return' value='http://localhost/codex/success.php'>
            
            <!-- Display the payment button. -->
            <input type="image" name="submit"
              src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_addtocart_120x26.png"
              alt="Add to Cart">
            <img alt="" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif">
        </form>
    </div>
</div>
<?php } ?>
</div>
</div>


<?php 
include 'sections/footer.php';
?>


<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>

