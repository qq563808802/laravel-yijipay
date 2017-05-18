<?php
/**
 * User: wangzd
 * Email: wangzhoudong@liwejia.com
 * Date: 2017/4/7
 * Time: 18:36
 */
namespace Yijipay\Transfer;
use Yijipay\Yijipay\Http\YijipayClient;
use Yijipay\Yijipay\Exceptions\Exception;


class Transfer extends YijipayClient{

    /**
     *
     *
     * @param null $params
     * [
        'return_url' =>  url('transfer/callback/yijipay/' . $orderId),
        'notify_url' =>  url('transfer/callback/yijipay/' . $orderId),
            'card' => [
            [
            'bankType'=>'person',//个人
            'itemMerchOrderNo'=> date("YmdHis") . rand(0000,9999),
            'money'=>'1',
            'bankCode'=>'ABC',
            'bankAccountNo'=>'622121345712663154',
            'bankAccount'=>'熊本熊',
            'memo'=>'个人银行卡',
            ],
            [
            'bankType'=>'business',//对公
            'itemMerchOrderNo'=> date("YmdHis") . rand(0000,9999),
            'money'=>'1',
            'bankCode'=>'ABC',
            'bankAccountNo'=>'622121345712663154',
            'bankAccount'=>'熊本熊',
            'memo'=>'个人银行卡',
            ]
            ],
         ];
     * @return bool|mixed
     * @throws \Exception
     */
    public function add($params = null)
    {
        $apiReqeust = new CreateRequest();
        //请求公共部分
        $apiReqeust->setReturnUrl( $params['return_url']);
        $apiReqeust->setNotifyUrl( $params['notify_url']);
        $apiReqeust->setMerchOrderNo($this->genOrderNo());
        $apiReqeust->setOrderNo($this->genOrderNo());
        //signType默认MD5
        $apiReqeust->setSignType("MD5");

        $apiReqeust->setBuyerUserId($this->config['partnerId']);
        $personCard = [];
        $businessCard = [];
        foreach($params['card'] as $val) {
                switch($val['bankType']) {
                    case "person": //对私
                    $personCard[] = $val;
                        break;
                    case "business"://到对公银行卡
                        $businessCard[] = $val;
                        break;
                }
        }
        if($personCard) {
            $apiReqeust->setToPersonCardList($personCard);
        }
        if($businessCard) {
            $apiReqeust->setToBusinessCardList($businessCard);
        }
        $response = $this->execute($apiReqeust);
        return $response;

    }

    public function genOrderNo() {
        return date("YmdHis") . rand(0000,9999);
    }

    /**
     * 获取银行
     * @param null $code
     * @return mixed
     */
    public function getBank($code=null) {
        if($code) {
            return Config::$bank[$code];
        }
        return Config::$bank;
    }

    /**
     * 回调
     */
    public function callback() {
        $request = request()->all();
        if($this->verify($request) && request('success')=== "true") {
            return $request;
        }else{
            return false;
        }
    }
}