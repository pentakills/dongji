<?php
/**
 * 易优CMS
 * ============================================================================
 * 版权所有 2016-2028 海南赞赞网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.eyoucms.com
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ============================================================================
 * Author: 陈风任 <491085389@qq.com>
 * Date: 2019-2-25
 */

namespace app\user\controller;

use think\Db;
// use think\Session;
use think\Config;
use think\Page;
use app\user\logic\PayLogic;

class Pay extends Base
{
    public $php_version = '';

    public function _initialize() {
        parent::_initialize();
        $this->users_db       = Db::name('users');      // 会员数据表
        $this->users_money_db = Db::name('users_money');// 会员金额明细表
        $this->shop_order_db = Db::name('shop_order'); // 订单主表
        $this->shop_order_details_db = Db::name('shop_order_details'); // 订单明细表

        // 判断PHP版本信息
        if (version_compare(PHP_VERSION,'5.5.0','<')) {
            $this->php_version = 1; // PHP5.5.0以下版本，可使用旧版支付方式
        }else{
            $this->php_version = 0;// PHP5.5.0以上版本，可使用新版支付方式，兼容旧版支付方式
        }

        // 支付功能是否开启
        $redirect_url = '';
        $pay_open = getUsersConfigData('pay.pay_open');
        $web_users_switch = tpCache('web.web_users_switch');
        if (empty($pay_open)) { 
            // 支付功能关闭，立马跳到会员中心
            $redirect_url = url('user/Users/index');
            $msg = '支付功能尚未开启！';
        } else if (empty($web_users_switch)) { 
            // 前台会员中心已关闭，跳到首页
            $redirect_url = ROOT_DIR.'/';
            $msg = '会员中心尚未开启！';
        }
        if (!empty($redirect_url)) {
            Db::name('users_menu')->where([
                    'mca'   => 'user/Pay/pay_consumer_details',
                    'lang'  => $this->home_lang,
                ])->update([
                    'status'    => 0,
                    'update_time' => getTime(),
                ]);
            $this->error($msg, $redirect_url);
            exit;
        }
        // --end
    }

    // 消费明细
    public function pay_consumer_details()
    {
        // 订单超过 get_order_validity 设定的时间，则修改订单为已取消状态，无需返回数据
        model('Pay')->UpdateOrderData($this->users_id);

        // 数据查询
        $condition['a.users_id'] = $this->users_id;
        $condition['a.lang']     = $this->home_lang;
        // 只读取已付款或已完成订单信息
        $condition['a.status']   = array('IN',[2,3]);
        $count = $this->users_money_db->alias('a')->where($condition)->count();// 查询满足要求的总记录数
        $Page = new Page($count, config('paginate.list_rows'));// 实例化分页类 传入总记录数和每页显示的记录数
        $list = $this->users_money_db->field('a.*')
            ->alias('a')
            ->where($condition)
            ->order('a.moneyid desc')
            ->limit($Page->firstRow.','.$Page->listRows)
            ->select();
        $show = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('list',$list);// 赋值数据集
        $this->assign('pager',$Page);// 赋值分页集

        // 获取金额明细类型
        $pay_cause_type_arr = Config::get('global.pay_cause_type_arr');
        $this->assign('pay_cause_type_arr',$pay_cause_type_arr);

        // 获取金额明细状态
        $pay_status_arr     = Config::get('global.pay_status_arr');
        $this->assign('pay_status_arr',$pay_status_arr);

        $result = [];

        // 菜单名称
        $result['title'] = Db::name('users_menu')->where([
                'mca'   => 'user/Pay/pay_consumer_details',
                'lang'  => $this->home_lang,
            ])->getField('title');

        $eyou = array(
            'field' => $result,
        );
        $this->assign('eyou', $eyou);

        return $this->fetch('users/pay_consumer_details');
    }

    // 账户充值
    public function pay_account_recharge()
    {
        if (IS_AJAX_POST) {
            // 获取微信配置信息
            $pay_wechat_config = !empty($this->usersConfig['pay_wechat_config']) ? unserialize($this->usersConfig['pay_wechat_config']) : [];
            
            // 获取支付宝配置信息
            $pay_alipay_config = !empty($this->usersConfig['pay_alipay_config']) ? unserialize($this->usersConfig['pay_alipay_config']) : [];

            // 都为空则返回
            if (empty($pay_wechat_config) && empty($pay_alipay_config)) $this->error('网站支付配置未完善，请联系管理员！');
            
            // 判断传入的数据
            $money = input('post.money/f');
            $unified_number = input('post.unified_number/s');
            if (!empty($unified_number) && !preg_match('/^\d+$/',$unified_number)) $this->error('订单号不存在！');

            // 判断不为空和数字字符串
            if (!empty($money) && is_numeric($money)) {
                $moneyRow = [];
                if (!empty($unified_number)) {
                    $where = [
                        'lang' => $this->home_lang,
                        'status' => 1,
                        'order_number' => $unified_number
                    ];
                    $moneyRow = $this->users_money_db->where($where)->find();
                }
                if (!empty($moneyRow)) { // 更改充值金额
                    $moneyid = $moneyRow['moneyid'];
                    $order_number = $moneyRow['order_number'];
                    $old_money = $moneyRow['money'];
                    $data = [
                        'money'         => $money,
                        'users_money'   => Db::raw('users_money-'.$old_money),
                        'status'        => 1,
                        'update_time'   => getTime()
                    ];
                    $where = [
                        'moneyid'  => $moneyid,
                        'users_id' => $this->users_id
                    ];
                    $this->users_money_db->where($where)->update($data);
                } else {
                    // 数据添加到订单表
                    $where = [
                        'lang' => $this->home_lang,
                        'users_id' => $this->users_id
                    ];
                    $users = M('users')->field('users_money')->where($where)->find();
                    $pay_cause_type_arr = Config::get('global.pay_cause_type_arr');
                    $time = getTime();
                    $cause_type = 1;
                    $order_number = date('Ymd') . $time . rand(10,100); //订单生成规则
                    $data = [
                        'users_id'      => $this->users_id,
                        'cause_type'    => $cause_type,
                        'cause'         => $pay_cause_type_arr[$cause_type],
                        'money'         => $money,
                        'users_money'   => $users['users_money'] + $money,
                        'pay_details'   => '',
                        'order_number'  => $order_number,
                        'status'        => 1,
                        'lang'          => $this->home_lang,
                        'add_time'      => $time
                    ];
                    if (isMobile() && isWeixin()) {
                        $data['pay_method'] = 'wechat';// 如果在微信端中则默认为微信支付
                        $data['wechat_pay_type'] = 'WeChatInternal';// 如果在微信端中则默认为微信端调起支付
                    }
                    $moneyid = $this->users_money_db->add($data);
                }

                // 添加状态
                if (!empty($moneyid)) {
                    if (isMobile() && isWeixin()) {
                        $ReturnOrderData = [
                            'unified_id'       => $moneyid,
                            'unified_number'   => $order_number,
                            'transaction_type' => 1, // 订单支付金额充值
                            'is_gourl'         => 0
                        ];
                        $this->success('等待支付', null, $ReturnOrderData);
                    } else {
                        // 对ID和订单号加密，拼装url路径
                        $querydata = [
                            'moneyid'      => $moneyid,
                            'order_number' => $order_number,
                        ];

                        /*修复1.4.2漏洞 -- 加密防止利用序列化注入SQL*/
                        $querystr = '';
                        foreach($querydata as $_qk => $_qv)
                        {
                            $querystr .= $querystr ? "&$_qk=$_qv" : "$_qk=$_qv";
                        }
                        $querystr = str_replace('=', '', mchStrCode($querystr));
                        $auth_code = tpCache('system.system_auth_code');
                        $hash = md5("payment".$querystr.$auth_code);
                        /*end*/
                        
                        $url = urldecode(url('user/Pay/pay_recharge_detail', ['querystr'=>$querystr,'hash'=>$hash]));
                        $ReturnOrderData['is_gourl'] = 1;
                        $this->success('等待支付', $url, $ReturnOrderData);
                    }
                }
                $this->error('充值表单提交失败');
            }
            $this->error('请输入正确的充值金额！');
        }

        $money = input('param.money/f');
        $this->assign('money', $money);

        $unified_number = input('param.unified_number/s');
        $this->assign('unified_number', $unified_number);

        return $this->fetch('users/pay_account_recharge');
    }

