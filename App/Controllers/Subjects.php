<?php


namespace App\Controllers;

use App\Models\AdmittedAdjournedM;
use Core\Controller;
use Core\View;

class Subjects extends Controller {

    public function byLevel()
    {
        $year = $this->route_params['year'];
        $current_year = $_GET['current_year'];
        $level = $_GET['level'];
        $dataByGender = AdmittedAdjournedM::byGender($year, $current_year, $level);
        die(var_dump($this->refactor_data($dataByGender)));
//        $dataByCity = AdmittedAdjournedM::byCity($year, $current_year, $level);
  //      $dataByNationality = AdmittedAdjournedM::ByNationality($year, $current_year, $level);
    }


    private function refactor_data($data)
    {
        $refactored_data = [];
        foreach ($data as $d) {
            $keys = array_keys($d);

            //echo $d[$keys[1]] . "<br>";
            $refactored_data[$d[$keys[0]]] = empty($refactored_data[$d[$keys[0]]]) ? [
                "Admis" => "0",
                "Ajourné" => "0",
            ] : $refactored_data[$d[$keys[0]]];
            $refactored_data[$d[$keys[0]]][$d[$keys[1]]] = $d[$keys[2]];

        }
        return $refactored_data;
    }
}