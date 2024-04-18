<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/loginpop.css">
    <title>Document</title>

</head>

<body>
    <div class="popup-area">
        <div class="popup-con">
            <div class="top-edit-con">
                <p>Edit Review</p>
            </div>
            <div class="bottom-edit-con">
                <form action="" method="post">
                    <textarea name="review" placeholder="Write Review Here" id="text" rows="1">Sample Sample</textarea>
                    <select name="rating" required >
                        <option value="" disabled selected hidden>Give Rate</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <button type="submit" name="submit_review">Submit Review</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>