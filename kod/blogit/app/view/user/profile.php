<!DOCTYPE html>
<html>
<head>
    <title>Profil Użytkownika</title>
</head>
<body>
    <h1>Profil Użytkownika</h1>
    <p>Nazwa użytkownika: <?php echo $user->getUsername(); ?></p>
    <p>Email: <?php echo $user->getEmail(); ?></p>
    <!-- Inne szczegóły użytkownika -->
</body>
</html>