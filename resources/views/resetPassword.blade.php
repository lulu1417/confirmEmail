
<title>Reset Password</title>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="m-b-md">
            <form name="form1" action={{env('MAIL_UPDATE_PASSWORD_URL')}} method="post">
                @csrf
                <p>New Password</p>
                <p><input type="hidden" name="user" value={{$user}}></p>
                <p><input type="password" name="password"></p>
                <p>Check New Password</p>
                <p><input type="password" name="checkPassword"></p>
                <p><input type="submit" name="submit" value="SEND">
                    <link rel="stylesheet" href="{{ asset('css/button.css') }}">
            </form>
        </div>
    </div>
</div>
</body>
</html>
