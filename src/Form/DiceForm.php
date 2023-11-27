<?php

namespace number\gen\Form;

use number\gen\App\Dispatcher;

class DiceForm
{
    public static function diceForm($action)
    {
        $form =  "<form action='$action' method='POST'>
        <label for='D4'>D4</label>
        <input type='number' name='D4' id='D4' value ='0'>
        <label for='D6'>D6</label>
        <input type='number' name='D6' id='D6' value ='0'>
        <label for='D8'>D8</label>
        <input type='number' name='D8' id='D8' value ='0'>
        <label for='D10'>D10</label>
        <input type='number' name='D10' id='D10' value ='0'>
        <label for='D12'>D12</label>
        <input type='number' name='D12' id='D12' value ='0'>
        <label for='D20'>D20</label>
        <input type='number' name='D20' id='D20' value ='0'>
        <button type='submit' name ='submit' >Lancer les dés</button>
    </form>";
        return $form;
    }
}
