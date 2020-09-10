<?php

namespace App\Com\Utils\Logger\WriteLogFactory;


class WriteLogFile implements WriteLogInterFace
{

    // 存储目录
    const PATH = 'storage/logs/admin-operate/';

    private $data;

    public function formatData(array $data)
    {

        $txt = "-----------------------------------------------------------------------------\n";
        $txt .= "| 操作时间 : ".date('Y-m-d H:i:s'). "|\n";
        $txt .= "| 操作人标识 : ".$data['uuid']." | 操作人 : ".$data['user_name']." | 操作人IP : ".$data['ip']."  |\n";
        $txt .= "| 传送方式 : ".$data['method']."  | 操作接口 : ".$data['path']." |\n";
        $txt .= "| 请求参数 :  ".$data['param']."  |\n";
        $txt .= "| 请求头 :  ".$data['header']."  |\n";
        $txt .= "| 备注 :  ".$data['remark']."  |\n";
        $txt .= "-----------------------------------------------------------------------------\n";

        $this->data = $txt;
    }

    public function writeLog()
    {
        // 存储目录 不同框架需要修改
        $dirName = base_path(self::PATH);
        // 日志名称
        $logName = date('Y-m-d').".log";

        if ( !is_dir($dirName) ) {
            mkdir($dirName, 0777);
        }

        // 全路径
        $path = $dirName . $logName;
        $file = fopen($path, "a+") or die("Unable to open file!");
        fwrite($file, $this->data);
        fclose($file);
    }
}
