<?php
if (isset($_SESSION['User'])) { ?>
    <div class='nav'>
        <img src='../img/logo.png' alt='logo'>
        <a class='nav-title' href=''>Store</a>
        <a class='nav-title' href=''>Library</a>
        <a class='nav-title' href=''>Purchase History</a>
        <a class='nav-title' href=''>About Us</a>
        <button class='search-btn' id='search-button' onclick='opensearch()'><img src='../img/search.png' alt='search'></button>
        <div class='search-popup' id='S-pup'>
            <input type='text' id='search-input' placeholder='Search a game...' autocomplete='off'>
        </div>
        <a href='' class='profile-user'>            
            <img src='../img/default-icon.png' alt'profile'>
            <p><?php $username ?></p>
        </a>
         <a href="../Database/Logout.php" class='user-logout' > <!-- data-bs-toggle="modal" data-bs-target="#Logout_Form" -->
            <img src='../img/logout-logo.png' alt'logout'>
        </a>
    </div>
    <div class='search-result' id='showdata'></div>
<?php } else if (isset($_SESSION['Admin'])) { ?>
    <div class='nav'>
        <a href="../Admin/">
        <img src='../img/logo.png' alt='logo'>
        </a>
        <a class='nav-title' href='Admin_GameLibrary.php'>Games</a>
        <a class='nav-title' href='Game_Devs.php'>Game Developers</a>
        <a class='nav-title' href=''>Transactions</a>
        <a class='nav-title' href=''>Featured Posts</a>
        
        <div class="nav-logout">
            <!-- data-bs-toggle="modal" data-bs-target="#Logout-Prompt" -->
            <a href="../Database/Logout.php" class='user-logout-admin' style="float: right;"> 
            <img src='../img/logout-logo.png' alt'logout'>
        </a>
        </div>
    </div>
<?php } else { ?>
    <div class='nav'>
        <img src='../img/logo.png' alt='logo'>
        <a class='nav-title' href=''>Store</a>
        <a class='nav-title' href=''>About Us</a>
        <button class='search-btn' id='search-button' onclick='opensearch()'><img src='../img/search.png' alt='search'></button>
        <div class='search-popup' id='S-pup'>
            <input type='text' id='search-input' placeholder='Search a game...' autocomplete='off'>
        </div>
        <a class='user-logout' href='' data-bs-toggle="modal" data-bs-target="#Signin-Form"><img src="../img/login-logo.png" alt="Login"></a>
        <!-- <a class='user-logout' href='' data-bs-toggle="modal" data-bs-target="#Completion-Prompt"><img src="../img/login-logo.png" alt="Login"></a> -->
    </div>
    <div class='search-result' id='showdata'></div>
<?php }?>

<html> <!------------------------ Popups ------------------------>
<!------------------------------------------------------ Sign in ------------------------------------------------------>
<div class="modal fade" id="Signin-Form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: #5d5d5d; border-radius: 10px;">
                <div class="modal-body">
                <form action="" method="post">
                    <center>
                        <a href="../Main/index.php">
                            <img src="../img/logo.png" style="aspect-ratio: 2 / 1; width: 150px;">
                        </a>
                        <p id="signin">Sign In</p>
                        <label for="email">Email:</label><br>
                            <input type="email" name="email" placeholder="Email" required><br><br>
                        <label for="password">Password:</label><br>
                            <input type="password" name="password" placeholder="Password"><br><br>
                        <div class="flex-container">
                            <button type="submit" name="login" class="btn btn-primary w-50">SIGN IN</button><br>
                            <p>OR</p>
                            <button type="button" class="btn btn-primary w-50" data-bs-toggle="modal" data-bs-target="#Signup-Form" >SIGN UP</button></br>
                            <button type="button" class="btn btn-secondary w-50" data-bs-dismiss="modal">CLOSE</button>
                        </div>
                    </center>
                </form>
                </div>
            </div>
        </div>
    </div>