    // 充值详情
    public function pay_recharge_detail()
    {
        // 解析数据
        $querystr   = input('param.querystr/s');
        $hash   = input('param.hash/s');
        $auth_code = tpCache('system.system_auth_code');
        if(empty($querystr) || empty($hash) || md5("payment".$querystr.$auth_code) != $hash) $this->error('无效订单！');
        parse_str(mchStrCode($querystr,'DECODE'),$querydata);

        // 获取微信配置信息
        $pay_wechat_config = !empty($this->usersConfig['pay_wechat_config']) ? unserialize($this->usersConfig['pay_wechat_config']) : [];
        // 获取支付宝配置信息
        $pay_alipay_config = !empty($this->usersConfig['pay_alipay_config']) ? unserialize($this->usersConfig['pay_alipay_config']) : [];

        // 判断数据
        if (!empty($querydata['moneyid']) && !empty($querydata['order_number'])) {
            // 充值信息
            $moneyid = !empty($querydata['moneyid']) ? intval($querydata['moneyid']) : 0;
            $order_number = !empty($querydata['order_number']) ? $querydata['order_number'] : '';
            // 都为空则返回
            if (empty($pay_wechat_config) && empty($pay_alipay_config)) $this->error('网站支付配置未完善，请联系管理员！');
        } else if (!empty($querydata['order_id']) && !empty($querydata['order_code'])) {
            // 订单信息
            $order_id   = !empty($querydata['order_id']) ? intval($querydata['order_id']) : 0;
            $order_code = !empty($querydata['order_code']) ? $querydata['order_code'] : '';
        } else {
            $this->error('订单不存在！');
        }

        // 处理数据
        if (is_array($querydata) && (!empty($order_id) || !empty($moneyid)) && (!empty($order_number) || !empty($order_code))) {

            $data = [];
            if (!empty($moneyid)) {
                // 获取会员充值信息
                $where = [
                    'moneyid'      => $moneyid,
                    'order_number' => $order_number,
                    'users_id'     => $this->users_id,
                    'lang'         => $this->home_lang
                ];
                $data = $this->users_money_db->where($where)->find();
                if (empty($data)) $this->error('订单不存在！');

                // 组装数据返回
                $data['transaction_type'] = 1; // 交易类型，1为充值
                $data['unified_id']       = $data['moneyid'];
                $data['unified_amount']   = $data['money'];
                $data['unified_number']   = $data['order_number'];
                $data['cause']            = '余额充值';
                $this->assign('data', $data);
            } else if (!empty($order_id)) {
                // 获取支付订单
                $where = [
                    'order_id'   => $order_id,
                    'order_code' => $order_code,
                    'users_id'   => $this->users_id,
                    'lang'       => $this->home_lang
                ];
                $data = $this->shop_order_db->where($where)->find();
                if (empty($data)) $this->error('订单不存在！');
                
                // 判断订单状态，1已付款(待发货)，2已发货(待收货)，3已完成(确认收货)，-1订单取消(已关闭)，4订单过期
                $url = urldecode(url('user/Shop/shop_order_details', ['order_id' => $data['order_id']]));
                if (in_array($data['order_status'], [1,2,3])) {
                    $this->error('订单已支付，即将跳转！', $url);
                } elseif ($data['order_status'] == 4) {
                    $this->error('订单已过期，即将跳转！', $url);
                } elseif ($data['order_status'] == -1) {
                    $this->error('订单已关闭，即将跳转！', $url);
                }

                // 组装数据返回
                $data['transaction_type'] = 2; // 交易类型，2为购买
                $data['unified_id']       = $data['order_id'];
                $data['unified_amount']   = $data['order_amount'];
                $data['unified_number']   = $data['order_code'];
                $data['cause']            = '购买商品';
                $this->assign('data', $data);
            }

            // 充值信息存在时，传入订单号等信息获取支付宝支付链接
            $alipay_url = '';
            if (!empty($data)) {
                if (!empty($pay_alipay_config)) {
                    if ($this->php_version == 1) {
                        // 低于5.5版本，仅可使用旧版支付宝支付
                        $alipay_url = model('Pay')->getOldAliPayPayUrl($data, $pay_alipay_config);
                    } else if ($this->php_version == 0){
                        // 高于或等于5.5版本，可使用新版支付宝支付
                        if (empty($pay_alipay_config['version'])) {
                            // 新版
                            $AliPayResult = [
                                'unified_number'   => $data['unified_number'],
                                'unified_amount'   => $data['unified_amount'],
                                'transaction_type' => $data['transaction_type']
                            ];
                            $alipay_url = url('user/Pay/newAlipayPayUrl', $AliPayResult);
                        } else if ($pay_alipay_config['version'] == 1){
                            // 旧版
                            $alipay_url = model('Pay')->getOldAliPayPayUrl($data, $pay_alipay_config);
                        }
                    }
                }
            }
            $this->assign('alipay_url', $alipay_url);

            // 终端判断
            $isbrowser = $isweixin = 0;
            if (isMobile() && isWeixin()) $isbrowser = 1;
            $this->assign('isbrowser', $isbrowser);

            // 手机端浏览器支付
            if (isMobile() && !isWeixin()) {
                if (empty($pay_wechat_config['is_open_wechat'])) {
                    $isweixin = 1;
                    // 移动端非微信H5页面支付
                    $out_trade_no = $data['unified_number'];
                    $total_fee    = $data['unified_amount'];
                    $weixin_url   = model('Pay')->getMobilePay($out_trade_no,$total_fee);
                    $this->assign('weixin_url', $weixin_url);
                    if ('FAIL' == $weixin_url['return_code']) $this->error('商户公众号尚未成功开通H5支付，请开通成功后重试');
                }
            }

            $this->assign('isweixin',  $isweixin);

            // 是否开启微信支付方式
            $is_open_wechat = 1;
            if (!empty($pay_wechat_config)) {
                $is_open_wechat = !empty($pay_wechat_config['is_open_wechat']) ? $pay_wechat_config['is_open_wechat'] : 0;
            }
            $this->assign('is_open_wechat', $is_open_wechat);
            if (1 == $is_open_wechat) {
                // 若没有配置支付信息，则提示
                $WechatMsg = '微信支付配置尚未配置完成。<br/>请前往会员中心-支付功能-微信支付配置<br/>填入收款的微信支付配置信息！';
                $this->assign('WechatMsg', $WechatMsg);
            }

            // 是否开启支付宝支付方式
            $is_open_alipay = 1;
            if (!empty($pay_alipay_config)) {
                $is_open_alipay = !empty($pay_alipay_config['is_open_alipay']) ? $pay_alipay_config['is_open_alipay'] : 0;
            }
            $this->assign('is_open_alipay', $is_open_alipay);
            if (1 == $is_open_alipay) {
                // 若没有配置支付信息，则提示
                $AlipayMsg = '支付宝支付配置尚未配置完成。<br/>请前往会员中心-支付功能-支付宝支付配置<br/>填入收款的支付宝支付配置信息！';
                $this->assign('AlipayMsg', $AlipayMsg);
            }

            return $this->fetch('users/pay_recharge_detail');
        }
        $this->error('参数错误！');
    }

