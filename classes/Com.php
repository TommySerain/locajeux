<?php

class Com
{

    public function __construct(
        private string $nameUser,
        private string $com,
    ) {
    }

    public function getCom(): string
    {
        return $this->com;
    }
    public function setCom($com): Com
    {
        $this->com = $com;

        return $this;
    }

    public function getnameUser(): string
    {
        return $this->nameUser;
    }
    public function setnameUser($nameUser): Com
    {
        $this->com = $nameUser;

        return $this;
    }

    public function displayCom(): void
    {
?>
        <div class="container bg-white rounded-4 mb-5 p-4">
            <div class="row">
                <p class="text-end">Utilisateur : <?php echo $this->nameUser; ?></p>
                <p>Commentaire : </p>
                <p class="fw-bold"><?php echo $this->com; ?></p>
            </div>
        </div>
<?php
    }
}
