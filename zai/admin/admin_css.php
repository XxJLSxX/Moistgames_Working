<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <title>Moisture Games</title>
  <style>
    body, .navbar-brand {
      font-family: 'Montserrat', sans-serif;
    }
    .navbar {
      background-color: #3b3b3b; 
      border-radius: 0; 
    }
    .navbar-nav > li > a {
      padding-top: 18.6px; 
      padding-bottom: 15px; 
      color: white;
      margin-right: 30px;
      font-size: 16px;
    }
    .custom-color {
      color: #3b3b3b; 
    }
    .navbar-right {
      display: flex;
    }

    a {
        padding-top: 18.6px; 
        padding-bottom: 15px; 
        color: white;
        margin-right: 30px;
        font-size: 16px;
    }
        .log-out-button {
        text-align: center;
        background-color: #ff3939;
        color: white;
        border: none;
        border-radius: 25px;
        font-size: 16px;
        margin-top: 7.5px;
        margin-bottom: 3.5px;
        padding: 6.5px;
        text-decoration: none;
        width: 100px;
        display: block;
        margin-left: auto;
        margin-right: 17px;
    }
    .admin-container{
        color: white;
    }
    .container-flex {
      display: flex;
      justify-content: center;
    }

    .container-flex .cards-container {
      display: flex;
      flex-direction: row;
      gap: 1.5vw;
      margin-top: 20px;
    }

    a.card {
      text-decoration: none;
      background-color: #5d5d5d;
      color: white;
      text-align: center;
      font-size: 32px;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      width: calc((100% - 40px) / 3);
    }

    .gamepad, .view-dev {
      margin-top: 16px;
      position: relative;
}

.image-png{
  position: relative;
}

.gamepad:before {
  content: "\f11b";
  font-family: FontAwesome;
  font-style: normal;
  font-weight: normal;
  text-decoration: inherit;
  color: white;
  font-size: 10vw;
}

.image-png:before{
  content: "\f03e";
  font-family: FontAwesome;
  font-style: normal;
  font-weight: normal;
  text-decoration: inherit;
  color: white;
  font-size: 10vw;
}

.view-dev:before {
  content: "\f085"; 
  font-family: FontAwesome;
  font-style: normal;
  font-weight: normal;
  text-decoration: inherit;
  color: white;
  font-size: 10vw; 
}

a.card:hover {
  text-decoration: none;
  background-color: #3b3b3b;
}

.select-button {
  background-color: #999; 
  min-width: 120px; /* Set a minimum width */
  border: none;
  border-radius: 20px;
  padding: 10px;
  font-size: 16px;
  text-align: center;
}

.game-lib {
  display: flex;
  flex-direction: column;
  background-color: #1e1e1e; 
  color: white; 
  width: 100%;
  padding: 20px;
  box-sizing: border-box;
  justify-content: space-between;
}

.add-button {
  text-decoration: none;
  border-radius: 7px;
  color: white;
  background-color: #00bf63;
  min-width: 120px; /* Set a minimum width */
  padding: 20px 20px;
  margin-right: 20px; /* Align the button to the left */
}

a.add-button:hover{
  color: white;
  text-decoration: none;
  background-color: #048648;
}

.game-table {
  width: 100%;
  border-collapse: collapse;
  table-layout: auto;
}

.game-table tr {
  background: linear-gradient(90deg, rgba(150, 150, 150, 0), rgba(59, 59, 59, 0.92), #3b3b3b, #3b3b3b, #3b3b3b, #3b3b3b);
}

.game-table td {
  border: none;
  padding: 8px 14px;
}

.game-table td img {
  max-width: 200px; /* Limit maximum width of images */
  max-height: 200px; /* Limit maximum height of images */
  width: auto; /* Ensure the width adjusts according to the maximum width */
  height: auto; /* Ensure the height adjusts according to the maximum height */
  margin: 0 auto; /* Center the image horizontally */
}


.game-table a {
  background-color: #5d5d5d; 
  min-width: 120px;
  border: none;
  border-radius: 20px;
  padding: 4px 25px;
  font-size: 16px;
  text-align: center;
  cursor: pointer;
}

.game-table a:hover {
  color: white;
  background-color: #999; 
  text-decoration: none;
}

.button-group {
  float: right;
  margin-right: 20px;
  font-weight: bold;
}

.delete-button,
.edit-button {
  text-decoration: none;
  border-radius: 7px;
  color: white;
  min-width: 120px;
  padding: 5px 0px;
  font-size: 16px;
}

.edit-button {
  background-color: #ffcd4e;
}

.delete-button {
  background-color: #ff3939;
}

.rating {
  color: #f39c12;
}

.star {
  font-size: 20px;
}

.pagination-container {
  width: 100%;
  text-align: center;
}

.pagination {
  display: inline-block;
}

    .pagination span {
      margin: 0 5px;
      cursor: pointer;
    }

    .pagination .arrow {
      font-weight: bold;
    }

    /* Custom pagination CSS class */
    .custom-pagination {
      padding: 5px 10px;
      text-align: center;
    }

    .custom-pagination .arrow,
    .custom-pagination .page-number {
      color: white;
      font-size: 20px;
    }

    .custom-pagination .arrow:hover,
    .custom-pagination .page-number:hover {
      color: #555;
    }

</style>
</head>
