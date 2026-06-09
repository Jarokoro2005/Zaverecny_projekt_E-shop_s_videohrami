<?php

class ShopController
{
    private GameRepository $games;
    private array $filters;
    private array $genres;
    private array $gameList;
    private int $totalGames;
    private float $highestPrice;

    public function __construct()
    {
        $this->games = new GameRepository();
        $this->highestPrice = max(1, ceil($this->games->getMaxPrice()));
        $this->filters = $this->readFilters();
        $this->genres = $this->games->getGenres();
        $this->gameList = $this->games->getGames($this->filters);
        $this->totalGames = $this->games->countGames($this->filters);
    }

    public function getFilters(): array
    {
        return $this->filters;
    }

    public function getGenres(): array
    {
        return $this->genres;
    }

    public function getGames(): array
    {
        return $this->gameList;
    }

    public function getTotalGames(): int
    {
        return $this->totalGames;
    }

    public function getHighestPrice(): float
    {
        return $this->highestPrice;
    }

    private function readFilters(): array
    {
        $genres = filter_input(INPUT_GET, 'genre', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY) ?? [];
        $genres = array_values(array_filter(array_map('trim', $genres)));
        $maxPrice = filter_input(INPUT_GET, 'max_price', FILTER_VALIDATE_FLOAT);

        return [
            'search' => trim((string) filter_input(INPUT_GET, 'search')),
            'genres' => $genres,
            'max_price' => $maxPrice !== false && $maxPrice !== null ? $maxPrice : $this->highestPrice,
            'only_sale' => filter_input(INPUT_GET, 'sale', FILTER_VALIDATE_INT) === 1,
            'only_new' => filter_input(INPUT_GET, 'new', FILTER_VALIDATE_INT) === 1,
        ];
    }
}
