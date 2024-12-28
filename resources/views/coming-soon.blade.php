<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gratis Health Care</title>
    <style>
    body {
        margin: 0px;
        position: relative;
    }

    .background-img {
        width: 100%;
        height: 100vh;
    }

    .background-sections {
        position: relative;
    }

    .overlay-section {
        position: absolute;
        top: -15px;
        background: #000000ab;
        ;
        width: 100%;
        height: 100%;
        align-content: center;
        text-align: center;
    }

    p {
        color: white;
        font-size: 5vh;
    }

    p img {
        width: 10%;
    }
    </style>
</head>

<body>
    <img class="background-img" src="{{asset('assets/images/banner.jpg')}}" alt="">
    <div class="overlay-section">

        <p>
            <img src="{{asset('assets/images/logo.png')}}" alt="">
            <br>
            Coming Soon
        </p>
    </div>
</body>

</html>