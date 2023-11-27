<?php

namespace number\gen\Controller;

use number\gen\App\AbstractController;
use number\gen\App\Dispatcher;
use number\gen\Form\DiceForm;

class DiceController extends AbstractController
{
    public function displayDice()
    {
        if (isset($_POST['submit'])) {
            $datas = [
                'D4' => $_POST["D4"],
                'D6' => $_POST["D6"],
                'D8' => $_POST["D8"],
                'D10' => $_POST["D10"],
                'D12' => $_POST["D12"],
                'D20' => $_POST["D20"]
            ];
            $result = $this->calculDice($datas);
            $this->render('dice.php', ['form' => DiceForm::DiceForm(Dispatcher::generateUrl("DiceController", 'displayDice')), 'result' => $result]);
        } else {
            $this->render('dice.php', ['form' => DiceForm::DiceForm(Dispatcher::generateUrl("DiceController", 'displayDice')), 'result' => null]);
            return;
        }
    }
    public function calculDice($datas)
    {
        foreach ($datas as $key => $value) {

            if ($key === "D4") {
                $result = ($value * rand(1, 4));
            }
            if ($key === "D6") {
                $result = $result + ($value * rand(1, 6));
            }
            if ($key === "D8") {
                $result = $result + ($value * rand(1, 8));
            }
            if ($key === "D10") {
                $result = $result + ($value * rand(1, 10));
            }
            if ($key === "D12") {
                $result = $result + ($value * rand(1, 12));
            }
            if ($key === "D20") {
                $result = $result + ($value * rand(1, 20));
            }
        }
        return $result;
    }
}
