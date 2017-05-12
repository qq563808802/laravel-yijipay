<?php
/**
 * User: azhi
 * Date: 2016/10/02 10:20:15
 */
namespace Yijipay\Transfer;


use Yijipay\Yijipay\Http\IRequest;

class CreateRequest extends IRequest{

    /**
     * 付款人易极付会员ID
     * 示例： "201501320000315151"
     */
    protected $payerUserId;

    /**
     * 付款人外部会员ID
     * 示例： "201501320000315151
     */
    protected $outPayerShopId;
    /**
     * 付款人外部会员名
     * 示例： "201501320000315151
     */
    protected $outPayerShopName;
    /**
     * 到余额列表
     * 示例： "[{"itemMerchOrderNo":"2015210003645008","payeeUserId":"201521000364500825","outPayeeShopId":"201521000364500825","outPayeeShopName":"熊本熊","money":"25888","memo":"辣条食品","goodsList":[{"title":"食品","code":"1415612asda1d5a","description":"全麦食品","price":"258","quantity":"3200","unit":"熊本熊企业","chargeExtra":"2588"}]}]
     */
    protected $toBalanceList;
    /**
     * 到个人银行卡列表
     * 示例： "[{"itemMerchOrderNo":"201500013510025312","money":"25888","bankCode":"ABC","bankAccountNo":"622121345712663154","bankAccount":"熊本熊","memo":"个人银行卡","goodsList":[{"title":"食品","code":"1415612asda1d5a","description":"全麦食品","price":"258","quantity":"3200","unit":"熊本熊企业","chargeExtra":"2588"}]}]
     */
    protected $toPersonCardList;
    /**
     * 到对公银行卡列表
     * 示例： "[{"itemMerchOrderNo":"251580251aa12129aafg","money":"25888","bankCode":"ABC","bankAccountNo":"6221211992351250212","bankAccount":"熊本熊","memo":"该卡正在使用中 ","goodsList":[{"title":"食品","code":"1415612asda1d5a","description":"全麦食品","price":"258","quantity":"3200","unit":"熊本熊企业","chargeExtra":"2588"}]}]
     */
    protected $toBusinessCardList;
    /**
     * 付款人外部会员ID
     * 示例： "201501320000315151
     */
    protected $toPactNoOrderInfoList;




    function __construct(){
        //服务名
        $this->setService("qftBatchTransfer");
        $this->setVersion("1.0");
    }

    /**
     * @param string $payerUserId
     */
    public function setBuyerUserId($payerUserId)
    {
        $this->payerUserId = $payerUserId;
    }


    /**
     * @return string
     */
    public function getBuyerUserId()
    {
        return $this->payerUserId;
    }

    /**
     * @param string $outPayerShopId
     */
    public function setOutPayerShopId($outPayerShopId)
    {
        $this->outPayerShopId = $outPayerShopId;
    }

    /**
     * @return string
     */
    public function getOutPayerShopId()
    {
        return $this->outPayerShopId;
    }

    /**
     * @param string $outPayerShopName
     */
    public function setOutPayerShopName($outPayerShopName)
    {
        $this->outPayerShopName = $outPayerShopName;
    }

    /**
     * @return string
     */
    public function getOutPayerShopName()
    {
        return $this->outPayerShopName;
    }

    /**
     * @param string $toBalanceList
     */
    public function setToBalanceList($toBalanceList)
    {
        $this->toBalanceList = $toBalanceList;
    }


    /**
     * @return list
     */
    public function getToBalanceList()
    {
        return $this->toBalanceList;
    }

    /**
     * @param array $toPersonCardList
     */
    public function setToPersonCardList($toPersonCardList)
    {
        $this->toPersonCardList = $toPersonCardList;
    }

    /**
     * @return mixed
     */
    public function getToPersonCardList()
    {
        return $this->toPersonCardList;
    }

    /**
     * @param mixed $toBusinessCardList
     */
    public function setToBusinessCardList($toBusinessCardList)
    {
        $this->toBusinessCardList = $toBusinessCardList;
    }

    /**
     * @return mixed
     */
    public function getToBusinessCardList()
    {
        return $this->toBusinessCardList;
    }

    /**
     * @param mixed $toPactNoOrderInfoList
     */
    public function setToPactNoOrderInfoList	($toPactNoOrderInfoList	)
    {
        $this->toPactNoOrderInfoList = $toPactNoOrderInfoList;
    }

    /**
     * @return string
     */
    public function getToPactNoOrderInfoList()
    {
        return $this->toPactNoOrderInfoList;
    }

}
