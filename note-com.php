<?php
require_once __DIR__ . "/fonctions/fonctions.php";
if (!isset($_GET['id'])) {
    redirect("index.php");
}
require_once __DIR__ . "/pdo/db.php";
$gameId = intval($_GET['id']);
$stmt = $pdo->prepare("SELECT * FROM jeux WHERE id_j=:id");
$stmt->execute(
    [
        "id" => $gameId
    ]
);
$game = $stmt->fetch();
if ($game === false) {
    redirect("index.php");
};
require_once __DIR__ . "/layout/header.php";
require_once __DIR__ . "/classes/ErrorMsg.php";
if (!isset($_SESSION['connected'])) {
    redirect("index.php");
}
if (isset($_GET['erreur'])) {
    errorDisplay();
} ?>

<section class="container">
    <h1 class="text-white text-center mt-3 fs-3">Tu as loué <?php echo $game['name_j']; ?><br> tu aimerais le noter et le commenter ? </h1>
    <div class="row g-5">
        <div class="col-8 mx-auto bg-white p-5 pb-3 rounded-4">
            <form class="text-center" action="note-com-traitement.php?id=<?php echo $gameId; ?>" method="POST">
                <h2 class="mb-4 fs-3">Ta note pour ce jeu</h2>
                <label class="fs-4" for="1">1</label>
                <input class="me-4" type="radio" name="note" value="1" id="1">
                <label class="fs-4" for="2">2</label>
                <input class="me-4" type="radio" name="note" value="2" id="2">
                <label class="fs-4" for="3">3</label>
                <input class="me-4" type="radio" name="note" value="3" id="3" required>
                <label class="fs-4" for="4">4</label>
                <input class="me-4" type="radio" name="note" value="4" id="4">
                <label class="fs-4" for="5">5</label>
                <input type="radio" name="note" value="5" id="5">
                <h2 class="my-4 fs-3">Ton commentaire pour ce jeu</h2>
                <textarea class="form-control com" name="com" id="com" placeholder="Ton commentaire ici" cols="30" rows="4" maxlength="200" required></textarea>
                <input class="btn btn-success mt-3" type="submit" value="Envoyer">
            </form>
        </div>
    </div>
</section>