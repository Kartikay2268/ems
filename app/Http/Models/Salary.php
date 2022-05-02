<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = [
        'empId',
        'fixed',
        'variable',
        'ctc'
    ];

    private function validate($data)
    {
        if (empty($data)) {
            throw new \Exception("Invalid Parameters Passed");
        }
    }

    public static function addSalary($salaryInfo)
    {
        (new self())->validate($salaryInfo);

        return self::create($salaryInfo);
    }

    public static function editSalary($salaryInfo, $id)
    {
        (new self())->validate($salaryInfo);

        $salary = self::find($id);

        if ($salaryInfo['fixed'] != $salary->fixed) {
            $salary->fixed = $salaryInfo['fixed'];
        }
        if ($salaryInfo['variable'] != $salary->variable) {
            $salary->variable = $salaryInfo['variable'];
        }
        if ($salaryInfo['ctc'] != $salary->ctc) {
            $salary->ctc = $salaryInfo['ctc'];
        }

        return $salary->save();

    }

    public static function getSalary($empId)
    {
        return self::where('empId', $empId)->first();
    }
}