    // 支付宝订单查询
    public function get_alipay_order()
    {
        if (IS_AJAX_POST) {
            $unified_id = input('post.unified_id/d');
            $unified_number = input('post.unified_number/s');
            $transaction_type = input('post.transaction_type/d');

            //判断openssl是否开启
            $openssl_funcs = get_extension_funcs('openssl');
            if(empty($openssl_funcs)) $this->error('尚未开启php的openssl扩展');

            // 获取支付宝配置信息
            $pay_alipay_config = !empty($this->usersConfig['pay_alipay_config']) ? unserialize($this->usersConfig['pay_alipay_config']) : [];
            if (empty($pay_alipay_config)) $this->error('尚未配置支付宝支付配置');
            
            // 订单号是否存在
            $where = [
                'order_id'   => $unified_id,
                'order_code' => $unified_number
            ];
            $Result = $this->shop_order_db->where($where)->field('order_id, pay_name, order_status')->find();
            if (empty($Result)) $this->error('订单信息错误，请尝试刷新');
            // 获取支付宝配置信息
            $pay_alipay_config = !empty($this->usersConfig['pay_alipay_config']) ? unserialize($this->usersConfig['pay_alipay_config']) : [];
            if (1 == $pay_alipay_config['version']) {
                if (0 == $Result['order_status']) {
                    $this->error('订单正在支付');
                } else {
                    // 使用旧版支付宝则执行
                    $ResultUrl = urldecode(url('user/Pay/pay_success', ['transaction_type'=>$transaction_type, 'order_code'=>$unified_number]));
                    $ResultData = [
                        'email' => false,
                        'mobile' => false
                    ];
                    if (2 == $transaction_type) {
                        /*订单提醒*/
                        // 邮箱发送
                        $SmtpConfig = tpCache('smtp');
                        $ResultData['email'] = GetEamilSendData($SmtpConfig, $this->users, $where, 1, 'alipay');
                        /* END */

                        /*手机发送*/
                        $SmsConfig = tpCache('sms');
                        $ResultData['mobile'] = GetMobileSendData($SmsConfig, $this->users, $where, 1, 'alipay');
                        /* END */
                    }
                    $this->success('支付完成', $ResultUrl, $ResultData);
                }
            }

            // 引入文件
            vendor('alipay.pagepay.service.AlipayTradeService');
            vendor('alipay.pagepay.buildermodel.AlipayTradeQueryContentBuilder');

            // 实例化加载订单号
            $RequestBuilder = new \AlipayTradeQueryContentBuilder;
            $out_trade_no   = trim($unified_number);
            $RequestBuilder->setOutTradeNo($out_trade_no);

            // 拼装配置
            $config['app_id']     = $pay_alipay_config['app_id'];
            $config['merchant_private_key'] = $pay_alipay_config['merchant_private_key'];
            $config['charset']    = 'UTF-8';
            $config['sign_type']  = 'RSA2';
            $config['gatewayUrl'] = 'https://openapi.alipay.com/gateway.do';
            $config['alipay_public_key'] = $pay_alipay_config['alipay_public_key'];

            // 实例化支付宝配置
            $aop = new \AlipayTradeService($config);
            $result = $aop->Query($RequestBuilder);
            
            // 解析数据
            $result = json_decode(json_encode($result), true);

            // 判断结果
            if ('40004' == $result['code'] && 'Business Failed' === $result['msg']) {
                $this->error('正在建立订单信息');
            } else if ('10000' == $result['code'] && 'WAIT_BUYER_PAY' === $result['trade_status']) {
                $this->error('订单已建立，尚未支付');
            } else if ('10000' == $result['code'] && 'TRADE_SUCCESS' === $result['trade_status']) {
                $ResultUrl = urldecode(url('user/Pay/pay_success', ['transaction_type'=>$transaction_type, 'order_code'=>$unified_number]));
                $ResultData = [
                    'email' => false,
                    'mobile' => false
                ];
                if (2 == $transaction_type) {
                    /*订单提醒*/
                    // 邮箱发送
                    $SmtpConfig = tpCache('smtp');
                    $ResultData['email'] = GetEamilSendData($SmtpConfig, $this->users, $where, 1, 'alipay');
                    /* END */

                    /*手机发送*/
                    $SmsConfig = tpCache('sms');
                    $ResultData['mobile'] = GetMobileSendData($SmsConfig, $this->users, $where, 1, 'alipay');
                    /* END */
                }
                $this->success('支付完成', $ResultUrl, $ResultData);
            }
        }
    }

