<?php
/**
 * Notes: 日志记录
 * User: yuhy
 * DateTime: 2020/9/10 6:52
 */
namespace Logger;

use Logger\WriteLogFactory\WriteLogFactory;

class Logger
{


    private $ip;
    private $method;
    private $path;
    private $uuid;
    private $user_name;
    private $param;
    private $header;
    private $remark;

    const TYPE_NUM = 0;  // 0 :文件  1: mysql  2:redis; 3:mongodb
    const TYPE = ['file', 'mysql', 'redis', 'mongodb'];

    public function __construct()
    {
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->path = $_SERVER['REQUEST_URI'];
    }

    /**
     * Notes: 记录用户唯一标识
     * DateTime: 2020/9/10 6:52
     * @param $uuid
     */
    public function setUuid($uuid = 1){
        $this->uuid = $uuid;
    }

    /**
     * Notes: 记录用户姓名
     * DateTime: 2020/9/10 6:52
     * @param $uuid
     */
    public function setUserName($user_name = '超级管理员'){
        $this->user_name = $user_name;
    }

    /**
     * Notes: 记录用户请求参数
     * DateTime: 2020/9/10 6:52
     * @param $uuid
     */
    public function setParam($param){
        $this->param = $param;
    }

    /**
     * Notes: 记录用户请求头
     * DateTime: 2020/9/10 6:52
     * @param $uuid
     */
    public function setHeader($header){
        $this->header = $header;
    }

    /**
     * Notes: 记录备注
     * DateTime: 2020/9/10 6:52
     * @param $uuid
     */
    public function setRemark($remark){
        $this->remark = $remark;
    }


    /**
     * Notes: 写日志 (工厂)
     * User: yuhy
     * DateTime: 2020/9/10 8:10
     */
    public function writeLog(){

        $data['ip'] = $this->ip;
        $data['method'] = $this->method;
        $data['path'] = $this->path;
        $data['uuid'] = $this->uuid;
        $data['user_name'] = $this->user_name;
        $data['param'] = $this->param;
        $data['header'] = $this->header;
        $data['remark'] = $this->remark;

        $writeLogObj = new WriteLogFactory(self::TYPE[self::TYPE_NUM], $data);
        $writeLogObj->writeLog();
    }





}
