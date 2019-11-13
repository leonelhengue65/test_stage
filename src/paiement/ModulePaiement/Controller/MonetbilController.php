<?php


namespace paiement\ModulePaiement\Controller;




class MonetbilController
{
 public static  $service_key;
 public static $amount;
public $return_url;
public $notify_url;

    /**
     * @return mixed
     */
    public static function getServiceKey()
    {
        return [
            "service_key"=>self::$service_key
        ];

    }
    /**
     * @param mixed $service_key
     */
    public static function setServiceKey($service_key)
    {
       global $a;
        $a=$service_key;
        self::$service_key=$service_key;
    }


    /**
     * @return mixed
     */
    public static function getAmount()
    {
        return [
            "amount"=>self::$amount
        ];
    }

    /**
     * @param mixed $amount
     */
    public static function setAmount($amount)
    {
        self::$amount=$amount;
    }

    /**
     * @return mixed
     */
    public function getReturnUrl()
    {
        return $this->return_url;
    }

    public static function key(){

        $key=self::getServiceKey();
        \Response::set("key",$key);
        return \Response::$data;
    }

    /**
     * @param mixed $return_url
     */
    public function setReturnUrl()
    {
        $this->return_url ='';
    }

    /**
     * @return mixed
     */
    public function getNotifyUrl()
    {
        return $this->notify_url;
    }

    /**
     * @param mixed $notify_url
     */
    public function setNotifyUrl()
    {
        $this->notify_url ='';
    }



    public static function mergeArguments($monetbil_args){
        return array_merge(array(
            'amount' =>self::$amount,
            'phone' =>'698083345',
            'country'=> 'cameroun',
            'user' => 'leonel65',
            'first_name' => 'leonel65',
            'last_name' => 'leonel65',
            'email' => 'leonel65kuaya@gmail.com',
            'return_url' => '',
            'notify_url' => '',
            'logo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/48/MasterCard-Logo.svg/1280px-MasterCard-Logo.svg.png',
        ), $monetbil_args);
    }

    public static function url($monetbil_args = array())
    {
        $querydata=self::mergeArguments($monetbil_args);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.monetbil.com/widget/v2.1/' . self::$service_key);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($querydata, '', '&'));
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response, true);
        $payment_url = '';
        if (is_array($result) and array_key_exists('payment_url', $result)) {
            $payment_url = $result['payment_url'];
        }
        else{
            return null;
        }
            return [
                "payment_url"=>$payment_url
            ];
    }

}