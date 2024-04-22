<?php 
    session_start();
    require '../Database/MoistFunctions.php';
    
    $moistFunction = new MoistFunctions($connection);
    $moistFunctions = new MoistFunctions($connection);

    if (isset($_SESSION['User'])) {
        $userID = $_SESSION['User_ID'];
        $transactionData = $moistFunctions->getTransaction_Data($userID);
    } elseif (isset($_SESSION['Admin'])){
        $transactionData = $moistFunctions->getTransaction_Data();
    } else echo "No Transaction Data";

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
    <link rel="stylesheet" href="../css/header_css.css">
    <link rel="stylesheet" href="../css/All_Admin_CSS.css?+1">
    <title>Transaction Records</title>
</head>

<body class="transactions-body">
    <?php include '../header.php'; ?>
    <h1>Transaction Records</h1>
    <div class="transactions-content">
        <div id="transaction-records">
            <div id="transaction-filters">
                <button id="today-btn">Today</button><br>
                <button id="this-week-btn">This Week</button><br>
                <button id="before-btn">Before</button>
            </div>
            <div id="transaction-list">
                <?php
                    if((isset($_SESSION['User'])) || (isset($_SESSION['Admin']))) {
                        foreach($transactionData as $transaction) : 
                ?>
                        <div class="transaction">
                            <div class="transaction-left">
                                <h2><?php echo $transaction[7]; ?></h2>
                                <p>Purchased by: <strong><?php echo $transaction[5]; ?></strong></p>
                                <p>Date: <?php echo $transaction[1]; ?> <?php echo $transaction[2]; ?></p>
                            </div>
                            <div class="transaction-right">
                                <p><?php if($transaction[8] > 0 ) {
                                            echo $transaction[8];
                                        } else {
                                            echo "FREE";
                                        }
                                    ?>
                                </p>
                                <button>View Receipt</button>
                            </div>
                        </div>
                <?php 
                        endforeach; 
                    } else {
                        echo "
                        <div class='transaction'>
                            <h1>No Transaction Records to Display...</h1>
                        </div>
                        ";
                    }
                ?>
            </div>
        </div>
    </div>
</body>

</html>
<script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
    crossorigin="anonymous">
</script>