    public function get_order_detail()
    {
        if (IS_AJAX_POST) {
            // 订单号
            $unified_number = input('post.unified_number/s');
            $unified_id     = input('post.unified_id/d');
            $transaction_type = input('post.transaction_type/d');
            // 跳转链接
            $url = urldecode(url('user/Pay/pay_success', ['transaction_type'=>$transaction_type]));
            if ('2' == $transaction_type) {
                // 购买订单
                // 查询条件
                $OrderWhere = array(
                    'order_id'   => $unified_id,
                    'order_code' => $unified_number,
                    'users_id'   => $this->users_id,
                    'lang'       => $this->home_lang,
                );
                $OrderRow  = $this->shop_order_db->where($OrderWhere)->field('order_status,pay_name')->find();
                if (!empty($OrderRow)) {
                    // 判断返回
                    if ('alipay' == $OrderRow['pay_name'] && in_array($OrderRow['order_status'], [1])) {
                        $this->success('订单已在支付宝付款完成！即将跳转~~~', $url);
                    }else if ('wechat' == $OrderRow['pay_name'] && in_array($OrderRow['order_status'], [1])) {
                        $this->success('订单已在微信付款完成！即将跳转~~~', $url);
                    }else if ('balance' == $OrderRow['pay_name'] && in_array($OrderRow['order_status'], [1])) {
                        // $this->success('订单已使用余额支付完成！即将跳转~~~', $url);
                    }else{
                        $this->error('等待支付');
                    }
                }
            }else if ('1' == $transaction_type) {
                // 充值订单
                // 查询条件
                $where = array(
                    'moneyid'     => $unified_id,
                    'order_number' => $unified_number,
                    'users_id'     => $this->users_id,
                    'lang'         => $this->home_lang,
                );
                $moneyRow  = $this->users_money_db->where($where)->field('status,pay_method')->find();
                if (!empty($moneyRow)) {
                    // 判断返回
                    if ('alipay' == $moneyRow['pay_method'] && in_array($moneyRow['status'], [2,3])) {
                        $this->success('订单已在支付宝付款完成！即将跳转~~~', $url);
                    }else if ('wechat' == $moneyRow['pay_method'] && in_array($moneyRow['status'], [2,3])) {
                        $this->success('订单已在微信付款完成！即将跳转~~~', $url);
                    }else if ('artificial' == $moneyRow['pay_method'] && in_array($moneyRow['status'], [2,3])) {
                        $this->success('订单已人为处理完成！即将跳转~~~', $url);
                    }else{
                        $this->error('等待支付');
                    }
                }
            }
        }
        $this->error('访问错误');
    }

    // 选择付款方式，目前用于微信，支付宝方式已直接调用链接
    public function pay_method()
    {
        // 付款方式，跳转至微信支付还是支付宝支付。
        // $pay_method = input('param.pay_method/s');
        // 订单交易类型
        $transaction_type = input('param.transaction_type/s');
        // 订单号
        $unified_number   = input('param.unified_number/s');
        // 订单ID
        $unified_id       = input('param.unified_id/d');

        // 升级会员支付
        $level_pay = input('get.level_pay/d');
        $WeChatUrl = '';
        if (isset($level_pay) && !empty($level_pay)) {
            // 生成回调URL
            $WeChatUrl = url('user/Level/wechat_order_inquiry',['_ajax'=>1]);
        }
        $this->assign('WeChatUrl',$WeChatUrl);
        $this->assign('unified_number',$unified_number);
        $this->assign('transaction_type',$transaction_type);

        // 执行跳转
        return $this->fetch('users/pay_wechat');
    }

    // 微信支付，获取订单信息并调用微信接口，生成二维码用于扫码支付
    public function pay_wechat_png(){
        $users_id = session('users_id');
        if (!empty($users_id)) {
            $unified_number   = input('param.unified_number/s');
            $transaction_type = input('param.transaction_type/s');
            if ('2' == $transaction_type) {
                // 购买订单
                $where  = array(
                    'users_id'   => $users_id,
                    'order_code' => $unified_number,
                );
                $data  = $this->shop_order_db->where($where)->find();
                $out_trade_no = $data['order_code'];
                $total_fee    = $data['order_amount'];
            }else if ('1' == $transaction_type) {
                // 充值订单
                $where  = array(
                    'users_id'     => $users_id,
                    'order_number' => $unified_number,
                );
                $data  = $this->users_money_db->where($where)->find();
                $out_trade_no = $data['order_number'];
                $total_fee    = $data['money'];
            }

            // 调取微信支付链接
            $payUrl = model('Pay')->payForQrcode($out_trade_no,$total_fee);// PC调用
            // 生成二维码加载在页面上
            vendor('wechatpay.phpqrcode.phpqrcode');
            $qrcode = new \QRcode;
            $pngurl = $payUrl;
            $qrcode->png($pngurl);
            exit();
        }else{
            $this->redirect('user/Users/login');
        }
    }

