<?php
/**
 * Created by PhpStorm.
 * User: klayman
 * Date: 7/4/16
 * Time: 4:33 PM
 */
require_once __DIR__ . '/JsonMapper.php';
class Test
{
    public $lol;

    public function __construct($val)
    {
        $this->lol = $val;
    }

    public function getLol()
    {
        return $this->lol;
    }
}


class Serializator implements JsonSerializable
{
    public
        $label = "label",
        $data = null,
        $field = null;

    public function __construct() {
        $this->data = new DateTime();
        $this->field = new Test(42);
    }


    function jsonSerialize()
    {
        return [
            'type' => $this->label,
            'date' => $this->data->format(DateTime::ISO8601),
            'field' => $this->field,
        ];
    }

}

$my_json = json_encode(new Serializator());

$decoded_json = json_decode($my_json);

$mapper = new JsonMapper();
$serialization = $mapper->map($decoded_json, new Serializator());

$test = new Test(42);
$test->getLol();

var_dump($serialization->field->lol);

#$lol = $serialization->field->getLol();

echo json_encode(new Serializator()) . "\n";
#echo "\n";

var_dump(json_decode(json_encode(new Serializator())));