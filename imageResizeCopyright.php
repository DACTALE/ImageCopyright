<?php


$imgJpegPath = "content/image_jpeg.jpeg";
$imgJpgPath = "content/image_jpg.jpg";
$imgPngPath = "content/image_png.png";

$extensionArray = ["png", "jpg", "jpeg", "gif"];



/**
 * 与えられた幅をもとに、画像をリサイズ
 */
function resize.php($imagePath, $newWidth) {

    // 元画像のサイズを取得
    $origWidth = imagesx($imagePath);
    $origHeight = imagesy($imagePath);

    // 新画像幅をもとに縦横比を変えず、高さを求める
    

    // 新画像のリソースを作成
    $resizeImage = imagecreatetruecolor()

}

/**
 * コピーライト
 * @return string $imgPath
 * @return string $copyraightString
 * @return string $position left or right
 */
function generate_Copylight($imgPath, $copyrightString ,$position) {
    
    // 拡張子を取得
    $extension = pathinfo($imgPath)["extension"];
    
    // 小文字に統一
    $extension = strtolower($extension);

    // 画像読み込み
    switch ($extension) {
        case "jpeg":
        case "jpg":
            $image = imagecreatefromjpeg($imgPath);
            break;
        case "png":
            $image = imagecreatefrompng($imgPath);
            break;
        case "gif":
            $image = imagecreatefromgif($imgPath);
            break;
        default:
            throw new Exception("未対応の拡張子です");
    }

    // 左右下に文字入れするための処理
    $fontSize = 12;
    $fontPath = "fonts/Mplus1Code-Thin.ttf";
        // フォントのbbox取得
    $bbox = imagettfbbox($fontSize, 0, $fontPath, $copyrightString);
        // フォントの大きさ取得(文字数に応じて位置を調整するため)
    $textWidth = abs($bbox[2] - $bbox[0]);
    $textHeight = abs($bbox[1] - $bbox[7]);
        // 画像の大きさ取得
    $imageWidth = imagesx($image);
    $imageHeight = imagesy($image);
        // パディング
    $padding = 10;
        // 座標計算
    switch ($position) {
        case "right":
            // 右下
            $x = $imageWidth - $textWidth - $padding;
            break;

        case "left":
            // 左下
            $x = $padding;
            break;
    }

    $y = $imageHeight - $padding;
    
    // 文字入れ
    $black = imagecolorallocatealpha($image, 0, 0, 0, 64);    
    imagettftext($image, $fontSize, 0, $x, $y, $black, $fontPath, $copyrightString);

    // 画像表示
    switch ($extension) {
        case "jpeg":
        case "jpg":
            header("Content-Type: image/jpeg");
            imagejpeg($image);
            break;
        case "png":
            header("Content-Type: image/png");
            imagepng($image);
            break;
        case "gif":
            header("Content-Type: image/gif");
            imagegif($image);
            break;
    }
    
    imagedestroy($image);
}

try {
    generate_Copylight($imgPngPath, "@copyright", "left");
} catch (Exception $e) {
    echo "エラー: " . htmlspecialchars($e->getMessage());
}

/**
 * リサイズとコピーライトをやる
 */






 
// サイジング
// case const extension
// 拡張子全部