    // ajax异步查询订单状态，轮询方式（微信）
    public function pay_deal_with(){
        if (IS_AJAX_POST) {
            $unified_number   = input('post.unified_number/s');
            $transaction_type = input('post.transaction_type/s');
            if(!empty($unified_number)){
                // ajax异步查询订单是否完成并处理相应逻辑返回。
                vendor('wechatpay.lib.WxPayApi');
                vendor('wechatpay.lib.WxPayConfig');
                // 实例化加载订单号
                $input  = new \WxPayOrderQuery;
                $input->SetOut_trade_no($unified_number);

                // 处理微信配置数据
                $pay_wechat_config = getUsersConfigData('pay.pay_wechat_config');
                $pay_wechat_config = unserialize($pay_wechat_config);
                $config_data['app_id'] = $pay_wechat_config['appid'];
                $config_data['mch_id'] = $pay_wechat_config['mchid'];
                $config_data['key']    = $pay_wechat_config['key'];

                // 实例化微信配置
                $config = new \WxPayConfig($config_data);
                $wxpayapi = new \WxPayApi;

                if (empty($config->app_id)) $this->error('微信支付配置尚未配置完成。');

                // 返回结果
                $result = $wxpayapi->orderQuery($config, $input);
                // 业务处理
                if ($result['return_code'] == 'SUCCESS' && $result['result_code'] == 'SUCCESS'){
                    if ($result['trade_state'] == 'SUCCESS' && !empty($result['transaction_id'])) {
                        if (2 == $transaction_type) {
                            // 付款成功
                            $order_data = $this->shop_order_db->where([
                                'order_code' => $result['out_trade_no'],
                                'users_id'   => $this->users_id,
                                'lang'       => $this->home_lang,
                            ])->find();

                            if (empty($order_data)) {
                                $this->error('支付异常，请刷新页面后重试');
                            }

                            // 微信付款成功后，订单并未修改状态时，修改订单状态并返回
                            if (empty($order_data['order_status'])) {
                                $OrderWhere = [
                                    'order_id'  => $order_data['order_id'],
                                    'users_id'  => $this->users_id,
                                    'lang'      => $this->home_lang,
                                ];
                                // 修改会员金额明细表中，对应的订单数据，存入返回的数据，订单已付款
                                $OrderData = [
                                    'order_status' => 1,
                                    // 'pay_name'     => 'wechat', //微信支付
                                    'pay_details'  => serialize($result),
                                    'pay_time'     => getTime(),
                                    'update_time'  => getTime(),
                                ];
                                $order_id = $this->shop_order_db->where($OrderWhere)->update($OrderData);

                                if (!empty($order_id)) {
                                    $DetailsData['update_time'] = getTime();
                                    $this->shop_order_details_db->where($OrderWhere)->update($DetailsData);

                                    // 添加订单操作记录
                                    AddOrderAction($order_data['order_id'],$this->users_id,'0','1','0','1','支付成功！','会员使用微信完成支付！');

                                    // 邮箱发送
                                    $SmtpConfig = tpCache('smtp');
                                    $Result['email'] = GetEamilSendData($SmtpConfig, $this->users, $order_data, 1, 'wechat');

                                    // 手机发送
                                    $SmsConfig = tpCache('sms');
                                    $Result['mobile'] = GetMobileSendData($SmsConfig, $this->users, $order_data, 1, 'wechat');

                                    // 订单支付完成
                                    if (isMobile() && isWeixin()) {
                                        $url = url('user/Shop/shop_centre');
                                    }else{
                                        $url = urldecode(url('user/Pay/pay_success', ['transaction_type'=>$transaction_type]));
                                    }
                                    $Result['status'] = 1;
                                    $this->success('支付成功，即将跳转~~~', $url, $Result);
                                }
                            }

                            if ($order_data['order_status'] == 1 && !empty($order_data['pay_details'])) {
                                // 订单已付款
                                if (isMobile() && isWeixin()) {
                                    $url = url('user/Shop/shop_centre');
                                }else{
                                    $url = urldecode(url('user/Pay/pay_success', ['transaction_type'=>$transaction_type]));
                                }
                                $this->success('支付成功，即将跳转~~~', $url, ['status'=>1]);
                            }

                            if ($order_data['order_status'] == 3) {
                                // 订单已完成，待处理逻辑
                                // 待处理逻辑..........
                            }

                            if ($order_data['order_status'] == 4) {
                                // 订单已取消，待处理逻辑
                                // 待处理逻辑..........
                            }

                        }else if (1 == $transaction_type) {
                            // 付款成功
                            $moneydata = $this->users_money_db->where([
                                'order_number' => $result['out_trade_no'],
                                'users_id'     => $this->users_id,
                                'lang'         => $this->home_lang,
                            ])->find();

                            if (empty($moneydata)) {
                                $this->error('支付异常，请刷新页面后重试');
                            }

                            // 微信付款成功后，订单并未修改状态时，修改订单状态并返回
                            if ($moneydata['status'] == 1) {
                                // 修改会员金额明细表中，对应的订单数据，存入返回的数据，订单已付款
                                $data = [
                                    'status'        => 2,
                                    // 'pay_method'    => 'wechat', //微信支付
                                    'pay_details'   => serialize($result),
                                    'update_time'   => getTime(),
                                ];
                                $ismoney = $this->users_money_db->where([
                                        'moneyid'  => $moneydata['moneyid'],
                                        'users_id'  => $this->users_id,
                                    ])->update($data);

                                if (!empty($ismoney)) {
                                    // 同步修改会员的金额
                                    $usersdata = [
                                        'users_money' => Db::raw('users_money+'.($moneydata['money'])),
                                    ];
                                    $isusers = $this->users_db->where([
                                            'users_id'  => $this->users_id,
                                        ])->update($usersdata);

                                    if (!empty($isusers)) {
                                        // 业务处理完成，订单已完成
                                        $data2 = [
                                            'status'      => 3,
                                            'update_time' => getTime(),
                                        ];
                                        $this->users_money_db->where([
                                                'moneyid'  => $moneydata['moneyid'],
                                                'users_id'  => $this->users_id,
                                            ])->update($data2);
                                        if (isMobile() && isWeixin()) {
                                            $url = url('user/Pay/pay_consumer_details');
                                        }else{
                                            $url = urldecode(url('user/Pay/pay_success', ['transaction_type'=>$transaction_type]));
                                        }
                                        $this->success('充值成功，即将跳转~~~', $url, ['status'=>1]);
                                    }else{
                                        $this->success('付款成功，但未充值成功，请联系管理员。', null, ['status'=>2]);
                                    }
                                }else{
                                    $this->success('付款成功，数据错误，未能充值成功，请联系管理员。', null, ['status'=>2]);
                                }
                            }

                            if ($moneydata['status'] == 2 && !empty($moneydata['pay_details'])) {
                                // 订单已付款
                                if (isMobile() && isWeixin()) {
                                    $url = url('user/Pay/pay_consumer_details');
                                }else{
                                    $url = urldecode(url('user/Pay/pay_success', ['transaction_type'=>$transaction_type]));
                                }
                                $this->success('充值成功，即将跳转~~~', $url, ['status'=>1]);
                            }

                            if ($moneydata['status'] == 3) {
                                // 订单已完成，待处理逻辑
                                // 待处理逻辑..........
                            }

                            if ($moneydata['status'] == 4) {
                                // 订单已取消，待处理逻辑
                                // 待处理逻辑..........
                            }
                        }
                    }else if ($result['trade_state'] == 'NOTPAY') {
                        // 付款中
                        $this->success('正在付款中~~~~', '', ['status'=>0]);
                    }
                }else{
                    $msg = '订单号：'.$unified_number.'，正在付款中~~~~~';
                    $this->error($msg, null, ['status'=>0]);
                }
            }
        }
        $this->error('访问错误');
    }

