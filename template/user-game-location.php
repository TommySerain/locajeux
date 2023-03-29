<div class="row bg-white justify-content-center text-dark p-5 rounded-4 my-5">
    <h2 class="text-center mb-5">Les jeux que j'ai loués</h2>
    <div>
        <table class="w-100">
            <tr>
                <th class="fs-4 pb-4">Nom du jeu</th>
                <th class="fs-4 pb-4">Date de rendu prévue</th>
                <th class="fs-4 pb-4">Date de location</th>
                <th class="fs-4 pb-4"></th>
            </tr>
            <?php
            $nbJeuxLoues = 0;
            while ($game = $games->fetch()) {
                $nbJeuxLoues += 1;
                $dateDispo = $game['date_dispo'];
                $dateLoc = $game['date_loc'];
            ?>
                <tr>
                    <td class="pb-4"><a class="fs-5 fw-bold mb-0 text-decoration-none" href="fichejeux.php?id=<?php echo $game['id_j']; ?>"><?php echo $game['name_j']; ?></a></td>
                    <td class="pb-4">
                        <?php
                        if ($dateDispo) { ?>
                            <p class="fs-5 fw-bold mb-0"><?php echo dateToFrenchFormat($dateDispo); ?></p>
                        <?php }
                        ?>
                    </td>
                    <td class="pb-4">
                        <p class="fs-5 fw-bold mb-0"><?php echo dateToFrenchFormat($dateLoc); ?></p>
                    </td>
                    <td class="pb-4">
                        <?php
                        if ($game['date_dispo']) { ?>
                            <a class="btn btn-success" href="rendre.php?id=<?php echo $game['id_j']; ?>">Rendre le jeu</a>
                            <?php
                        } else {
                            if (!$game['note'] && !$game['com']) { ?>
                                <a class="btn btn-success" id='btnNote' href="note-com.php?id=<?php echo $game['id_j']; ?>">Noter / Commenter</a>
                            <?php
                            } else {
                                $notes = $pdo->prepare("SELECT note FROM l_jeux_utilisateurs WHERE id_u=:userId AND id_j=:gameId AND note IS NOT NULL;");
                                $notes->execute(
                                    [
                                        'userId' => $idU,
                                        'gameId' => $game['id_j']
                                    ]
                                );
                                $note = $notes->fetch();
                            ?>
                                <p class="fs-5 fw-bold mb-0">Ta note : <?php echo $note['note']; ?></p>
                        <?php }
                        }
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <p class="fs-5 fw-bold mb-0">Nombre de jeux que j'ai loué : <?php echo $nbJeuxLoues; ?></p>
    </div>
</div>