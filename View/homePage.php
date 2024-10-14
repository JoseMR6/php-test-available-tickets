<?php require("header.php"); ?>

<main>
    <?php $eventData = $evento->getEventData(); ?>
    <a href="/"><button>Buscar otro Evento</button></a>
    <h1><?= $eventData["title"] ?></h1>
    <div class="eventData">
        <h6>Url: <?= $eventData["url"] ?></h6>
        <h6>Id: <?= $eventData["idEvento"] ?></h6>
        <h6>Tipo: <?= $eventData["type"] ?></h6>
    </div>

    <img src="<?= $eventData['firstPerformerImage']; ?>"
        alt="Imagen de <?= $eventData["title"]; ?>" />

    <h2>Check Tickets of Event</h2>
    <div class="filters">
        <a href="?sort=SectorRow&url=<?= $eventData["url"] ?>">
            <button>Sort by Sector and Row</button>
        </a>
        <a href="?sort=Price&url=<?= $eventData["url"] ?>">
            <button>Sort by Price</button>
        </a>
    </div>
    <?php if ($evento->lengthPositions() > 0) : ?>
        <ul>
            <?php for ($i = 0; $i < $evento->lengthPositions(); $i++) : ?>
                <?php $position = $evento->getPosition($i)->getData(); ?>
                <li>
                    <div>
                        <span>section: <?= $position["section"] ?></span>
                        <div>
                            <span>row: <?= $position["row"] ?></span>
                            <span>tickets: <?= $position["ticketCount"] ?></span>
                        </div>
                    </div>
                    <div>
                        <span>price</span>
                        <span><?= $position["cost"] ?></span>
                    </div>
                </li>
            <?php endfor; ?>
        </ul>
    <?php else : ?>
        <div>No hay tickets disponibles o no son accesibles</div>
    <?php endif; ?>
</main>

<?php require("footer.php"); ?>