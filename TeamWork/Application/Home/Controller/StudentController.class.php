<?php
namespace Home\Controller;
use Think\Controller;
class StudentController extends Controller {
    public function index(){
       $this->display('student/index');
    }

    public function checkLogin(){
        $data['username'] = I('param.username');
        $data['pwd'] = I('param.password');

        if(!$data['username'] || !$data['pwd']){
            $result['status'] = 'miss info';
            $result['message'] = '缺少有效信息';

            echo json_encode($result);
            exit;
        }

        $Dao = M('student');
        $r = $Dao->where($data)->find();

        // var_dump($Dao);

        if($r){
            session('student', $r);

            $result['status'] = 'success';
            $result['message'] = '登录成功';
        } else {
            $result['status'] = 'fail';
            $result['message'] = '登录失败';
        }

        echo json_encode($result);
    }
}

