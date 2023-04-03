<?php
class ConnectedUser
{
    private array $user;

    public function __construct($pdo)
    {
        $stmt_user = $pdo->prepare('SELECT * FROM utilisateurs WHERE id_u=:id ');
        $stmt_user->execute(
            [
                'id' => $_SESSION['id_u']
            ]
        );
        $this->user = $stmt_user->fetch();
    }

    public function getUserId(): string
    {
        return $this->user['id_u'];
    }

    public function getUserName(): string
    {
        return $this->user['name_u'];
    }

    public function getUserFirstname(): string
    {
        return $this->user['firstname_u'];
    }

    public function getUserBirthdate(): string
    {
        return $this->user['naissance_u'];
    }

    public function getUserEmail(): string
    {
        return $this->user['email'];
    }

    public function getUserAddress(): string
    {
        return $this->user['adresse_u'];
    }

    public function getUserMdp(): string
    {
        return $this->user['mdp_u'];
    }

    public function displayAccount(): void
    {
?>
        <div class="row bg-white justify-content-center text-dark py-5 rounded-4 mt-5">
            <h2 class="text-center mb-5">Mes infos</h2>
            <div class="d-flex justify-content-around text-center mb-">
                <p class="fs-4 fw-bold">Nom <br><?php echo $this->user['name_u']; ?></p>
                <p class="fs-4 fw-bold">Prénom <br><?php echo $this->user['firstname_u']; ?></p>
            </div>
            <div class="d-flex justify-content-around text-center">
                <p class="fs-4 fw-bold">Date de naissance <br><?php echo date_format(date_create($this->user['naissance_u']), "d/m/Y"); ?></p>
                <p class="fs-4 fw-bold">Email <br><?php echo $this->user['email']; ?></p>
            </div>
        </div>
<?php
    }
}
