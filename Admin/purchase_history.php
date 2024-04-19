<?php 
    session_start();
    require '../Database/MoistFunctions.php';
    if (!isset($_SESSION['Admin']) && !isset($_SESSION['Student'])) {
        header("Location: ../Main/index.php");
    }
    $moistFunction = new MoistFunctions($connection);
    $moistFunctions = new MoistFunctions($connection);


    if (isset($_SESSION['Admin'])){
        $id = $_SESSION['Admin'];
    }
    if (isset($_SESSION['Student'])){
        $id = $_SESSION['Student'];
        $user_payment = $moistFunctions -> showRecords('users', null, 'payment', 'users.User_ID', 'payment.User_ID', "users.User_ID='$id'");
        $games = $moistFunctions -> showRecords('games');
        $receipt_payment = $moistFunctions -> showRecords('receipt', null, 'payment', 'receipt.Payment_ID', 'payment.Payment_ID', "payment.User_ID='$id'");
        $transaction = $moistFunctions -> showRecords('transaction', "User_ID = '$id'");

    }

    
?>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/index_css.css?+1">
    <link rel="stylesheet" href="../css/admin_css.css?+3">
    <link rel="stylesheet" href="../css/admin_addgames_css.css?+3">
    <link rel="stylesheet" href="../css/header_css.css?+3">
    <link rel="stylesheet" href="../css/footer_css-forall.css?+1">
    <link rel="stylesheet" href="../css/user_library_css.css?+2">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <title>Admin Game Library</title>
</head>

<body style="background-color: #1e1e1e;">

<!-- Purchase History -->
<div style="margin-top: -40px;">
    <div class="container">
        <div style="margin: 0 5% 5% 5%;">
            <h2 class="heading">Transaction Records</h2>
            <br>
            <div class="row">
                <!-- Left grid for vertical pills -->
                <div class="col-md-3 left-grid">
                    <ul class="nav nav-pills nav-stacked" style="text-align: center;">
                        <li class="active"><a href="">Today</a></li>
                        <li><a href="">This Week</a></li>
                        <li><a href="">Before</a></li>
                    </ul>
                </div>
                <!-- Vertical tab -->
                <div class="col-md-1 vl" style="margin-left:-2.4%;"></div>
                <!-- Right grid for vertical pills -->
                <div class="col-md-9 right-grid" style="margin-left:-8.1%;">
                    <div class="table-container">
                        <table>
                            <?php while (count($transaction) > $i) ?>
                                <tr>
                                    <td>
                                        <div>
                                            <h3>Purchased Monster Hunter Rise: Sunbreak</h3>
                                            <p>Date: 3/26/2024 12:48 pm</p>
                                        </div>
                                        <div style="text-align: center;">
                                            <h3>$69.99</h3>
                                            <a class="view-receipt">View Receipt</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; if ($i < 9): ?> <!-- Add gap after all but the last row -->
                                    <tr class="gap-row"></tr>
                                <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
