<?php

namespace App\Com\Utils\Logger\WriteLogFactory;


class WriteLogFactory{

    private $type; // file  mysql  redis mongodb
    private $data;

    public function __construct(string $type, array $data)
    {
        $this->data = $data;
        $this->type = $type;
    }

    /**
     * Notes: 写日志
     * User: yuhy
     * DateTime: 2020/9/10 8:11
     * @return bool
     */
    public function writeLog(){

        switch ($this->type){
            case "file":
                $witeLogObj = new WriteLogFile();
                break;
            case "mysql":
                $witeLogObj = new WriteLogMysql();
                break;
            case "redis":
                $witeLogObj = new WriteLogRedis();
                break;
            case "mongodb":
                $witeLogObj = new WriteLogMongodb();
                break;
            default :
                return false;
                break;
        }

        $witeLogObj->formatData($this->data);
        $witeLogObj->writeLog();

    }
}
