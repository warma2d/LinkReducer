<?php

namespace LinkReducer\Core\Model;

class Link extends Model {

    public const TABLE_NAME = 'Link';

    public const SOURCE_LINK = 'sourceLink';
    public const SHORT_CODE = 'shortCode';

    private string $sourceLink;
    private string $shortCode;

    public function getSourceLink(): string
    {
        return $this->sourceLink;
    }

    public function setSourceLink(string $sourceLink): void
    {
        $this->sourceLink = $sourceLink;
    }

    public function getShortCode(): string
    {
        return $this->shortCode;
    }

    public function setShortCode(string $shortCode): void
    {
        $this->shortCode = $shortCode;
    }
}
