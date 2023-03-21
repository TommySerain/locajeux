<?php
if (!empty($_POST)) {
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email=:email AND mdp_u=:mdp_u");
    $stmt->execute(
        [
            'email' => $_POST['email'],
            'mdp_u' => $_POST['mdp_u']
        ]
    );
    $user = $stmt->fetch();
    // var_dump($user);
    if ($user) {
        $_SESSION = [
            'name' => $user['name_u'],
            'firstname' => $user['firstname_u'],
            'naissance' => $user['naissance_u'],
            'email' => $user['email'],
            'address' => $user['address_u'],
            'ville' => $user['id_v'],
            'mdp' => $user['mdp_u'],
            'connected' => true
        ];
        header('Location: mon_compte.php');
    }
    if (empty($_SESSION)) {
?>
        <h2 class="text-center mt-5">erreur de connexion</h2>
<?php
    }
}
