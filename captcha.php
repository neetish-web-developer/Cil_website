<?php
session_start();

// CAPTCHA settings
$captcha_length = 5;
// ONLY using uppercase and numbers
$characters = '123456789ABCDEFGHJKLMNPQRSTUVWXYZ'; 
$font_path = './arial.ttf'; // Specify a path to a true-type font file (e.g., 'arial.ttf')
$image_width = 150;
$image_height = 50;

// Generate random CAPTCHA string
$captcha_string = '';
for ($i = 0; $i < $captcha_length; $i++) {
    $captcha_string .= $characters[rand(0, strlen($characters) - 1)];
}

// Store the CASE-SENSITIVE captcha string in a session variable
$_SESSION['captcha_code'] = $captcha_string;

// Create image
$image = imagecreate($image_width, $image_height);
$background_color = imagecolorallocate($image, 255, 255, 255); // White background   
$text_color = imagecolorallocate($image, 0, 0, 0); // Black text
$line_color = imagecolorallocate($image, 200, 200, 200); // Light gray lines

// Add some random lines and dots for noise
for ($i = 0; $i < 5; $i++) {
    imageline($image, 0, rand() % $image_height, $image_width, rand() % $image_height, $line_color);
}
for ($i = 0; $i < 500; $i++) {
    imagesetpixel($image, rand() % $image_width, rand() % $image_height, $line_color);
}

// Add the CAPTCHA text to the image
$font_size = 20;
$angle = 0;
$x = 10;
$y = $image_height / 2 + $font_size / 2;

// Check if font file exists, otherwise use imagestring (less appealing but standard)
if (file_exists($font_path)) {
    // Use TrueType font with random angles for better security
    imagettftext($image, $font_size, rand(-5, 5), $x, $y, $text_color, $font_path, $captcha_string);
} else {
    // Fallback if font is not found
    imagestring($image, 5, $x, $image_height/3, $captcha_string, $text_color);
}


// Output the image
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
?>