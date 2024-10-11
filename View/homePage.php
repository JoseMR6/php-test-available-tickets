<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Tickets</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="View/homePage.css">
</head>

<body>
    <main>
        <h1>Check Tickets of Event</h1>
        <div class="filters">
            <a href="?sort=SectorRow"><button>Sort by Sector and Row</button></a>
            <a href="?sort=Price"><button>Sort by Price</button></a>
        </div>
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
    </main>
</body>

</html>