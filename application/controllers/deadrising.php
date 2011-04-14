<?php
class DeadRising extends CI_Controller {
  /**
   * $autoload['libraries'] = array('form');
   * $autoload['helper'] = array('form', 'html', 'url');
   **/
  // クラス定数
  const title = "『デッドライジング』おばさんジェネレーター";
  const description = "OP に登場するおばさんが嘆く画像を生成します";
  
  function index() {
    $data['title'] = self::title;
    $data['description'] = self::description;
    $data['subtitle'] = "入力画面";
    
    $default_value = '『デッドライジング2』ひどかったね';
    $data = $this->form->make_form_input_data($data, $default_value);
    
    $this->load->view('deadrising_index', $data);
  }
  
  function generate() {
    $data['title'] = self::title;
    $data['description'] = self::description;
    $data['subtitle'] = "出力画面";
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      // テキストフォームから呼び出された場合の処理
      $grief = $_POST['grief'];
    }else{
      // ブラウザから直接値を渡された場合の処理
      if($this->uri->segment(3)) {
//        echo $this->uri->segment(3);  // debug
      }
      // この値を使ってデータベースから文字列を取得
      /// 見つからなければエラーメッセージ「この URL は無効です。」とか。
    }
    
    $data = $this->form->make_form_input_data($data, $grief);
    
    $this->load->library('imagegenerate');
//    $this->imagegenerate->hoge();
    
    //文字サイズ
    // $size = $_GET["s"];
    $size = 24;
//    if(empty($size)) $size = 20;
    
    //画像ファイルの読み込み。
    $image = ImageCreateFromJPEG("images/origin.jpg");
    
    //フォントファイルへのパス
    $font = "system/fonts/ipagp-mona.ttf";
    
    //文字色の設定
    $txtcolor = ImageColorAllocate($image, 200, 200, 255);
    
    //角度
    $r = 0;
    
    //画像サイズを取得
    $width = ImageSx($image);  // 横幅
    $height = ImageSy($image);  // 縦幅
    
    //書き込む座標を設定する
    $bounding_box = ImageTTFbBox($size, $r, $font, $grief);
    $ltext = $bounding_box[0] + $bounding_box[2]; // 書きこむ文字列の横幅
    
    $x = ($width - $ltext) / 2;
    $y = $height - 14;
    
    //画像に文字列を書き込む
    ImageTTFText($image, $size, $r, $x, $y, $txtcolor, $font, $grief);
    
    //ImageJPEG($im);  //画像表示
    ImageJPEG($image, "images/output.jpg");  //画像ファイル出力
    ImageDestroy($image);

    $this->load->view('deadrising_generate', $data);
  }
}
?>
