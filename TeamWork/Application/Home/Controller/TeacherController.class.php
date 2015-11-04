<?php
namespace Home\Controller;
use Think\Controller;
class TeacherController extends Controller {
    public function index(){
       $this->display('teacher/index');
    }

    public function getStudentList(){
        $teacher_id = I('param.teacher_id');
        $Dao = M('student');
        $result = $Dao->where("teacher_id=$teacher_id")->select();
        $data = array();
        foreach($result as $r){
            $d = array();
            $d['student_id'] = $r['student_id'];
            $d['name'] = $r['name'];
            $d['avescore'] = intval($r['avescore']);
            $d['info'] = $r['student_id']; 
            array_push($data,$d);
        }
        echo json_encode($data);
    }
    
    public function getStudentInfo(){
        $student_id = I('param.student_id');
        $Dao = M('stu_ques_id');
        $result = $Dao->where("student_id=$student_id")->select();

        echo json_encode($result);
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

        $Dao = M('teacher');
        $r = $Dao->where($data)->find();

        // var_dump($Dao);

        if($r){
            session('teacher', $r);

            $result['status'] = 'success';
            $result['message'] = '登录成功';
        } else {
            $result['status'] = 'fail';
            $result['message'] = '登录失败';
        }

        echo json_encode($result);
    }

}

