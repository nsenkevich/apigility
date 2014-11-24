<?php

namespace SnippetDomain\Repository;

class SnippetWriteInterface
{

    public function create($node);

    public function edit($id, array $data);

    public function remove($id);

    public function incrementViews($node);
}
