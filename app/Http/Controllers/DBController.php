<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class DBController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $user = DB::select('select * from users WHERE id = ?',[1]);
        dump($user);
        $user = DB::select('select * from users WHERE id = :dd',[':dd'=>2]);
        dump($user);
        return 'ok';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        DB::insert('insert into users (id,name,email,password) VALUE (?,?,?,?)',[1,'laravel','x@t.com','123']);
        DB::insert('insert into users(id,name,email,password) VALUE (?,?,?,?)',[2,'elick','xx@tom.com','123']);
        return 'ok';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //说是回滚 可是并没有  看来还是需要数据库支持
        DB::transaction(function () {
            //DB::table('users')->update(['id' => 4])->where(['id'=>2]);
            $deleted = DB::table('users')->delete(2);
            DB::update('update users set name="xwiwi" WHERE name=?',['laravel']);
            echo $deleted;
        });
        echo 'ok';
//        $deleted = DB::delete('delete from users');
//        echo $deleted;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $affected = DB::update('update users set name="xwiwi" WHERE name=?',['elick']);
        return $affected;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
