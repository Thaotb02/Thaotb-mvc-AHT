<?php

namespace MyApp\Core;

interface ResourceInterface
{
    public function call_init($table, $id, $model);
    public function save($model);
    public function delete($model);
}
