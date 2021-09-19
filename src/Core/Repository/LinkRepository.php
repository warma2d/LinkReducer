<?php

namespace LinkReducer\Core\Repository;

use LinkReducer\Core\Model\Link;
use LinkReducer\Core\Model\Model;

class LinkRepository extends Repository {

    public function saveShortCode(string $sourceLink, string $shortCode): bool
    {
        $sql = 'INSERT INTO Link (sourceLink, shortCode) VALUES (:sourceLink, :shortCode)';
        $sth = $this->pdo->prepare($sql);
        $sth->bindValue(':sourceLink', $sourceLink);
        $sth->bindValue(':shortCode', $shortCode);

        return $sth->execute();
    }

    public function getShortCodeBySourceLink(string $sourceLink): string|bool
    {
        $sql = 'SELECT shortCode FROM Link WHERE sourceLink = :sourceLink';
        $sth = $this->pdo->prepare($sql);
        $sth->bindValue(':sourceLink', $sourceLink);
        $sth->execute();

        return $sth->fetchColumn();
    }

    public function existShortCode(string $shortCode): bool
    {
        $sql = 'SELECT 1 FROM Link WHERE shortCode = :shortCode';
        $sth = $this->pdo->prepare($sql);
        $sth->bindValue(':shortCode', $shortCode);
        $sth->execute();

        return (bool)$sth->fetchColumn();
    }

    public function getSourceLinkFromDB($shortCode): string|bool
    {
        $sql = 'SELECT sourceLink FROM Link WHERE shortCode = :shortCode';
        $sth = $this->pdo->prepare($sql);
        $sth->bindValue(':shortCode', $shortCode);
        $sth->execute();

        return $sth->fetchColumn();
    }
}
