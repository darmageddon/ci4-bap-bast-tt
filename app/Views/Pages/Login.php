<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
    <link rel="stylesheet" href="/assets/fonts/fontawesome-all.min.css">
    <style>
        .login-layout {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            background: #e5e5e5;
        }

        .login-container {
            width: 320px;
            margin: 20px auto 0 auto;
        }

        .login-body {
            padding: 20px 0;
            background: #ffffff;
            border: solid 1px #ffffff;
            border-radius: 4px;
        }

        .form-login {
            margin: 20px;
        }

        .login-message {
            display: block;
            margin: 20px;
        }

        .login-message-none {
            display: none;
        }

        .form-label-group {
            position: relative;
            margin-bottom: 1rem;
        }

        .form-label-group input:focus {
            border-color: #ced4da;
            color: #495057;
            background-color: #fff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(21,169,139,.25);
        }

        .form-label-group > input,
        .form-label-group > label {
            height: 3.125rem;
            padding: .75rem;
        }

        .form-label-group > label {
            position: absolute;
            top: 0;
            left: 0;
            display: block;
            width: 100%;
            margin-bottom: 0; /* Override default `<label>` margin */
            line-height: 1.5;
            color: #495057;
            pointer-events: none;
            cursor: text; /* Match the input under the label */
            border: 1px solid transparent;
            border-radius: .25rem;
            transition: all .1s ease-in-out;
        }

        .form-label-group input::-webkit-input-placeholder,
        .form-label-group input:-ms-input-placeholder,
        .form-label-group input::-ms-input-placeholder,
        .form-label-group input::-moz-placeholder,
        .form-label-group input::placeholder {
            color: transparent;
        }

        .form-label-group input:not(:placeholder-shown) {
            padding-top: 1.25rem;
            padding-bottom: .25rem;
        }

        .form-label-group input:not(:placeholder-shown) ~ label {
            padding-top: .25rem;
            padding-bottom: .25rem;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body class="login-layout">
    <div class="login-container">
        <div class="login-body shadow-sm mt-4">
            <form class="form-login" action="/login" method="post">
                <div class="form-label-group">
                    <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
                    <label for="inputUsername">Username</label>
                </div>
                <div class="form-label-group">
                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                    <label for="inputPassword">Password</label>
                </div>
                <button class="btn btn-primary btn-block" type="submit">Log In</button>
            </form>
        </div>
    </div>
</body>
</html>
