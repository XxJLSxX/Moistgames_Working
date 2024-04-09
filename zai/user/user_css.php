<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
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

  .left-grid .nav-pills a {
        border-radius: 25px;
        background-color: #5d5d5d;
        margin-bottom: 20px;
        text-decoration: none;
        color: black;
        font-weight: bold;
    }
    .left-grid .nav-pills a:active,
    .left-grid .nav-pills a:hover {
        border-radius: 25px;
        background-color: #ababab;
        margin-bottom: 20px;
        text-decoration: none;
        color: black;
        font-weight: bold;
    }

    .left-grid .nav-pills > li.active > a,
    .left-grid .nav-pills > li.active > a:focus,
    .left-grid .nav-pills > li.active > a:hover {
        background-color: #ababab;
        color: black;
    }
    .right-grid table {
        border-collapse: collapse;
        width: 100%;
    }

    .right-grid table tr {
        background-color: #5d5d5d;
    }

    .gap-row {
        height: 20px; /* Adjust the height of the gap */
    }

    .table-container {
    max-height: 500px; /* Adjust as needed */
    overflow-y: auto;
    padding-right: 10px; /* Add padding to create space between <tr> and scrollbar */
}

/* Styling for the scrollbar */
.table-container::-webkit-scrollbar {
    width: 12px; /* Width of the scrollbar */
    padding-right: 16px; /* Adjust padding to match the width of the scrollbar */
}

/* Styling for the scrollbar track */
.table-container::-webkit-scrollbar-track {
    background-color: #3b3b3b; /* Background color of the track */
    border-radius: 5px;
}

/* Styling for the scrollbar thumb */
.table-container::-webkit-scrollbar-thumb {
    background-color: #101010; /* Color of the scrollbar thumb */
    border-radius: 5px; /* Border radius of the scrollbar thumb */
}

    .right-grid table tr td {
        border: none; /* Remove default table cell borders */
        padding: 14px; /* Adjust cell padding */
        display: flex; /* Use flexbox for layout */
        justify-content: space-between; /* Align items with space between */
        align-items: center; /* Align items vertically */
    }
    .view-receipt {
    display: inline-block; /* Make it inline-block so it respects the alignment */
    margin-top: 3px; /* Adjust as needed to align vertically */
    margin-bottom: 10px;
    border-radius: 25px;
    font-size: 12px;
    color: black;
    background-color: #dddddd;
    padding: 6px 30px;
    text-decoration: none; /* Remove underline */
}

.view-receipt:hover {
    text-decoration: none;
    background-color: #cccccc; /* Darken on hover */
    cursor: pointer;
    color: black;
}
    .vl{
      border-left: 3px solid white;
      height: 500px;
      position: relative;
    }

    .banner-container {
    position: relative;
    display: inline-block;
    width: 100%;
}

.banner-container::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to left, 
                                rgba(150, 150, 150, 0), 
                                rgba(59, 59, 59, 0), 
                                rgba(23, 23, 23, 0.1), 
                                #101010, 
                                #101010, 
                                #101010) left,
                linear-gradient(to right, 
                                rgba(150, 150, 150, 0), 
                                rgba(59, 59, 59, 0), 
                                rgba(23, 23, 23, 0.1), 
                                #101010, 
                                #101010, 
                                #101010) right;
    background-size: 50% 100%; /* Adjust as needed */
    background-repeat: no-repeat;
}
    .banner-container img {
        display: block;
        width: 100%;
        height: 187.5px;
        object-fit: cover;
    }

    .user-dev{
      border-radius: 25px;
      padding: 10px 29px;
      color: white;
      font-size: 19px;
      background-color: #5d5d5d; 
    }
    .user-dev.active,
    .user-dev:hover {
        text-decoration: none;
        color: white;
        background-color: #ababab; 
    }
    .game-panel{
      height: 180px;
      width: 290px;
      object-fit: cover;
      border-radius: 25px;
      margin-right: 6.8px; /* Add margin to the right of each image */
    }

    .pagination-container {
        width: 100%;
        text-align: center;
      }

    .pagination {
      display: inline-block;
    }

    .pagination span {
      margin: 0 3px;
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
      font-size: 16px;
    }

    .custom-pagination .arrow:hover,
    .custom-pagination .page-number:hover {
      color: #555;
    }

    .tab {
            display: inline-block;
            margin-left: 90px;
        }
    
  </style>
</head>
