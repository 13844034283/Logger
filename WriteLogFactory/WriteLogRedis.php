<?php

namespace App\Com\Utils\Logger\WriteLogFactory;

class WriteLogRedis implements WriteLogInterFace {

    private $data;

    const CLIENT_CONF=array(
        'host'=>'127.0.0.1',
        'port'=>6377,
        'password'=>'123456'
    );

    /**
     * Notes:
     * User: yuhy
     * DateTime: 2020/9/10 8:14
     * @param array $data
     */
    public function formatData(array $data)
    {
        $this->data = json_encode($data);
    }

    /**
     * Notes:
     * User: yuhy
     * DateTime: 2020/9/10 8:14
     */
    public function writeLog()
    {
        $redis = self::getClient();
        $redis ->lPush('admin_log',$this->data);
    }

    /**
     * Notes:
     * User: yuhy
     * DateTime: 2020/9/10 8:14
     * @return \Redis
     */
    public static function getClient(){
        $redis=new \Redis();
        $redis->connect(self::CLIENT_CONF['host'], self::CLIENT_CONF['port']);
        $redis->auth(self::CLIENT_CONF['password']);
        return $redis;
    }
}
