<?php
/**
 * Created by PhpStorm.
 * User: elick
 * Date: 2016/4/1
 * Time: 18:17
 */
namespace Jai\Contact\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Config;
use Jai\Contact\Models\Test;
use View;

class ContactController extends Controller{
    public function index(){
        echo __DIR__.'/../../config';
        echo "<br>";
        echo realpath(__DIR__.'/../../config');
        echo "<br>";
        echo "这就是realpath()的区别";

        $t = Test::all()->toArray();
        dump($t);


        $posts = Post::all()->toArray();
        dump($posts);
        dump(Config::get('contact.message'));
        return view('contact::contact');
        //eturn View::make('contact::contact');
    }
}