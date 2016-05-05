<?php
/**
 * Created by elick.
 * Class: MakeView
 * Date: 2016/3/16
 * Time: 18:28
 * Description: Brief description
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
//引入相关类
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeView extends Command
{
    //这里特别注意 取消了 $signature 这个属性 使用$name否则下面两个方法都不好使
    //getArguments() getOptions()    //这个应该是为了防止参数过多写在这里不方便所以用两个函数
    //protected $name = 'make:view';

    protected $signature = 'make:view {name : like content or article/content} {--l|layout : create new layout}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new blade page';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'View';

    /**
     * 文件系统
     * @var Filesystem
     */
    protected $files;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //XXX 还有一点就是这里了 handle和fire有啥区别 有空看看那
        $path = $this->getPath($this->argument('name'));

        if ($this->alreadyExists($path)) {
            $this->error($this->type . ' already exists!');
            return false;
        }

        $this->makeDir($path);

        $content = $this->option('layout') ? $this->getStub() : "";

        $this->files->put($path, $content);

        return $this->info($this->type . ' created successfully.');
    }

    /**
     * Get path
     * @param string $name
     * @return string
     */
    protected function  getPath($name)
    {
        return base_path('resources/views') . "/" . $name . ".blade.php";
    }

    /**
     * 建立目录
     * @param $path
     */
    protected function makeDir($path)
    {
        if (!$this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }
    }

    /**
     * 获得模版内容
     * @param string $stub //现在默认为bootstrap风格 以后还可以添加妹子UI风格模版等等
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function getStub($stub = 'view.stub')
    {
        return $this->files->get(__DIR__ . '/stubs/' . $stub);
    }

    /**
     * 模版是否已经存在
     * @param $path
     * @return bool
     */
    protected function alreadyExists($path)
    {
        return $this->files->exists($path);
    }

//    protected function getArguments()
//    {
//        return [
//            ['name', InputArgument::REQUIRED, 'The name of the class'],
//        ];
//    }
//
//    protected function getOptions()
//    {
//        return [
//            ['layout', 'l', InputOption::VALUE_NONE, 'Create a new migration file for the model.'],
//        ];
//    }
}