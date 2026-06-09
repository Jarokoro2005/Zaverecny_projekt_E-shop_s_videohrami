<?php

class GameDetailController
{
    private GameRepository $games;
    private ?array $game;

    public function __construct()
    {
        $this->games = new GameRepository();
        $this->game = $this->loadGame();
    }

    public function getGame(): ?array
    {
        return $this->game;
    }

    public function getStars(float $rating): string
    {
        $fullStars = (int) round($rating);
        $fullStars = max(0, min(5, $fullStars));

        return str_repeat('*', $fullStars) . str_repeat('-', 5 - $fullStars);
    }

    private function loadGame(): ?array
    {
        $slug = trim((string) filter_input(INPUT_GET, 'slug'));

        if ($slug === '') {
            return null;
        }

        return $this->games->getBySlug($slug);
    }
}
