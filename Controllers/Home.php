<?php
namespace Controllers;
use App;
use \App\Controller;
use Components\Rul;
use Components\WriteReadfile;

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
    const MESSAGE_ONE = 'менее 10 вариантов'; //сообщение при минимальном количестве вариантов

    /**
     * Точка входа расчетов
     * @return string
     */
    public function index ()
    {
        if ($this->setCount()) {
            return $this->render('result',$this->writeMessage($this->getCount()));
        } else {
            return $this->render('form');
        }
    }

    /**
     * Читаем файл
     * @param $name
     * @return bool|string
     */
    public function file($name)
    {
        if (preg_match('/^[0-9a-zA-Z]{1,20}$/',$name)) {
            $wf = new WriteReadfile();
            return $this->render('open_file',['text'=>$wf->readDara($name)]);
        }
        return FALSE;
    }

    /**
     * Метод записи
     * @param $input
     * @return array|bool
     */
    public function writeMessage($input)
    {
        if (is_array($input)) {
            $count = count($input);
            $wf = new WriteReadfile();
            if (count($input)<=self::MIN_COUNT) {
                $msg = self::MESSAGE_ONE;
                $wf->writeData(self::MESSAGE_ONE);
            } else {
                $msg  = 'Запись успешно проведена!';
                $wf->writeSingleArray($input);
            }
            return ['msg'=>$msg,'filename'=>$wf->fileName,'count'=>$count];

        }
        return FALSE;
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