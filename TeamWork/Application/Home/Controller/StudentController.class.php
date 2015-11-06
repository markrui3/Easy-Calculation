<?php
namespace Home\Controller;
use Think\Controller;
class StudentController extends Controller {
    public function index(){
       $this->display('student/index');
    }

    public function getQuestionList(){
        $teacher_id = I('param.teacher_id');
        $Dao = M('question');
        $result = $Dao->where("teacher_id=$teacher_id AND public='true'")->select();
        $data = array();
        foreach($result as $r){
            $d = array();
            $d['question_id'] = $r['question_id'];
            $d['name'] = $r['name'];
            $d['question_content'] = $r['question_id'];
            array_push($data,$d);
        }

        echo json_encode($data);
    }

    public function getQuestionContent(){
        $question_id = I('param.question_id');
        $Dao = M('question');
        $result = $Dao->where("question_id=$question_id")->getField("question_content");

        echo $result;
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

