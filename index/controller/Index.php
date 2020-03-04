<?php
namespace app\index\controller;
use app\index\model\User;
use think\Controller;
use think\Log;

class Index extends controller
{
    protected $question = array(
        'A页面跳转到B页面的方法',
        'GIT和SVN的区别',
        '获取客户端IP和伪装IP',
        'nginx负载均衡的策略',
        'TPC三次握手，四次握手',
        '一次http请求过程，http和https的区别',
        'PHP原生实现网页静态化',
        'PHP的设计模式有哪些',
        'php5和php7的区别',
        'InnoDb和MyIsam的区别'
    );

    protected $answer = array(
        'header();< meta http-equiv="refresh" content="2;url=http://www.baidu.com">;JS方法',
        'git是分布式的，SVN不是；SVN以文件形式保存代码，Git以数据单元保存；离线时，Git可以查看日志，SVN不可以；Git在本地创建分支不影响其他成员，SVN创建分支会影响，因此Git适合大型项目的代码管理，小型项目可以用SVN，SVN使用比较简单',
        '客户端IP：$_SERVER["REMOTE_ADDR"],服务器IP：$_SERVER["SERVER_ADDR"];<br/>
        使用curl伪装IP:$ch = curl_init();<br/>curl_setopt($ch, CURLOPT_URL, $url);<br/>
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(\'x-forwarded-for:8.8.8.8\', \'client-ip:8.8.8.8\'));<br/>$out = curl_exec($ch);',
        'Nginx配置UpSteam,proxy_设置，默认策略是轮询，还有权重的方法；',
        '三次握手过程：第一次握手，客户端发送请求包，第二次握手，服务端发送确认包并且发送请求包，第三次握手，客户端发送确认包，连接建立成功，开始传输数据<br/>
        四次握手过程：第一次握手，客户端发送数据传输完成的命令，第二次握手，服务端发送确认包，第三次握手，服务端发送数据传输完成的命令，第四次握手，客户端发送确认包，TPC传输结束',
        '1. 建立TCP连接，2. Web浏览器向Web服务器发送请求命令，3. Web浏览器发送请求头信息 ，4. Web服务器应答，5. Web服务器发送应答头信息 ，6. Web服务器向浏览器发送数据，7. Web服务器关闭TCP连接；',
        '使用输出缓冲区缓保存输出的内容到html文件，下次访问时直接输出html文件',
        '单例模式，工厂模式，观察者模式，策略模式，其中数据库连接和缓存是使用单例模式的',
        'php7速度上要比5快很多，因为php7缩小了变量的内存占用，数组的结构，节省了资源',
        'InnoDb是聚集索引，支持外键，事务，不支持全文索引，不保存表的行数，MyIsam是非聚集索引，不支持外键，事务，支持全文索引，保存表的行数，查询速度比InnoDb快'

    );

    public function index()
    {
        $a = 123;
        return view('index');
        exit();
        dump(db('user')->select());

        echo '排序变小</br>';
        $str = 'Apple Pink drink Banner';
        $array = explode(' ',$str);
        foreach ($array as &$v)
            $v = strtolower($v);
        sort($array);
        dump($array);

        echo '随机字符串</br>';
        function randStr($length){
            $str = '';
            for($i = 1;$i<=$length;$i++)
                $str .= chr(mt_rand(33,126));
            return $str;
        }
        $strArr = [];
        for($i = 0;$i<100;$i++){
            do
                $rand = randStr(8);
            while (in_array($rand,$strArr));

            $strArr[] = $rand;
        }
        dump($strArr);

        echo '下一题</br>';
        echo 'MO支持事务、外键，是聚集索引，不支持全文索引，不保存表的具体行数，Myisam不支持事务、外键，是非聚集索引，支持全文索引，查询速度更快，保存表的具体行数';

    }


    function interview(){
        foreach ($this->question as $k=>$v){
            echo "第{$k}题：".$this->question[$k].'<br/>';
            echo $this->answer[$k].'<br/><br/>';
        }
    }

    public function test(){
//        $log = new Log();
//        $log->write('asd');
        $this->assign('list',['a'=>['b'=>123]]);
        $this->assign('a',['c'=>'a']);
        return view();
    }

    public function secret(){
        if(request()->post()){
            $secret = input('secret');
            $id = input('id');
            $mima = md5($id.$_SERVER['REQUEST_TIME']);
            if($mima = $secret)
                echo '成功验证</br>';
            echo ('密文：'.$mima.'时间：'.$_SERVER['REQUEST_TIME']);
            exit();
        }
        return view();
    }

    public function test2(){

        $model = new User();
        $model->setData([['a'=>1],['a'=>2]]);
        $data = $model->call(function(&$item){
//            var_dump($item);
            $item['b'] = 123;
        });
        exit();
        dump($data);
    }
}
