<?php
namespace Components;

/**
 * Запись в файл
 * Class Writefile
 * @package Components
 */
class WriteReadfile
{

    const DIRFILES = "ExtFiles";
    const EXE = 'txt';
    public $fileName = 'temp';


    /**
     * Чтение из файла, работа с кодировой
     * @param $name
     * @return bool|string
     */
    public function readDara($name)
    {
        $file = ROOTPATH.DIRECTORY_SEPARATOR.self::DIRFILES.DIRECTORY_SEPARATOR.$name.".".self::EXE;
        if (file_exists($file)) {
            $t = file_get_contents($file);
            $get  = mb_detect_encoding($t, ['utf-8', 'cp1251']);
            return iconv($get,'UTF-8',$t);
        }
        return FALSE;
    }

    /**
     * Метод записи в файл
     * @param $data
     * @param string $type   write - перезапись |reWrite - запись
     */
    public function writeData($data,$writeKey='rewrite')
    {
        if ($writeKey=='write') {
            $flag = FILE_APPEND | LOCK_EX ;
        }
        if ($writeKey=='rewrite') {
            $flag = 0;
        }
        file_put_contents(ROOTPATH.DIRECTORY_SEPARATOR.self::DIRFILES.DIRECTORY_SEPARATOR.$this->fileName.".".self::EXE,$data,$flag );
    }

    /**
     * Распаковываем и записываем одномерный массив
     * @param $input
     * @return bool
     */
    public function writeSingleArray($input)
    {
        if (is_array($input)) {
            $i=0;
            foreach ($input as $data) {
                if ($i==0) {
                    $key = 'rewrite';
                } else {
                    $key = 'write';
                }
                $i++;

                $data .= "\n";

                $this->writeData($data,$key);
            }
        }
        return FALSE;
    }

}