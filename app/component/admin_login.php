
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <link rel="stylesheet" href="sass/admin/admin.css">
    <script src="jquery/jquery.3.5.1.js"></script>
</head>
<body>

    <div class="errorPro"></div>
    <main>
            <div> <h1 id="title"> Application de gestion d'inventaire </h1> </div>
           
            <form action="" method="post" class='form-login'>
                <input type="text" name="actionLogin" hidden value="login">
                <input type="email" name="email-login" placeholder="donner votre email">
                <input type="password" name="password-login" placeholder="donner votre mote de passe"><br>
                <input type="submit" value="connexion">
            </form>
    </main>

<script src="js/admin.js"></script>
</body>
</html>
