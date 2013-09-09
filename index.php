
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/jquery-1.10.1.min.js"></script>

        <title>SISTEM INFORMASI DIGITALISASI ARSIP SURAT</title>
        <style type="text/css">
            /* Override some defaults */
            body {
                padding-top: 150px; 
                background-image: url('img/stia_gedung.jpg');
                background-size: 1400px 700px;
            }
            .container {
                width: 300px;
            }

            /* The white background content wrapper */
            .container > .content {
                background-color: #fff;
                padding: 20px;
                margin: 0 -20px; 
                -webkit-border-radius: 10px 10px 10px 10px;
                -moz-border-radius: 10px 10px 10px 10px;
                border-radius: 10px 10px 10px 10px;
                -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
                -moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
                box-shadow: 0 1px 2px rgba(0,0,0,.15);
            }

            .login-form {
                margin-left: 65px;
            }

            legend {
                margin-right: -50px;
                font-weight: bold;
                color: #404040;
            }

        </style>
    </head>

    <body>
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="login-form">
                        <h2><img src="img/stia_logo.jpg" class="img-circle" width="65" height="65">&nbsp;&nbsp;LOGIN</h2>
                        <hr>
                        <form method="POST" action="cek_login.php">
                            <fieldset>
                                <div class="clearfix">
                                    <input type="text" placeholder="Nama User" name="user" id="user">
                                </div>
                                <div class="clearfix">
                                    <input type="password" placeholder="Password" name="pass" id="pass">
                                </div>
                                <button class="btn primary" type="submit">Masuk</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</html>
