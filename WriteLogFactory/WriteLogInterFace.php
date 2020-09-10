<?php

namespace App\Com\Utils\Logger\WriteLogFactory;


interface WriteLogInterFace
{

    public function formatData(array $data);

    public function writeLog();
}
