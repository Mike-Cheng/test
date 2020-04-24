<?php
namespace app\index\controller;
use app\index\model\User;
//use qrCode\QRcode;
use qrCode\QRcode;
use think\console\command\make\Model;
use think\Controller;
use think\Db;
use websocket\webSocket;

class Test extends Controller
{
    public function index()
    {
        $model = new User();
//        $model = db('user');
        $result = $model->find();
         echo $result;
//        echo test();

        // dump(json_decode(json_encode($result),true));
    }

    public function test(){
        echo config('root');
        exit();
        $model = new User();
        Db::startTrans();
        $result = $model->where('id',2)->setField('name',123);
        dump($result);
//        return view();
    }

    public function qrcode(){
        vendor('qrCode.phpQrcode');
//        include '../extend/qrCode/phpQrcode.php';
        //二维码内容
//        $value = 'http://r.lgw.ink?dev_id=ZNHSTS3940140816';
        $value = 'https://c.lgw.ink/?recover_no=2001859475';
//        $value = 'https://api.laigewan.com/api/Recover_device/staffRecoverByWx?dev_id=112&goods_num=4';
        $errorCorrectionLevel = 'L';    //容错级别
        $matrixPointSize = 3;
        $filename = '123.png';
        QRcode::png($value,$filename , $errorCorrectionLevel, $matrixPointSize, 2,false,'blue');
        $QR = $filename;                //已经生成的原始二维码图片文件
        $QR = imagecreatefromstring(file_get_contents($QR));
        imagepng($QR, $filename);
        imagedestroy($QR);
        return '<img src="/tp5/public/123.png" >';
    }


    public function parse(){
        parse_str('name=123&pass=122',$g);
        dump($g);
    }

    public function hellow($name,$id){
    	echo 'hellow'.$name.',ID为：'.$id;
    }

    public function user(){
        $user = new User;
        $result = $user->where(['id'=>'1','username'=>'2'])->whereOr(['id'=>'1','username'=>'2'])->find();
        dump($result->getLastSql());
    }

    public function webSocket(){
        return view();
    }

    public function runSocket(){
        //地址与接口，即创建socket时需要服务器的IP和端口
        $sk = new webSocket('127.0.0.1', 8888);

        //对创建的socket循环进行监听，处理数据
        $sk->run();
    }

    public function map(){
        return view();
    }

    public function send(){
        $client = stream_socket_client('tcp://127.0.0.1:8888', $errno, $errmsg, 1,  STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT);
// 推送的数据，包含uid字段，表示是给这个uid推送
        $data = array('uid'=>'uid1', 'percent'=>'88%');
// 发送数据，注意5678端口是Text协议的端口，Text协议需要在数据末尾加上换行符
        fwrite($client, json_encode($data)."\n");
// 读取推送结果
        echo fread($client, 8192);
    }

    public function phpinfo(){
        phpinfo();
    }

    public function file(){
        $stram = file_get_contents('https://small.gelifood.com/api.txt');
        echo $stram;
    }


}
