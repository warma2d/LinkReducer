<?php

namespace LinkReducer\Secondary\Controllers;

use LinkReducer\Core\Database\Redis;
use LinkReducer\Core\Repository\LinkRepository;
use LinkReducer\Core\Service\EnvGetter;
use Predis\Client;

class GateController {

    private LinkRepository $linkRepo;
    private Client $redis;
    private array $env;

    public function __construct()
    {
        $this->linkRepo = new LinkRepository();
        $this->redis = Redis::getInstance();
        $this->env = EnvGetter::get();
    }

    public function handleShortLink()
    {
        $shortCode = trim($_SERVER['REQUEST_URI'], '/');

        $sourceLink = $this->getSourceLinkFromRedis($shortCode);
        if ($sourceLink) {
            $this->redirectTo($sourceLink);
        }

        $sourceLink = $this->linkRepo->getSourceLinkFromDB($shortCode);
        if ($sourceLink) {
            $this->saveSourceLinkToRedis($sourceLink, $shortCode);
            $this->redirectTo($sourceLink);
        }

        echo 'Эта короткая ссылка не найдена.';
    }

    private function getSourceLinkFromRedis(string $shortCode): string|null
    {
        return $this->redis->get($shortCode);
    }

    private function redirectTo(string $sourceLink): void
    {
        header('Location: '.$sourceLink);
    }

    private function saveSourceLinkToRedis(string $sourceLink, string $shortCode): void
    {
        $this->redis->set($sourceLink, $shortCode, 'ex', $this->env['EXPIRED_SECONDS']);
        $this->redis->set($shortCode, $sourceLink, 'ex', $this->env['EXPIRED_SECONDS']);
    }
}
