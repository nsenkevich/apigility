<?php

namespace SnippetDomain\Repository;

class SnippetReadInterface
{

    const PAGE_ITEMS = 9;

    public function findAllForUser($user, $perPage = self::PAGE_ITEMS);

    public function findAllFavorites($user, $perPage = self::PAGE_ITEMS);

    public function findBySlug($slug);

    public function findMostRecent($perPage = self::PAGE_ITEMS);

    public function findMostCommented($perPage = self::PAGE_ITEMS);

    public function findMostPopular($perPage = self::PAGE_ITEMS);

    public function findByCategory($slug, $perPage = self::PAGE_ITEMS);

    public function findByTag($slug, $perPage = self::PAGE_ITEMS);
}
