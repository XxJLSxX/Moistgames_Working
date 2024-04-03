<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="user.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  <title>Profile</title>
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
  .search-container {
    margin-top: 7.5px; 
    margin-bottom: 7.5px; 
    margin-right: 40px; /* Adjusted margin */
    display: flex;
    align-items: center;
    background-color: #999999;
    border: none;
    border-radius: 25px; 
    overflow: hidden;
    width: 200px; 
    position: relative; 
  }
  .search-input {
    background-color: #999999;
    border: none;
    outline: none;
    width: calc(100% - 40px); 
    padding: 10px;
    padding-left: 40px; 
  }

  .search-icon {
    position: absolute; 
    left: 10px; 
    top: 50%; 
    transform: translateY(-50%); 
    width: 25px; 
    height: 20px; 
  }

  .navbar-right {
    display: flex;
    align-items: center;
  }

  a {
    padding-top: 18.6px; 
    padding-bottom: 10px; 
    color: white;
    margin-right: 30px;
    font-size: 16px;
  }

  .container {
    display: flex;
    flex-direction: column;
    background-color: #1e1e1e; 
    color: white; 
    width: 100%;
    padding: 20px;
    box-sizing: border-box;
  }

  .heading {
    text-align: left;
    margin-bottom: 20px;
  }

  .grid-container {
    display: flex;
  }

  .left-column {
  background-color: #3b3b3b;
  color: white;
  border-radius: 25px;
  padding: 4.5%;
  text-align: center;
  flex: 1;
  font-size: 24px;
  width: 250px; /* Adjusted width */
  margin-right: 20px; /* Added margin */
  margin-bottom: 35px;
  position: relative; /* Added position relative */
  }

  .right-column {
    display: flex;
    flex-direction: column;
    flex: 2.5; /* Adjusted width */
    margin-left: 20px;
  }

  .right-section {
    background-color: #3b3b3b;
    color: white;
    padding: 5.5%;
    text-align: center;
    border-radius: 25px;
    margin-bottom: 40px; /* Adjusted margin */
    font-size: 32px;
  }

  .edit-profile-button {
    font-weight: bold;
  background-color: #dddddd;
  border: none;
  border-radius: 25px;
  color: black;
  font-size: 16px;
  padding: 10px 20px;
  text-decoration: none;
  margin-top: 20px;
  margin-bottom: 20px;
  width: 250px; /* Adjusted width */
  display: block;
  margin-left: auto; /* Aligns the button to the right */
  margin-right: auto;
  }

  .change-password-button {
  font-weight: bold;
  background-color: #ababab;
  border: none;
  border-radius: 25px;
  color: black;
  font-size: 16px;
  padding: 10px 20px;
  text-decoration: none;
  margin-top: 20px;
  margin-bottom: 20px;
  width: 250px; /* Adjusted width */
  display: block;
  margin-left: auto; /* Aligns the button to the right */
  margin-right: auto;
  }

  .log-out-button {
    font-weight: bold;
  background-color: red;
  color: white;
  border: none;
  border-radius: 25px;
  font-size: 16px;
  padding: 10px 20px;
  text-decoration: none;
  margin-top: 175px;
  margin-bottom: 20px;
  width: 250px; /* Adjusted width */
  display: block;
  margin-left: auto; /* Aligns the button to the right */
  margin-right: auto;
  }
  
  .see-more-button {
  font-weight: bold;
  background-color: #dddddd;
  border: none;
  border-radius: 25px;
  color: black;
  font-size: 16px;
  padding: 10px 20px;
  text-decoration: none;
  width: 170px; /* Adjusted width */
  display: block;
  margin-top: 45.5px;
  margin-left: auto; /* Aligns the button to the right */
  margin-right: auto;
  }

  .edit-profile-button:hover {
    background-color: #777777;
  }
  </style>
</head>
