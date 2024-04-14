<!------------------------------------------------------------ Receipt Popup ------------------------------------------------------------>
<div class="modal fade" id="Receipt-Form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: #222; border-radius: 10px;">
            <div class="modal-body" style="background-color: #222;">
                <div class="receipt-container">
                    <div class="receipt-details">
                        <h3 class="receipt-heading">Receipt Details</h3>

                        <div class="details">
                            <p><strong>Name:</strong> John Doe</p>
                            <p><strong>Email:</strong> johndoe@example.com</p>
                            <p><strong>Payment:</strong> Credit Card</p>
                            <p><strong>Payment Date:</strong> January 1, 2024</p>
                            <p><strong>Payment Time:</strong> 10:00 AM</p>
                        </div>
                        <hr>
                        <div class="total-price">
                            <p><strong>Total Price:</strong> $50.00</p>
                        </div>
                        <div class="purchase-id">
                            <p><strong>Purchase ID:</strong> ABC123</p>
                        </div>
                        <?php if(isset($_SESSION['User'])): ?>
                            <div class="total-price">
                                <p><strong>Please, check your email for a copy of the receipt...</strong></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>