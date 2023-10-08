<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Defaul time zone

date_default_timezone_set("Asia/Kolkata");

//connection

class database
{
    private $conn = false;
    private $myconn;
    private $result = array();
    private $numrows = 0;

    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "nfc";

    //connectiong to database

    public function connect()
    {
        if (!$this->conn) {
            $this->myconn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
            if ($this->myconn) {
                $this->conn = true;
                return true;
            } else {
                return false;
            }
        } else {

            return true;
        }
    }

    //sql query
    public function sql($query)
    {
        if ($this->conn) {
            $this->myconn->query("SET NAMES utf8mb4");
            if ($data = $this->myconn->query($query)) {
                if (isset($data->num_rows) && $data->num_rows > 0) {
                    $this->numrows = $data->num_rows;

                    while ($row = $data->fetch_assoc()) {
                        array_push($this->result, $row);
                    }
                    return true;
                } else {

                    array_push($this->result, $data);
                    $this->numrows = 0;
                    return true;
                }
            } else {

                array_push($this->result, $this->myconn->error);
                return false;
            }
        } else {

            return false;
        }
    }

    public function result()
    {
        $val = $this->result;
        $this->result = array();
        return $val;
    }

    //Getting numRows
    public function numrows()
    {
        $val = $this->numrows;
        return $val;
    }

    //xss clean
    public function clean($clean)
    {
        return $this->myconn->real_escape_string(strip_tags($clean));
    }

    public function real_escape_string($clean)
    {
        return $this->myconn->real_escape_string($clean);
    }

