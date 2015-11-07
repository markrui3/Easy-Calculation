<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display('index');
    }
    public function test(){
        $a1 = $this->generateDivide(10);
        $a2 = $this->generateMultiply(10);

        $result = array_merge($a1,$a2);
        echo json_encode($result);
    }
    
    private function generateAdd($range){
        $firstNum = mt_rand(0,$range);
        $secondNum = mt_rand(0,$range);
        $question = strval($firstNum) . "+" . strval($secondNum);
        $answer = $firstNum + $secondNum; 
        $result = array($question => $answer);

        return $result;
    }

    private function generateMinus($range){
        $firstNum = mt_rand(0,$range);
        $secondNum = mt_rand(0,$range);
        $question = strval($firstNum) . "-" . strval($secondNum);
        $answer = $firstNum - $secondNum; 
        $result = array($question => $answer);

        return $result;
    }

    private function generateMultiply($range){
        $firstNum = mt_rand(0,$range);
        $secondNum = mt_rand(0,$range);
        $question = strval($firstNum) . "*" . strval($secondNum);
        $answer = $firstNum * $secondNum; 
        $result = array($question => $answer);

        return $result;
    }

    private function generateDivide($range){
        $firstNum = mt_rand(0,$range);
        $secondNum = mt_rand(0,$range);
        $question = strval($firstNum) . "/" . strval($secondNum);
        $answer = $firstNum / $secondNum; 
        $result = array($question => $answer);

        return $result;
    }


}
