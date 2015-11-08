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
    
    public function getExamList(){
        $student_id= I('param.student_id');
        $Dao1 = M('stu_exam');
        $stu_exam_list = $Dao1->where("student_id=$student_id")->select();
        $data = array();
        foreach($stu_exam_list as $stu_exam){
            $exam_id = $stu_exam['exam_id'];
            $Dao2 = M('exam');
            $r = $Dao2->where("exam_id=$exam_id AND status='finished'")->select();
            if(empty($r))
                continue;
            $r = $r[0];
            $d = array();
            $d['exam_id'] = $r['exam_id'];
            $d['name'] = $r['name'];
            $d['spend_time'] = $r['spend_time'];
            $d['time_spent'] = $stu_exam['time_spent'];
            $d['score'] = $stu_exam['score'];
            array_push($data,$d);
        }

        echo json_encode($data);
    }

    public function getProcessingExam(){
        $student_id= I('param.student_id');
        $Dao1 = M('stu_exam');
        $stu_exam_list = $Dao1->where("student_id=$student_id")->select();
        $data = array();
        foreach($stu_exam_list as $stu_exam){
            $exam_id = $stu_exam['exam_id'];
            $Dao2 = M('exam');
            $r = $Dao2->where("exam_id=$exam_id AND status='processing'")->select();
            if(empty($r))
                continue;
            $r = $r[0];
            $d = array();
            $d['exam_id'] = $r['exam_id'];
            $d['name'] = $r['name'];
            $d['spend_time'] = $r['spend_time'];
            array_push($data,$d);
        }

        echo json_encode($data);
    }

    public function toDoExam(){
        $exam_id = I('param.exam_id');
        $Dao = M('exam');
        $question_id = $Dao->where("exam_id=$exam_id")->getField("question_id");

        $result['message'] = 'get question_id';
        $result['question_id'] = $question_id;

        echo json_encode($result);
    }

    public function submitExam(){
        $exam_id = I('param.exam_id');
        $student_id = I('param.student_id');
        $score = I('param.score');
        $Dao = M('stu_exam');
        $Dao->score = $score;
        $result['status'] = $Dao->where("exam_id=$exam_id AND student_id=$student_id")->save();
        $result['message'] = 'submit exam-score';

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

