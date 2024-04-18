<?php
include '../Popups/Receipt.php';
include '../Popups/CompletionPrompt.php';

?>

$id = $_GET['id'];
$BuyData = $moistFunctions->showRecords('games', NULL, 'developer', "games.Developer_ID", "developer.Developer_ID", "games.Game_ID = '$id'");
    <!------------------------------------------------------ Buy Game Popup ------------------------------------------------------>
    <div class="modal fade" id="Buy-Form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content" style="background-color: #222; border-radius: 10px;">
                <div class="modal-body" style="background-color: #222;">
                    <div class="buy-container">
                            <div class="game-details">
                                <img src="../Games/<?php echo $BuyData[0][2]; ?>/Image.png" alt="Game Image" class="game-image">
                                <h3><?php echo $BuyData[0][2]; ?></h3>
                                <p><?php echo $BuyData[0][9]; ?></p>
                                <p class="abtn action-abtn"><?php echo $BuyData[0][7]; ?></p>
                            </div>  

                        <div class="receipt-details">
                            <h3 class="receipt-heading">Complete Transaction Details</h3>
                            <div class="details">
                                <p><strong>Name:</strong> John Doe</p>
                                <p><strong>Email:</strong> johndoe@example.com</p>
                                <p><strong>Payment-Method:</strong> Card</p>
                            </div>
                            <hr>
                            <div class="buy-total-price">
                                <p><strong>Total Price:</strong> $50.00</p>
                            </div>
                            <div class="buy-purchase-id">
                                <button>Buy game</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
