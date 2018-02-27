<?php
namespace Components;


/**
 * Рассчет возможных вариантов заполнения
 * Class Rul
 * @package Components
 *
 * @property integer $fieldsCount количество ячеек
 * @property integer $chipCount количество фишек
 */
class Rul
{
    /**
     * Предполагается что $fieldsCount > $chipCount всегда
     * @var
     */
    public $fieldsCount;
    public $chipCount;


    /**
     * Инициализируем класс
     * Rul constructor.
     * @param $fieldsCount
     * @param $chipCount
     */
    public function __construct($fieldsCount,$chipCount)
    {
        $this->setParams($fieldsCount,$chipCount);
    }


    /**
     * Сеттер параметров
     * @param $fieldsCount
     * @param $chipCount
     */
    public function setParams($fieldsCount,$chipCount)
    {
        $this->fieldsCount = $fieldsCount;
        $this->chipCount = $chipCount;
    }


    /**
     * Вернет строку заполненную $v единичками
     * @param $v
     * @return string
     */
    public function getCountText($v)
    {
        $lengh='1';
        for($i=1;$i<$v;$i++){
            $lengh .= '1';
        }
        return $lengh;
    }

    /**
     * Достраивает недостатющие нулю
     * @param $v двоичное число
     * @return string
     */
    public function setMarkDown($v,$count){
        if (strlen($v)<$count) {
            for($i=strlen($v);$i<$count;$i++) {
                $v = '0'.$v;
            }
        }
        return $v;
    }

    /**
     * Получаем массив комбинаций
     * @return array
     */
    public function getResult()
    {
        if ($this->chipCount < $this->fieldsCount) {
            $count =[];
            $vChipCount  = $this->chipCount;
            $vFieldsCount = bindec($this->getCountText($this->fieldsCount));
            for ($i=$this->chipCount+1; $i<=$vFieldsCount;$i++ ) {
                if (substr_count(decbin($i),1) == $vChipCount) {
                    $count[] = $this->setMarkDown(decbin($i),$this->fieldsCount);
                }
            }
            return $count;
        }
        return FALSE;
    }
}