    // 微信支付成功后跳转到此页面
    public function pay_success(){
        if (1 == input('param.transaction_type')) {
            $url = urldecode(url('user/Pay/pay_consumer_details'));
        }else if (2 == input('param.transaction_type')) {
            $url = urldecode(url('user/Shop/shop_centre'));
        }
        $this->assign('url',$url);
        return $this->fetch('users/pay_success');
    }

    // 新版支付宝支付
    public function newAlipayPayUrl(){
        $data['unified_number']   = input('param.unified_number/s');
        $data['unified_amount']   = input('param.unified_amount/f');
        $data['transaction_type'] = input('param.transaction_type/d');
        // 调用新版支付宝支付方法
        model('Pay')->getNewAliPayPayUrl($data);
    }

    // 支付宝回调接口，处理订单数据
    public function alipay_return(){
        // 跳转处理回调信息
        $pay_logic = new PayLogic();
        $result    = $pay_logic->alipay_return();
        if (1 == $result['code']) {
            $this->redirect($result['url']);
        }else{
            $this->error($result['msg']);
        }
    }

    // 余额支付
    public function balance_payment()
    {
        if (IS_AJAX_POST) {
            $post = input('post.');
            $Data = $this->shop_order_db->field('order_amount,order_id,order_status')->find($post['unified_id']);
            if (empty($Data)) $this->error('订单不存在！');
            
            //1已付款(待发货)，2已发货(待收货)，3已完成(确认收货)，-1订单取消(已关闭)，4订单过期
            $url = urldecode(url('user/Shop/shop_order_details', ['order_id' => $Data['order_id']]));
            if (in_array($Data['order_status'], [1,2,3])) {
                $this->success('订单已支付！即将跳转~~~', $url);
            } elseif ($Data['order_status'] == 4) {
                $this->success('订单已过期！即将跳转~~~', $url);
            } elseif ($Data['order_status'] == -1) {
                $this->success('订单已关闭！即将跳转~~~', $url);
            }
            if ($this->users['users_money'] >= $Data['order_amount']) {
                $Where = [
                    'users_id'   => $this->users_id,
                    'lang'       => $this->home_lang,
                ];

                $post['payment_amount'] = $Data['order_amount'];
                $post['payment_type']   = '余额支付';
                $OrderData = [
                    'order_status' => 1,
                    'pay_name'     => 'balance',// 余额支付
                    'wechat_pay_type' => '', // 余额支付则清空微信标志
                    'pay_details'  => serialize($post),
                    'pay_time'     => getTime(),
                    'update_time'  => getTime(),
                ];
                $OrderWhere = [
                    'order_id'   => $post['unified_id'],
                    'order_code' => $post['unified_number'],
                ];
                $OrderWhere = array_merge($Where, $OrderWhere);
                $return = $this->shop_order_db->where($OrderWhere)->update($OrderData);

                if (!empty($return)) {
                    $DetailsWhere = [
                        'order_id'   => $post['unified_id'],
                    ];
                    $DetailsWhere = array_merge($Where, $DetailsWhere);
                    $DetailsData['update_time'] = getTime();
                    $this->shop_order_details_db->where($DetailsWhere)->update($DetailsData);

                    $UsersData = [
                        'users_money' => $this->users['users_money'] - $Data['order_amount'],
                        'update_time' => getTime(),
                    ];
                    $users_id = $this->users_db->where($Where)->update($UsersData);
                    if (!empty($users_id)) {
                        // 添加订单操作记录
                        AddOrderAction($post['unified_id'],$this->users_id,'0','1','0','1','支付成功！','会员使用余额完成支付！');
                        // 虚拟自动发货
                        model('Pay')->afterVirtualProductPay($DetailsWhere);

                        // 邮箱发送
                        $SmtpConfig = tpCache('smtp');
                        $ResultData['email'] = GetEamilSendData($SmtpConfig, $this->users, $OrderWhere, 1, 'balance');

                        // 手机发送
                        $SmsConfig = tpCache('sms');
                        $ResultData['mobile'] = GetMobileSendData($SmsConfig, $this->users, $OrderWhere, 1, 'wechat');
                        if (isMobile() && isWeixin()) {
                            $url = url('user/Shop/shop_centre');
                        }else{
                            $url = urldecode(url('user/Pay/pay_success', ['transaction_type'=>2]));
                        }
                        $this->success('订单已在余额付款完成！即将跳转~~~', $url, $ResultData);
                    }
                }else{
                    $this->error('订单支付异常，请刷新后再进行支付！');
                }
            }else{
                $url = urldecode(url('user/Pay/pay_account_recharge'));
                $this->error('余额不足，若要使用余额支付，请去充值！',$url);
            }
        }
    }

