<!DOCTYPE html>
<html lang="en" style="height:100%;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Perpustakaan</title>

    <link rel="stylesheet" href="app/public/css/materialize.min.css">
</head>
<body style="height:100%;">
    <main class="valign-wrapper" style="height:100%;">
        <div class="row container">
            <div class="col s6 offset-s3">
                <form action="" method="post">
                    <section class="card-panel">
                        <h5 class="center">Login</h5>
                        <div class="input-field">
                            <input id="username" type="text" class="validate">
                            <label for="username">Username</label>
                        </div>
                        <div class="input-field">
                            <input id="password" type="password" class="validate">
                            <label for="password">Password</label>
                        </div>
                        <button class="btn red accent-4 waves-effect waves-light" id="login-button">Masuk</button>
                    </section>
                </form>
            </div>
        </div>
    </main>

    <script src="app/public/js/jquery.js"></script>
    <script src="app/public/js/materialize.min.js"></script>
    <script>
        $(document).ready(() => {
            $('#login-button').click(() => {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo ROOT ?>app/controllers/login/login.php',
                    data: {
                        username: $('#username').val(),
                        password: $('#password').val(),
                        login: true
                    },
                    success: function(response) {
                        console.log(response)
                        const resp = JSON.parse(response);
                        if (resp.status === 200) {
                            window.location = '<?php echo ROOT ?>'
                        } else {
                            alert(resp.message)
                        }
                    }
                })
            })

            $('form').submit(evt => evt.preventDefault())
        })
    </script>
</body>
</html>