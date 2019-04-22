<?php
namespace Duohao\Helpers;

class ObjectHelper
{

    /**
     * 用数组批量制造对象，需要指定key
     *
     *@param string $array
     * @param array  $objectKeys = ['key','tab']
     *@return  array
     */
    public static function generateObjectArray(array $array, array $objectKeys): array
    {
        $keyProperty = $objectKeys[0];
        $valueProperty = $objectKeys[1];

        $return = [];
        if (!empty($array)) {
            foreach ($array as $key => $value) {
                $stdClass = new \stdClass();
                $stdClass->{$keyProperty} = $key;
                $stdClass->{$valueProperty} = $value;
                array_push($return, $stdClass);
            }
        }
        return $return;
    }

    /**
     * 数组转对象
     * @param $array = [['title'=>'单数','amount'=>'金额']]
     * @return void
     */
    public static function arrayToObjectsList(array $array): array
    {
        $return = [];
        if (!empty($array)) {
            foreach ($array as $key => $childArray) {
                $stdClass = new \stdClass();
                foreach ($childArray as $objKey => $objValue) {
                    $stdClass->{$objKey} = $objValue;
                }
                array_push($return, $stdClass);
            }
        }
        return $return;
    }

}
