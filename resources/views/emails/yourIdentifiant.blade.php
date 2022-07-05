<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
<header  style="background-color:green; color:white; width:50%">
 <span style="color:white"> G-STK</span>
</header>
    <h2 style="color:green"></h2>
    <p>Veuillez voir içi vos identifiants de connexion à G-STK ADMIN :</p>

      <p> <strong>Nom d'utilisateur :</strong> {{ $paddsaAccount['username'] }} </p>
     <p> <strong>Mot de passe :</strong>  {{ $paddsaAccount['password'] }} </p>

    <footer style="background-color:green; color:white; width:50%">
        <sapan style="color:white">G-STK Admin</span>
        <!-- <img src="{{ asset('logo.png') }}" alt="G-STK" /> -->
    </footer>
  </body>
</html>
