<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <title>Add Game</title>
    <style>
        body{
            font-family: 'Montserrat', sans-serif;
            justify-content: center;
        }
        p{
            font-weight: bold;
            color: white;
            font-size: 16px;
        }
    .container{
        text-align: center; 
        background-color: #5d5d5d;
        border-radius: 25px;
        padding: 2%;
        width: 500px;
        margin: 40px;
        margin-left: auto; 
        margin-right: auto;
    }
    select{
        border-radius: 16.5px;
        width: 420px;
        padding: 7.5px;
        background-color: #dddddd;
    }
    label{
        margin-left: 16.5px;
        color: white;
        font-size: 15px;
        font-weight: lighter;
        float: left; /* Align text to the left */
    }
    input{
        border-radius: 16.5px;
        width: 420px;
        padding: 7.5px;
    }
    textarea {
    border-radius: 7.5px;
    padding: 8.5px;
    width: 416px; /* Adjust the width as needed */
    height: 150px; /* Adjust the height as needed */
}
.submit-button {
  font-weight: bold;
  background-color: #ababab;
  border: none;
  border-radius: 25px;
  color: black;
  font-size: 16px;
  padding: 10px 20px;
  text-decoration: none;
  width: 170px; /* Adjusted width */
  display: block;
  margin-top: 7.5px;
  margin-left: auto; /* Aligns the button to the right */
  margin-right: auto;
  }
    .file-upload{
        display: none;
        margin-left: 8px;
        border-radius: 16.5px;
        width: 420px;
        padding: 7.5px;
        border: 1px solid #ccc;
        outline: none;
        font-size: 16px;
        background-color: white;
        cursor: pointer;
    }    .file-upload{
        display: none;
        margin-left: 8px;
        border-radius: 16.5px;
        width: 420px;
        padding: 7.5px;
        border: 1px solid #ccc;
        outline: none;
        font-size: 16px;
        background-color: white;
        cursor: pointer;
    }
    #inputFile::-webkit-file-upload-button {
    visibility: hidden;
    }
    input[type='file'] {
        text-align: center;
        overflow: hidden;
    }
    </style>
    <script>
        document.getElementById("inputFile").addEventListener("change", function() {
        if (this.value) {
            this.setAttribute("data-title", this.value.replace(/^.*[\\\/]/, ''));
        } else {
            this.setAttribute("data-title", "No file chosen");
        }
        });
    </script>
</head>
<body style="background-color: #1e1e1e">
    <div class="container">
        <form action="" method="post">
        <p style="font-size: 25px; margin-top: 16px; margin-bottom: 29px">Add a New Game</p>
        
        <label for="name">Game Name</label><br>
        <input type="text" name="" required><br><br>
        
        <label for="developer">Game Developer</label><br>
        <select name="" required>
        <option></option>
        </select><br><br>
        
        <label for="price">Game Price</label><br>
        <input type="float" name="" required><br><br>
        
        <label for="genre">Game Genre</label><br>
        <select name="" required>
        <option></option>
        </select><br><br>
        
        <label for="game_image">Game Image</label>
        <input type="file" id="inputFile" class="file-upload" name="" placeholder="Upload" accept="image/png, image/jpeg" required><br>
        
        <label for="game_image">Game Background</label>
        <input type="file" id="inputFile" class="file-upload" name="" placeholder="Upload" accept="image/png, image/jpeg" required><br>

        <label for="game_image">Game Screenshots</label>
        <input type="file" id="inputFile" class="file-upload" name="" style="margin-bottom: 15px;" placeholder="Upload Screenshot 1" accept="image/png, image/jpeg" required>
        <input type="file" id="inputFile" class="file-upload" name="" style="margin-bottom: 15px;" placeholder="Upload Screenshot 2" accept="image/png, image/jpeg" required>
        <input type="file" id="inputFile" class="file-upload" name="" placeholder="Upload Screenshot 3" accept="image/png, image/jpeg" required>
        <br>

        <label for="game_desc">Game Description</label>
        <textarea name="" rows="4" placeholder="Write description here..." required></textarea><br><br>
        
        <input type="submit" class="submit-button"><br>
        <a href="" style="margin-top: 10px; color: white; text-decoration: none;">Cancel</a>
    </form>
    </div>
</body>
</html>
