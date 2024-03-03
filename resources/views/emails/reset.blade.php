<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verification Email</title>
</head>
<body>
    <center>
        <h2 style="padding: 23px;background: #b3deb8a1;border-bottom: 6px green solid;">
            <a href="">Hi {{$data['full_name']}} You Are Register in Enaya Application </a>
        </h2>

    </center>
     <p>Before You Sign in , We need to verify your Email , Enter The Following code on the Verification Email Page <p>
        <br>
        <br>
        <h5 style="text-align: center ; padding:10px">{{$data['code']}}</h5>

    <strong>Thank you . )</strong>
</body>
</html>