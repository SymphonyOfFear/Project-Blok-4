<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Registreer Gebruiker</title>
</head>


<body>

    <form method="post" action="verwerk-registreren-gebruiker.php" class="registreren">
        <section>
            <input name="voornaam" type="text" placeholder="Voornaam">
            <input name="tussenvoegsels" type="text" placeholder="Tussenvoegsels">
            <input name="achternaam" type="text" placeholder="Achternaam">
        </section>
        <section>
            <input name="man" id="man" type="radio">
            <label for="man">Man</label>
            <input name="vrouw" id="vrouw"type="radio">
            <label for="vrouw">Vrouw</label>
            <input name="anders"id="anders" type="radio">
            <label for="anders">Anders</label>
        </section>
        <section>
            <input name="email" type="text" placeholder="E-mail">
            <input name="gebruikersnaam" type="text" placeholder="Gebruikersnaam">
            <input name="wachtwoord" type="text" placeholder="Wachtwoord">
        </section>
        <section>
            <input name="straat" type="text" placeholder="Straat">
            <input name="Huisnummer" type="text" placeholder="Huisnummer">
        </section>
    </form>
    <div id="myProgress">
        <div id="myBar"></div>
    </div>

</body>

</html>