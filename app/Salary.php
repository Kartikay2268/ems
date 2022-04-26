<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = [
        'empId',
        'fixed',
        'variable',
        'ctc'
    ];

    private function validate($data) {
        if(empty($data)) {
            throw new \Exception("Invalid Parameters Passed");
        }
    }

    public static function addSalary($data) {
        (new self())->validate($data);

        return self::create($data);
    }

    public static function editSalary($data, $id) {
        (new self())->validate($data);

        $salary = self::find($id);

        if($data['fixed'] != $salary->fixed) {
            $salary->fixed = $data['fixed'];
        }
        if($data['variable'] != $salary->variable) {
            $salary->variable = $data['variable'];
        }
        if($data['ctc'] != $salary->ctc) {
            $salary->ctc = $data['ctc'];
        }

        return $salary->save();

    }

    public static function getSalary($empId) {
        return self::where('empId', $empId)->first();
    }
}
