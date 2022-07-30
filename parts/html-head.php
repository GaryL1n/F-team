<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./images/Street_logo.png" type="image/x-icon" />
    <!-- boostrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="boostrap-color-set.css">

    <!-- google fonts link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">

    <!-- fontawesome link -->
    <link rel="stylesheet" href="fontawesome/css/all.css" />
    <title><?=$title?></title>
    <style>
        .header-color {
            background-color: black;
        }

        .container-maxWidth {
            max-width: 95%;
        }

        .logo-container>a>img {
            width: 90px;
            padding: 10px 0;
        }

        .nav-right {
            display: flex;
            justify-content: end;
            align-items: center;
        }

        .nav-right>a {
            padding: 0 5px;
        }

        .nav-right>a>img {
            width: 20px;
        }

        .list-section {
            float: left;
            width: 20%;
            height: 100vh;
            margin-top: 10px;
            /* border: 1px solid rgb(212, 212, 212); */
        }

        .list-section::after {
            content: '';
            clear: both;
        }

        .list-group {
            border-radius: 0;
        }

        .list-a {
            border: none;
        }

        .fa-cart-shopping,
        .fa-user {
            color: white;
        }
    </style>
</head>
