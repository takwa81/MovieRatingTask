<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
</head>
<body>
    <center>
        <h2 style="padding: 23px;background: #b3deb8a1;border-bottom: 6px green solid;">
            <a href="">Hi {{$data['full_name']}} You Are Register in Enaya Application </a>
        </h2>

    </center>
     <p>Do You Forget Passoword ? to Reset passowrord please enter verify code and reset password !!<p>
        <br>
        <br>
        <h5 style="text-align: center ; padding:10px">{{$data['code']}}</h5>

    <strong>Thank you . )</strong>
</body>
</html>