    public function update_pay_method()
    {
        if (IS_AJAX_POST) {
            $post = input('post.');
            if (!empty($post)) {
                // 初始化默认为微信支付，用于存入数据
                $pay_method       = 'wechat';
                // 初始化默认为传入的值，这个参数仅用于微信支付存入数据
                $wechat_pay_type  = '';
                // 订单交易类型，用于判断
                $transaction_type = $post['transaction_type'];
                // 支付方式(支付宝或微信)，用于判断
                $pay_method_type  = $post['pay_method'];
                // 订单ID，用于查询
                $unified_id       = $post['unified_id'];
                // 订单号，用于查询
                $unified_number   = $post['unified_number'];
                // 判断订单交易类型，选择查询条件
                if (1 == $transaction_type) {
                    // 充值金额
                    $UpdateWhere = [
                        'moneyid'      => $unified_id,
                        'order_number' => $unified_number,
                        'users_id'     => $this->users_id,
                        'lang'         => $this->home_lang,
                    ];
                }else if (2 == $transaction_type) {
                    // 购买商品
                    $UpdateWhere = [
                        'order_id'   => $unified_id,
                        'order_code' => $unified_number,
                        'users_id'   => $this->users_id,
                        'lang'       => $this->home_lang,
                    ];
                    // 查询订单价格
                    $order_total_amount = $this->shop_order_db->where($UpdateWhere)->getField('order_total_amount');
                }

                // 判断支付方式及类型
                if ('AliPay' == $pay_method_type) {
                    // 支付宝支付
                    $pay_method = 'alipay';
                }else {
                    // 微信支付，先判断这个订单是否标记过，标记和传入的参数是否一致，不一致则返回提示结束支付
                    if ('1' == $transaction_type) {
                        // 充值金额，判断是否属于当前支付类型
                        $return = $this->determine_pay_type($this->users_money_db,$UpdateWhere,$pay_method_type);
                        if (!empty($return)) {
                            $this->error($return);exit;
                        }
                    }else if ('2' == $transaction_type) {
                        // 购买商品，判断是否属于当前支付类型
                        $return = $this->determine_pay_type($this->shop_order_db,$UpdateWhere,$pay_method_type);
                        if (!empty($return)) {
                            $this->error($return);exit;
                        }
                    }

                    // 判断支付类型
                    switch ($pay_method_type) {
                        case 'WeChatScanCode':
                            // PC端微信扫码支付
                            $wechat_pay_type = 'WeChatScanCode';
                            break;
                        case 'WeChatInternal':
                            // 手机微信端H5支付
                            $wechat_pay_type = 'WeChatInternal';               
                            break;
                        case 'WeChatH5':
                            // 手机端浏览器H5支付
                            $wechat_pay_type = 'WeChatH5';               
                            break;
                        default:
                            $this->error('错误提示：101，选择支付方式错误，请刷新后重试~~');
                            break;
                    }

                }

                // 判断充值金额\购买商品
                if ('1' == $transaction_type) {
                    // 充值金额
                    $UpdateData = [
                        'pay_method'      => $pay_method,
                        'update_time'     => getTime(),
                    ];
                    if ('AliPay' != $pay_method_type) {
                        // 支付方式不等于支付宝时才修改的内容
                        $UpdateData['wechat_pay_type'] = $wechat_pay_type;
                    }
                    $result = $this->users_money_db->where($UpdateWhere)->update($UpdateData);

                }else if ('2' == $transaction_type) {
                    // 购买商品
                    $UpdateData = [
                        'pay_name'        => $pay_method,
                        'update_time'     => getTime(),
                    ];
                    if ('AliPay' != $pay_method_type) {
                        // 支付方式不等于支付宝时才修改的内容
                        $UpdateData['wechat_pay_type'] = $wechat_pay_type;
                    }
                    $result = $this->shop_order_db->where($UpdateWhere)->update($UpdateData);
                }
                if (!empty($result)) {
                    if (isMobile() && isWeixin()) {
                        $ReturnOrderData = [
                            'unified_id'       => $unified_id,
                            'unified_number'   => $unified_number,
                            'transaction_type' => $transaction_type, // 订单支付购买
                            'order_total_amount' => $order_total_amount,
                            'order_source'     => $post['order_source'], // 订单列表页、订单详情页
                            'is_gourl'         => 1,
                        ];
                        if ($this->users['users_money'] <= '0.00') {
                            if (!empty($this->users['open_id'])) {
                                $ReturnOrderData['is_gourl'] = 0;
                                // 余额小于0
                                $this->success('101：信息正确', null, $ReturnOrderData);
                            }else if (2 == $post['order_source']) {
                                $this->error('余额为0！');
                            }else{
                                $this->error('手机端微信使用本站账号登录仅可余额支付！');
                            }
                        }else{
                            if (!empty($this->users['open_id'])) {
                                // 余额大于0
                                $url = url('user/Shop/shop_wechat_pay_select');
                                session($this->users_id.'_ReturnOrderData',$ReturnOrderData);
                                $this->success('102：信息正确', $url, $ReturnOrderData);
                            }else if ($this->users['users_money'] < $order_total_amount){
                                $this->error('余额不足！');
                            }else{
                                $url = url('user/Shop/shop_wechat_pay_select');
                                session($this->users_id.'_ReturnOrderData',$ReturnOrderData);
                                $this->success('102：信息正确', $url, $ReturnOrderData);
                            }
                        }
                    }else{
                        $this->success('103：信息正确');
                    }
                }else{
                    $this->error('数据错误，请刷新后重试！刷新后仍然无法支付请联系管理员！');
                }
            }else{
                $this->error('数据错误，请刷新后重试~');
            }
        }
    }

    // 确定支付类型
    // $table 查询的表，仅用于充值金额和购买订单表
    // $where 查询条件
    // $pay_method_type 当前提交的类型，用于判断
    private function determine_pay_type($table,$where,$pay_method_type)
    {
        $new_wechat_pay_type = $table->where($where)->getField('wechat_pay_type');
        // 若为空，则表现未标记过支付类型
        if (empty($new_wechat_pay_type)) {
            return false;
        }
        // 是否数据库中的支付类型和传入的一致
        if ($new_wechat_pay_type != $pay_method_type) {
            // 判断返回提示信息
            switch ($new_wechat_pay_type) {
                case 'WeChatScanCode':
                    // PC端微信扫码支付
                    return '已在PC端浏览器中微信扫码生成订单，请到PC端浏览器完成支付！';
                    break;
                case 'WeChatInternal':
                    // 手机微信端H5支付
                    return '已在手机端微信中生成订单，请到手机端微信完成支付！';                
                    break;
                case 'WeChatH5':
                    // 手机端浏览器H5支付
                    return '已在手机端浏览器中生成订单，请到手机端浏览器完成支付！';                
                    break;
                default:
                    return '错误提示：102，选择支付方式错误，请刷新后重试~~';
                    break;
            }
        }else{
            return false;
        }
    }

    // 手机微信端H5支付
    public function wechat_pay()
    {
        if (IS_POST) {
            $unified_id       = input('post.unified_id/d');
            $unified_number   = input('post.unified_number/s');
            $transaction_type = input('post.transaction_type/d');

            $where = [
                'users_id' => $this->users_id,
                'lang'     => $this->home_lang,
            ];
            $open_id = input('post.openid') ? input('post.openid') : $this->users_db->where($where)->getField('open_id');
            if (empty($open_id)) $this->error('手机端微信使用本站账号登录仅可余额支付！');

            if (2 == $transaction_type) {
                // 购买商品
                $PayWhere = [
                    'order_id'   => $unified_id,
                    'order_code' => $unified_number
                ];
                $PayData = $this->shop_order_db->where($PayWhere)->field('order_code, order_amount')->find();
                $out_trade_no = $PayData['order_code'];
                $total_fee    = $PayData['order_amount'];
            } else if (1 == $transaction_type) {
                // 充值金额
                $PayWhere = [
                    'moneyid'      => $unified_id,
                    'order_number' => $unified_number
                ];
                $PayData = $this->users_money_db->where($PayWhere)->field('order_number, money')->find();
                $out_trade_no = $PayData['order_number'];
                $total_fee    = $PayData['money'];
            } else {
                $this->error('订单类型错误！');
            }

            // 判断是否小程序接入，存在openid则表示小程序接入
            if (input('post.openid')) {
                $data = model('Pay')->getWechatPay($open_id, $out_trade_no, $total_fee, '小程序支付', '小程序支付', 1); 
            } else {
                $data = model('Pay')->getWechatPay($open_id, $out_trade_no, $total_fee);    
            }
            
            // 这个data返回的是调用需要时，所需要给微信提供的公众号参数，并非提示信息
            if (!empty($data)) {
                if (input('post.openid')) {
                    echo json_encode($data);
                } else {
                    $this->success($data);  
                }
            } else {
                $this->error('微信支付信息错误，请刷新后重试~');
            }
        }
    }

