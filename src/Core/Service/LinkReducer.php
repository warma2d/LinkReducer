<?php

namespace LinkReducer\Core\Service;

use LinkReducer\Core\Database\Redis;
use LinkReducer\Core\Repository\LinkRepository;
use M1\Env\Parser;
use Predis\Client;

class LinkReducer {

    private const MAX_CODE_LENGTH = 6;

    private LinkRepository $linkRepo;
    private Client $redis;
    private array|null $env;

    public function __construct()
    {
        $this->linkRepo = new LinkRepository();
        $this->redis = Redis::getInstance();
        $this->env = EnvGetter::get();
    }

    public function getShortLink(array $data): string
    {
        $sourceLink = $data['sourceLink'];
        $shortCode = $this->getShortLinkFromRedis($sourceLink);
        if ($shortCode) {
            return $this->makeShortLink($shortCode);
        }

        $shortCode = $this->linkRepo->getShortCodeBySourceLink($sourceLink);
        if ($shortCode) {
            $this->saveShortLinkToRedis($sourceLink, $shortCode);
            return $this->makeShortLink($shortCode);
        }

        $shortCode = $this->createShortCode($sourceLink);

        $this->saveShortLinkToRedis($sourceLink, $shortCode);

        return $this->makeShortLink($shortCode);
    }

    private function getShortLinkFromRedis(string $sourceLink): string|null
    {
        return $this->redis->get($sourceLink);
    }

    private function saveShortLinkToRedis(string $sourceLink, string $shortCode): void
    {
        $this->redis->set($sourceLink, $shortCode, 'ex', $this->env['EXPIRED_SECONDS']);
        $this->redis->set($shortCode, $sourceLink, 'ex', $this->env['EXPIRED_SECONDS']);
    }

    private function createShortCode($sourceLink): string
    {
        do {
            $shortCode = CodeGenerator::generateCode(self::MAX_CODE_LENGTH);
        }while($this->linkRepo->existShortCode($shortCode));

        $this->linkRepo->saveShortCode($sourceLink, $shortCode);

        return $shortCode;
    }

    private function makeShortLink(string $shortCode): string
    {
        return $this->env['GATE_PROTOCOL'].'://'.$this->env['GATE_HOST'].'/'.$shortCode;
    }
}
