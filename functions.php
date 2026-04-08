<?php

function getMeta(): array
{
    // 1. načítame JSON
    $jsonStr = file_get_contents("data/datas.json");
    $data = json_decode($jsonStr, true);

    // 2. zistíme názov stránky
    $stranka = basename($_SERVER['REQUEST_URI']);
    $stranka = explode(".", $stranka)[0];

    // 3. ak meta existuje → vrátime ju
    if (isset($data["meta"][$stranka])) {
        return $data["meta"][$stranka];
    }

    // 4. fallback ak stránka nemá meta
    return [
        "title" => "GameVault",
        "description" => "THe best place to buy digital games. Thousands of titles, unbeatable prices, instant delivery."
    ];
}

function getCSS(): void
{
    $jsonStr = file_get_contents("data/datas.json");
    $data = json_decode($jsonStr, true);


    $stranka = basename($_SERVER['REQUEST_URI']);
    $stranka = explode(".", $stranka)[0];

    if (isset($data["sites"][$stranka])) {
        $suboryCSS = $data["sites"][$stranka];

        foreach ($suboryCSS as $subor) {
            echo "<link rel='stylesheet' href='$subor'>";
        }
    }
    echo "<!-- stranka: $stranka -->";
}
?>