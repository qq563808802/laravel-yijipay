<?php
/**
 * User: wangzd
 * Email: wangzhoudong@liwejia.com
 * Date: 2017/4/7
 * Time: 18:36
 */
namespace Yijipay\Payment;
use Yijipay\Yijipay\Http\YijipayClient;
use Yijipay\Yijipay\Exceptions\Exception;
use Yijipay\Yijipay\Util\SignHelper;


class Payment extends YijipayClient{

    public function add($params = null)
    {
        $apiReqeust = new CreateRequest();
        //请求公共部分
        $apiReqeust->setReturnUrl( $params['return_url']);
        $apiReqeust->setNotifyUrl($params['notify_url']);
        //partnerId默认yijipay\config.php中已经配置
        //$apiReqeust->setPartnerId($config['partnerId']); 
        $apiReqeust->setMerchOrderNo($params['order_id']);
        $apiReqeust->setOrderNo($params['order_id']);
        //signType默认MD5
        $apiReqeust->setSignType("MD5");
        //$apiReqeust->setContext("");

        //构建交易参数
        $item1 = $this->genTradeInfo($params);
        $apiReqeust->setBuyerOrgName($params['user_name']);

        $apiReqeust->setTradeInfo([$item1]);


        if(isset($params["payment_type"])) {
            $apiReqeust->setPaymentType($params["payment_type"]);
        }
        //收银台参数
        if(isset($params['terminal_type'])) {
              $apiReqeust->setUserTerminalType("PC");
         }
//        SignHelper::getPreSignStr($apiReqeust);
        //方式2: 获取重定向URL
        $response = $this->execute($apiReqeust);
        return $response;

    }


    /**
     * 查询支付状态
     *
     * @param $orderNo  string|array
     * @return mixed
     * @throws Exception
     * @throws \Exception
     */
    public function query($orderNo) {
        $apiReqeust = new QueryRequest();
        //请求公共部分
        $apiReqeust->setReturnUrl(url('/'));
        $apiReqeust->setNotifyUrl(url('/'));
        $apiReqeust->setMerchOrderNo("T" . $this->genOrderNo());
        $apiReqeust->setOrderNo("RID".  $this->genOrderNo());
        $apiReqeust->setSignType("MD5");
        if(is_array($orderNo)) {
            $orderNo = implode(',',$orderNo);
        }
        $apiReqeust->setMerchantOrderNos($orderNo);
        $response = $this->execute($apiReqeust);
        $resp = json_decode($response);
        if($this->verify($response) && $resp->success){
            return $resp;

        }else{

            throw new Exception($resp->resultMessage);
        }
    }

    /**
     * 回调
     */
    public function callback() {
        $request = request()->all();
        if($this->verify($request) && request('success')=== "true" && request('fastPayStatus')==='FINISHED') {
            return $request;
        }else{
            return false;
        }
    }


    private function genTradeInfo($params) {
        $item1 = new TradeInfo();

        $item1->setMerchOrderNo($params['order_id']);
        $item1->setTradeName($params['subject']);
        $item1->setSellerUserId($this->config['partnerId']);
        $item1->setSellerOrgName($this->config['seller_name']);

        $item1->setTradeAmount($params['amount']);
        $item1->setGoodsName($params['subject']);
        $item1->setCurrency("CNY");



        return $item1;
    }


    public function genOrderNo() {
        return date("YmdHis") . rand(0000,9999);
    }


}