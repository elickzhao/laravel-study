{{ $name }}, 这是模版里的测试
<br>
<img src="{{$message->embed($imagePath)}}">
//这个是storage::get 取出的文件二进制形式 下面embedData对其渲染还原成图片
<img src="{{$message->embedData($image,'LaravelAcademy.jpg')}}">