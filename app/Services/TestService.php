<?php
/**
 * Created by PhpStorm.
 * User: elick
 * Date: 2016/3/29
 * Time: 18:12
 */
namespace App\Services;

use App\Contracts\TestContract;

class TestService implements TestContract{
    public function callMe($controller)
    {
        // TODO: Implement callMe() method.
        dd('Call Me From TestServiceProvider In '.$controller);
    }
}