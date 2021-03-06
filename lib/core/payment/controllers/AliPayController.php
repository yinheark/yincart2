<?php
/**
 * Created by changhai.lin.
 * Date: 11/27/2014 10:12 AM
 */

namespace core\payment\controllers;

use core\payment\models\alipay\AlipayNotify;
use core\payment\models\alipay\AlipaySubmit;
use kiwi\Kiwi;
use kiwi\web\Controller;
use yii\helpers\Url;

class AlipayController extends Controller
{
    public $config = [];

    public function init(){
        parent::init();

        $setting = Kiwi::getSettingKVModel();
        $this->config = [
            'partner' => $setting->payment_alipay_pid,
            'key' => $setting->payment_alipay_key,
            'sign_type' => strtoupper('MD5'),
            'input_charset' => strtolower('utf-8'),
            'cacert' => \Yii::getAlias('@core/payment/lib/cacert.pem'),
            'transport' => 'http',
        ];
    }

    public function actionIndex($id)
    {
//        return $this->render('index', ['model' => Kiwi::getAlipayForm()]);
        $order = Kiwi::getOrder()->findOne($id);

        $addressArray = explode(' ', $order->address);
        //构造要请求的参数数组，无需改动
        $setting = Kiwi::getSettingKVModel();
        $parameter = array(
            "service" => "create_partner_trade_by_buyer",
            "partner" => $setting->payment_alipay_pid,
            "payment_type" => "1",
            "notify_url" => Url::to(['alipay/notify'], true),
            "return_url" => Url::to(['alipay/return'], true),
            "seller_email" => $setting->payment_alipay_sellerEmail,
            "out_trade_no" => $order->order_id,
            "subject" => $order->getOrderName(),
            "price" => $order->total_price,
            "quantity" => 1,
            "logistics_fee" => $order->shipping_fee,
            "logistics_type" => 'EXPRESS',
            "logistics_payment" => 'SELLER_PAY',
            "body" => $order->getOrderName(),
            "show_url" => Url::to(['order/detail'], true),
            "receive_address" => $addressArray[0],
            "receive_zip" => $addressArray[1],
            "receive_name" => $addressArray[2],
            "receive_phone" => $addressArray[3],
            "receive_mobile" => $addressArray[3],
            "_input_charset" => strtolower('utf-8'),
        );

        $alipaySubmit = new AlipaySubmit($this->config);
        $html_text = $alipaySubmit->buildRequestForm($parameter, "get", "确认");
        echo $html_text;
    }

    public function actionNotify()
    {
        //计算得出通知验证结果
        $alipayNotify = new AlipayNotify($this->config);
        $verify_result = $alipayNotify->verifyNotify();
        if($verify_result) {//验证成功
            $order_id = \Yii::$app->request->post('out_trade_no');
            $order = Kiwi::getOrder()->findOne($order_id);

            if($_POST['trade_status'] == 'WAIT_BUYER_PAY') {
                //该判断表示买家已在支付宝交易管理中产生了交易记录，但没有付款

                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //如果有做过处理，不执行商户的业务程序

                $payment = Kiwi::getPayment();
                $payment->transcation_no = \Yii::$app->request->post('trade_no');
                $payment->status = 0;
                $order->payment = $payment;
                $order->save();

                echo "success";		//请不要修改或删除

                //调试用，写文本函数记录程序运行情况是否正常
                //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
            }
            else if($_POST['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {
                //该判断表示买家已在支付宝交易管理中产生了交易记录且付款成功，但卖家没有发货

                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //如果有做过处理，不执行商户的业务程序

                $payment = $order->payment;
                $payment->status = 1;
                $order->payment = $payment;
                $order->status = 2;
                $order->save();

                echo "success";		//请不要修改或删除

                //调试用，写文本函数记录程序运行情况是否正常
                //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
            }
            else if($_POST['trade_status'] == 'WAIT_BUYER_CONFIRM_GOODS') {
                //该判断表示卖家已经发了货，但买家还没有做确认收货的操作

                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //如果有做过处理，不执行商户的业务程序

                echo "success";		//请不要修改或删除

                //调试用，写文本函数记录程序运行情况是否正常
                //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
            }
            else if($_POST['trade_status'] == 'TRADE_FINISHED') {
                //该判断表示买家已经确认收货，这笔交易完成

                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //如果有做过处理，不执行商户的业务程序

                echo "success";		//请不要修改或删除

                //调试用，写文本函数记录程序运行情况是否正常
                //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
            }
            else {
                //其他状态判断
                echo "success";

                //调试用，写文本函数记录程序运行情况是否正常
                //logResult ("这里写入想要调试的代码变量值，或其他运行的结果记录");
            }

            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }
        else {
            //验证失败
            echo "fail";

            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        }
    }

    public function actionReturn()
    {
        echo 'paid success';
    }
} 