<?php
namespace Controllers;
use App;
use \App\Controller;
use Components\Rul;

/**
 * Дефолтный контроллер
 * Class Home
 * @package Controllers
 */
class Home extends Controller
{

    public $fieldsCount;    //количество ячеек
    public $chipCount;      //количество фишек

    const MIN_COUNT = 10;   //минмальное количество вариантов
    const MESSAGE_ONE = ''; //сообщение при минимальном количестве вариантов

    /**
     * Точка входа расчетов
     * @return string
     */
    public function index ()
    {
        if ($this->setCount()) {
                $array =$this->getCount();
                $countArray = count($array);

            return $this->render('result',['post'=>$array]);
        } else {
            return $this->render('form');
        }
    }

    /**
     * Валидация входящих значений
     * @return bool
     */
    public function setCount()
    {
        if ($_POST) {
            $fieldsCount    = (int)$_POST['fieldsCount'];
            $chipCount      = (int)$_POST['chipCount'];
            if (is_numeric($fieldsCount) && is_numeric($chipCount) && $fieldsCount>0 && $chipCount>0 ) {
                $this->fieldsCount = $fieldsCount;
                $this->chipCount = $chipCount;
                return TRUE;
            }
        }
        return FALSE;
    }


    /**
     * Получения количества вхождений и массива вариантов
     * @return array
     */
    public function getCount()
    {
        $out = ['error'=>TRUE];
        if (($this->chipCount > $this->fieldsCount) || ($this->chipCount==$this->fieldsCount)) {
            $out = [
                'error'=>FALSE,
                'type'=>'one',
                'message'=>static::MESSAGE_ONE,
            ];
        } else {
            $obj = new Rul($this->fieldsCount,$this->chipCount);
            return $obj->getResult();
        }

        return $out;
    }

}