    // // array_escape
    public function array_escape($array)
    {
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                $data[$key] = $this->real_escape_string($value);
            }
            return $data;
        } else {
            return $this->real_escape_string($array);
        }
    }


    // array_clean
    public function array_clean($array)
    {
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                $data[$key] = $this->clean($value);
            }
            return $data;
        } else {
            return $this->clean($array);
        }
    }

    // json_clean
    public function json_clean($str)
    {
        for ($i = 0; $i <= 31; ++$i) {
            $str = str_replace(chr($i), "", $str);
        }

        $str = str_replace(chr(127), "", $str);

        // This is the most common part
        // Some file begins with 'efbbbf' to mark the beginning of the file. (binary level)
        // here we detect it and we remove it, basically it's the first 3 characters 
        if (0 === strpos(bin2hex($str), 'efbbbf')) {
            $str = substr($str, 3);
        }

        return $str;
    }


    // clean email 
    public function sanitize($field)
    {

        $field = filter_var($field, FILTER_SANITIZE_EMAIL);
        if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    // Compress image function
    public function compressImage($image_name, $tmp_image, $image_type, $path)
    {
        // echo $path;
        // exit;
        // die();

        // getting data from params
        list($width, $height) = getimagesize($tmp_image);

        if ($width > 6000 || $height > 6000) {
            // setting new height and width
            $nwidth = $width / 9;
            $nheight = $height / 9;
        } elseif ($width > 4000 || $height > 4000) {
            // setting new height and width
            $nwidth = $width / 6;
            $nheight = $height / 6;
        } elseif ($width > 2000 || $height > 2000) {
            // setting new height and width
            $nwidth = $width / 4;
            $nheight = $height / 4;
        } elseif ($width > 1000 || $height > 1000) {
            // setting new height and width
            $nwidth = $width / 2;
            $nheight = $height / 2;
        } elseif ($width > 700 || $height > 700) {
            // setting new height and width
            $nwidth = $width / 2;
            $nheight = $height / 2;
        } else {
            // setting new height and width
            $nwidth = $width / 1;
            $nheight = $height / 1;
        }

        // setting new image params
        $newimage = imagecreatetruecolor($nwidth, $nheight);

        // checking image type and executing as per type
        if ($image_type == 'image/jpeg') {
            $source = @imagecreatefromjpeg($tmp_image);
            imagecopyresized($newimage, $source, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);

            imagejpeg($newimage, $path . $image_name);
        } elseif ($image_type == 'image/png') {
            $source = @imagecreatefrompng($tmp_image);

            imagecolortransparent($newimage, imagecolorallocate($newimage, 0, 0, 0));
            imagealphablending($newimage, false);
            imagesavealpha($newimage, true);

            imagecopyresized($newimage, $source, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);

            imagepng($newimage, $path . $image_name);
        } elseif ($image_type == 'image/gif') {
            $source = @imagecreatefromgif($tmp_image);

            imagecolortransparent($newimage, imagecolorallocate($newimage, 0, 0, 0));

            imagecopyresized($newimage, $source, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);

            imagegif($newimage, $path . $image_name);
        }
    }

    // Create thumbnail image function
    public function create_thumbnail($image_name, $tmp_image, $path)
    {
        // echo "true";
        // die();
        $nwidth = 150;
        // $nheight = 250;

        // getting data from params
        list($width, $height) = getimagesize($tmp_image);

        $nheight = ceil($height * ($nwidth / $width));

        // setting new image params
        $newimage = imagecreatetruecolor($nwidth, $nheight);

        // get image type
        $img_name = explode('.', strtolower($image_name));
        $image_type = end($img_name);

        // checking image type and executing as per type
        if ($image_type == 'jpeg' || $image_type == 'jpg') {
            $source = imagecreatefromjpeg($tmp_image);
            imagecopyresized($newimage, $source, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);

            imagejpeg($newimage, $path . $image_name);
        } elseif ($image_type == 'png') {
            $source = imagecreatefrompng($tmp_image);

            imagecolortransparent($newimage, imagecolorallocate($newimage, 0, 0, 0));
            imagealphablending($newimage, false);
            imagesavealpha($newimage, true);

            imagecopyresized($newimage, $source, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);

            imagepng($newimage, $path . $image_name);
        } elseif ($image_type == 'gif') {
            $source = imagecreatefromgif($tmp_image);

            imagecolortransparent($newimage, imagecolorallocate($newimage, 0, 0, 0));

            imagecopyresized($newimage, $source, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);

            imagegif($newimage, $path . $image_name);
        } else {
            $source = imagecreatefromjpeg($tmp_image);
            imagecopyresized($newimage, $source, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);

            imagejpeg($newimage, $path . $image_name);
        }

        // imagedestroy($newimage);
    }

    public function sendEmail($to, $subject, $message, $headers = '')
    {
        // Add any additional headers if needed


        // Set the content type for HTML emails
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";

        // Send the email
        $success = mail($to, $subject, $message, $headers);


        // Check if the email was sent successfully
        if ($success) {
            return true;
        } else {
            return false;
        }
    }
    public function send_email($to, $subject, $message)
    {
        //Create an instance; passing `true` enables exceptions

        $mail = new PHPMailer(true);

        try {
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host       = 'mail.febblespot.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'noreply@febblespot.com';
            $mail->Password   = 'Febble@ut?5655';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 465;

            //Recipients
            $mail->setFrom('noreply@febblespot.com', 'Febble Spot');

            $mail->addAddress($to);

            $mail->addReplyTo('noreply@febblespot.com', 'No-Reply');

            // Content

            $mail->isHTML(true);  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;

            if ($mail->send()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    function getPassCode($x)
    {
        return substr(str_shuffle("0123456789"), 0, $x);
    }

    // sorting function 
    function make_comparer()
    {
        // Normalize criteria up front so that the comparer finds everything tidy
        $criteria = func_get_args();
        foreach ($criteria as $index => $criterion) {
            $criteria[$index] = is_array($criterion)
                ? array_pad($criterion, 3, null)
                : array($criterion, SORT_ASC, null);
        }

        return function ($first, $second) use (&$criteria) {
            foreach ($criteria as $criterion) {
                // How will we compare this round?
                list($column, $sortOrder, $projection) = $criterion;
                $sortOrder = $sortOrder === SORT_DESC ? -1 : 1;

                // If a projection was defined project the values now
                if ($projection) {
                    $lhs = call_user_func($projection, $first[$column]);
                    $rhs = call_user_func($projection, $second[$column]);
                } else {
                    $lhs = $first[$column];
                    $rhs = $second[$column];
                }

                // Do the actual comparison; do not return if equal
                if ($lhs < $rhs) {
                    return -1 * $sortOrder;
                } else if ($lhs > $rhs) {
                    return 1 * $sortOrder;
                }
            }

            return 0; // tiebreakers exhausted, so $first == $second
        };
    }

    // format file size 
    function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    // create directory if not present
    public function create_path($path)
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        return $path;
    }

    // disconnect to database 
    public function disconnect()
    {
        if ($this->conn) {
            $this->myconn->close();
            $this->conn = false;
            return true;
        } else {
            return true;
        }
    }
}