    public function get_openid() {
        // 小程序配置
        $MiniproValue = Db::name('weapp_minipro0002')->where('type', 'minipro')->getField('value');
        if (empty($MiniproValue)) return false;
        $MiniproValue = !empty($MiniproValue) ? json_decode($MiniproValue, true) : [];

        $code = input('param.code');
        $appid  = $MiniproValue['appId']; // 小程序APPID
        $secret = $MiniproValue['appSecret']; // 小程序secret
        $url = 'https://api.weixin.qq.com/sns/jscode2session?appid=' . $appid . '&secret=' . $secret . '&js_code=' . $code . '&grant_type=authorization_code';
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。    
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);
        $res = curl_exec($curl);
        curl_close($curl);
        
        echo json_encode($res);
    }

    public function ajax_applets_pay() {
        // 小程序配置
        $MiniproValue = Db::name('weapp_minipro0002')->where('type', 'minipro')->getField('value');
        if (empty($MiniproValue)) return false;
        $MiniproValue = !empty($MiniproValue) ? json_decode($MiniproValue, true) : [];

        $app_id           = $MiniproValue['appId'];
        $unified_id       = input('post.unified_id/s');
        $unified_number   = input('post.unified_number/s');
        $transaction_type = input('post.transaction_type');
        if (!empty($app_id) && !empty($unified_id) && !empty($unified_number)) {
            // ajax异步查询订单是否完成并处理相应逻辑返回。
            vendor('wechatpay.lib.WxPayApi');
            vendor('wechatpay.lib.WxPayConfig');
            
            // 实例化加载订单号
            $input  = new \WxPayOrderQuery;
            $input->SetOut_trade_no($unified_number);
            
            // 处理微信配置数据
            $pay_wechat_config = getUsersConfigData('pay.pay_wechat_config');
            $pay_wechat_config = unserialize($pay_wechat_config);
            $config_data['app_id'] = $app_id;
            $config_data['mch_id'] = $pay_wechat_config['mchid'];
            $config_data['key']    = $pay_wechat_config['key'];

            // 实例化微信配置 
            $config = new \WxPayConfig($config_data);
            $wxpayapi = new \WxPayApi;

            // 返回结果
            $result = $wxpayapi->orderQuery($config, $input);
            if ($result['return_code'] == 'SUCCESS' && $result['result_code'] == 'SUCCESS'){
                if ($result['trade_state'] == 'SUCCESS' && !empty($result['transaction_id'])) {
                    if (1 == $transaction_type) {
                        // 充值处理
                        $moneydata = $this->users_money_db->where([
                            'order_number' => $result['out_trade_no'],
                        ])->find();

                        // 微信付款成功后，订单并未修改状态时，修改订单状态并返回
                        if ($moneydata['status'] == 1) {
                            // 修改会员金额明细表中，对应的订单数据，存入返回的数据，订单已付款
                            $data = [
                                'status'        => 2,
                                'pay_details'   => serialize($result),
                                'update_time'   => getTime(),
                            ];
                            $ismoney = $this->users_money_db->where([
                                    'moneyid'  => $moneydata['moneyid'],
                                ])->update($data);
                            if (!empty($ismoney)) {
                                // 同步修改会员的金额
                                $usersdata = [
                                    'users_money' => Db::raw('users_money+'.($moneydata['money'])),
                                ];
                                $isusers = $this->users_db->where([
                                        'users_id'  => $moneydata['users_id'],
                                    ])->update($usersdata);

                                if (!empty($isusers)) {
                                    // 业务处理完成，订单已完成
                                    $data2 = [
                                        'status'      => 3,
                                        'update_time' => getTime(),
                                    ];
                                    $this->users_money_db->where([
                                            'moneyid'  => $moneydata['moneyid'],
                                            'users_id' => $moneydata['users_id'],
                                        ])->update($data2);
                                    $url = url('user/Pay/pay_consumer_details');
                                    $this->success('充值成功', $url);
                                }else{
                                    $this->error('付款成功，但未充值成功，请联系管理员。');
                                }
                            }else{
                                $this->error('付款成功，数据错误，未能充值成功，请联系管理员。');
                            }
                        }
                    } else if (2 == $transaction_type) {
                        // 支付处理
                        $order_data = $this->shop_order_db->where([
                            'order_code' => $result['out_trade_no'],
                        ])->find();
                        if (0 == $order_data['order_status']) {
                            $OrderWhere = [
                                'order_id' => $order_data['order_id'],
                            ];
                            // 修改会员金额明细表中，对应的订单数据，存入返回的数据，订单已付款
                            $OrderData = [
                                'order_status' => 1,
                                'pay_details'  => serialize($result),
                                'pay_time'     => getTime(),
                                'update_time'  => getTime(),
                            ];
                            $order_id = $this->shop_order_db->where($OrderWhere)->update($OrderData);
                            if (!empty($order_id)) {
                                $DetailsData['update_time'] = getTime();
                                $this->shop_order_details_db->where($OrderWhere)->update($DetailsData);
            
                                // 添加订单操作记录
                                AddOrderAction($order_data['order_id'],$order_data['users_id'],'0','1','0','1','支付成功！','会员使用微信小程序完成支付！');
                                    
                                // 邮箱发送
                                $SmtpConfig = tpCache('smtp');
                                $Result['email'] = GetEamilSendData($SmtpConfig, $this->users, $order_data, 1, 'wechat');

                                // 手机发送
                                $SmsConfig = tpCache('sms');
                                $Result['mobile'] = GetMobileSendData($SmsConfig, $this->users, $order_data, 1, 'wechat');

                                $url = url('user/Shop/shop_centre');
                                $this->success('支付成功！', $url, $Result); 
                            }
                        }
                    }
                }
            }
        }
    }

}