<!------------------------------------------------------ Sign up ------------------------------------------------------>
    <div class="modal fade" id="Signup-Form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: #5d5d5d; border-radius: 10px;">
                <div class="modal-body">
                <form action="" method="post">
                    <center>
                        <a href="../Main/index.php">
                            <img src="../img/logo.png" style="aspect-ratio: 2 / 1; width: 150px;">
                        </a>
                        <h1>Sign Up</h1>
                        <div class = "mb-3">
                            <label for="Name">Name:</label>
                            <input type="text" name="Name"placeholder="Full Name" class="form-control" required>
                        </div>    

                        <div class = "mb-3">    
                            <label for="User_Name">Username:</label>
                            <input type="text" name="User_Name" placeholder="User Name" class="form-control" required>
                        </div>

                        <!--Lagyan din ng format restriction/ and verification-->
                        <div class = "mb-3">
                            <label for="Email">Email:</label>
                            <input type="email" name="Email" placeholder="Email Address" class="form-control" required>
                        </div>

                        <!--Lagyan re-type password-->
                        <div class = "mb-3">
                            <label for="Password">Password:</label>
                            <input type="password" name="Password" placeholder="Password" class="form-control" required>
                        </div>

                        <div class = "mb-3">
                            <label for="Payment_Method">Payment Method:</label>
                            <select name="Payment_Method" class="form-select" required>
                                <option value="" disabled selected>Select Payment Method</option>
                                <option value="1">Card Payment</option>
                                <option value="2">EWallet Payment</option>
                            </select>
                        </div>  
                        <div class="flex-container">
                            <button type="submit" name="register" class="btn btn-primary w-50">SIGN UP</button><br>
                            <p>OR</p>
                            <button type="button" class="btn btn-primary w-50" data-bs-toggle="modal" data-bs-target="#Signin-Form" >SIGN IN</button></br>
                            <button type="button" class="btn btn-secondary w-50" data-bs-dismiss="modal">CLOSE</button>
                        </div>
                    </center>
                </form>
                </div>
            </div>
        </div>
    </div>

    <!------------------------------------------------------ Buy Game Popup ------------------------------------------------------>
    <div class="modal fade" id="Buy-Form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content" style="background-color: #222; border-radius: 10px;">
                <div class="modal-body" style="background-color: #222;">
                    <div class="buy-container">
                            <div class="game-details">
                                <img src="../Games/aaaaaaaaaa/Image.png" alt="Game Image" class="game-image">
                                <h3>Monster Hunter Rise: Sunbreak</h3>
                                <p>CAPCOM CO., Ltd</p>
                                <p class="abtn action-abtn">Action</p>
                                <button class="btn view-details">View Details</button>
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

</html> <!------------------------ Popups End ------------------------>

<script>
    let popup = document.getElementById('S-pup');
    let searchButton = document.getElementById('search-button');

    function opensearch() {
        if (popup.classList.contains('open-search-popup')) {
            popup.classList.remove('open-search-popup');
            searchButton.style.visibility = 'visible'; 
            setTimeout(() => {
                popup.style.display = 'none';
            }, 300);
        } else {
            popup.style.display = 'block';
            searchButton.style.visibility = 'hidden';
            setTimeout(() => {
                popup.classList.add('open-search-popup');
                document.getElementById('search-input').focus();
            }, 10);
        }
    }
    document.addEventListener('click', function(event) {
        let isClickInsideSearchBox = popup.contains(event.target);
        let isClickOnSearchButton = searchButton.contains(event.target);

        if (!isClickInsideSearchBox && !isClickOnSearchButton) {
            if (popup.classList.contains('open-search-popup')) {
                popup.classList.remove('open-search-popup');
                setTimeout(() => {
                    popup.style.display = 'none';
                    searchButton.style.visibility = 'visible';
                }, 100);
            }
        }
    });
    $(document).ready(function() {
        $('#search-input').on('keyup', function() {
            var getName = $(this).val();
            if (getName.trim() !== '') {
                $.ajax({
                    method: 'POST',
                    url: 'search-game.php',
                    data: {
                        name: getName
                    },
                    success: function(response) {
                        $('#showdata').html(response);
                    }
                });
            } else {
                $('#showdata').html(''); // Clear the search results if input is empty
            }
        });

        // Clear search results and input when clicking outside the search box and search results
        $(document).on('click', function(event) {
            var searchBox = $('#S-pup');
            var searchInput = $('#search-input');
            var searchResults = $('#showdata');
            // Check if the clicked area is outside the search box, search results, and not the search button
            if (!searchBox.is(event.target) && searchBox.has(event.target).length === 0 &&
                !searchResults.is(event.target) && searchResults.has(event.target).length === 0 &&
                !$('#search-button').is(event.target)) {
                searchResults.html(''); // Clear the search results
                searchInput.val(''); // Clear the search input
            }
        });

        // Optionally, clear search results when the search input loses focus
        $('#search-input').on('blur', function() {
            // Delay clearing to allow for interaction with search results
            setTimeout(() => {
                $('#showdata').html(''); // Clear the search results
                // If you want to clear the input as well when it loses focus, uncomment the next line
                // $(this).val('');
            }, 200); // Adjust delay as needed to allow clicks to register on the search results
        });
    });
</script>