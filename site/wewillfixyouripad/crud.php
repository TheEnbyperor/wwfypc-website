<?php
    date_default_timezone_set('Asia/Dhaka');

    // https://www.verot.net/php_class_upload_download.htm
    $db = mysqli_connect(SERVER_ADDRESS, USERNAME, PASSWORD, DATABASE) or die("Connection failed: " . mysqli_connect_error());
    mysqli_query($db, "SET sql_mode = ''");
    

    function db_error($query)
    {
        return '<h3 style="background:#000; color:#00d99a; font-family:fantasy; letter-spacing:2px; border:1px solid #ddd; font-weight: normal; padding:50px;">'.$query.'<br><br>'.mysqli_errno($GLOBALS['db']) . ": " . mysqli_error($GLOBALS['db']).'</h3>';
    }

    function save($table, $data)
    {
        $col        = "`".implode("`, `", array_keys($data))."`";
        $str = '';
        foreach ($data as $key => $v) {
            $str .= "'".strtr($data[$key], ["'" => "\'", '"' => '\"'])."', ";
        }
        $value = substr($str, 0,-2);

        $query = "INSERT INTO `$table` ($col) VALUES ($value)";
        $save  = mysqli_query($GLOBALS['db'], $query);

        return ($save) ? 'true' : db_error($query);
    }

    function update($table, $data, $where)
    {
        $upData = '';
        foreach ($data as $key => $v) {
            $col        = "`".$key."`";
            $upData .= $col." = '".strtr($data[$key], ["'" => "\'", '"' => '\"'])."', ";
        }

        $set = substr($upData, 0,-2);

        $query = "UPDATE `$table` SET $set WHERE $where";
        $update = mysqli_query($GLOBALS['db'], $query);

        return ($update) ? 'true' : db_error($query);
    }

    function delete($table, $where)
    {
        $query = "DELETE FROM `$table` WHERE $where";
        $update = mysqli_query($GLOBALS['db'], $query);

        return ($update) ? 'true' : db_error($query);
    }

    function read($type, $table, $where = null, $short = null, $limit = null)
    {
        $query = "SELECT * FROM `$table`";
        ($where) ? $query .= " WHERE $where" : '';
        ($short) ? $query .= " ORDER BY $short" : '';
        ($limit) ? $query .= " LIMIT $limit" : '';

        if($type == 'all')
        {
            $data = [];
            $q = mysqli_query($GLOBALS['db'], $query);
            while($r = mysqli_fetch_assoc($q)) {
                array_push($data, (object) $r);
            }
        } else {
            $data = (object) mysqli_fetch_assoc(mysqli_query($GLOBALS['db'], $query));
        }

        if(mysqli_error($GLOBALS['db']))
        {
            return db_error($query);
        }

        return $data;
    }

    function image($img, $name, $path, $size = null, $convert = null)
    {
        $file = new Upload($_FILES[$img]); 
        if($file->uploaded) {
            $file->file_new_name_body = $name;
            $file->file_auto_rename = true;

            if($convert) $file->image_convert = $convert;
            if($size) $file->image_resize = true; $file->image_x = $size[1]; $file->image_y = $size[0];

            $file->Process($path);

            if ($file->processed) {
                return $file->file_dst_name;
                // $file->Clean();
            } else {
             return 'error : ' . $file->error;
            } 
        }
    }

    function delete_img($table, $where, $path, $img)
    {
        $data = read('one', $table, $where, '', '');
        if($data)
        {
            if(file_exists($path.$data->$img)) unlink($path.$data->$img);
        }
    }

    function phpMail($to, $subject, $message, $files = null)
    {
        // require 'PHPMailer-5.2/PHPMailerAutoload.php';
        
        $mail = new PHPMailer;
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Mailer     = 'smtp';
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->SMTPAutoTLS = false;
        $mail->Username   = 'donasojib1215@gmail.com';
        $mail->Password   = 'sojib1215';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->isHTML(true);
        $mail->setFrom('mdmiton321@gmail.com', 'Miton');
        $mail->addReplyTo('mdmiton321@gmail.com', 'Miton');

        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body    = nl2br($message);
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        if($files)
        {
            // $files = explode(',', $files);
            foreach ($files as $v) {
                $mail->addAttachment($v, $v);
            }
        }

        if(!$mail->send()) {
            return 'Message could not be sent.';
            return 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            return 'Message has been sent';
        }
    }

    function send_email_html($to, $subject, $message)
    {
        // email fields: to, from, subject, and so on
        $from = "wewillfixyourpc"; 
        $headers = "From: $from";

        // boundary 
        $semi_rand = md5(time()); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

        // headers for attachment 
        $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

        // multipart boundary 
        $message = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/plain; charset=\"iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n"; 
        $message .= "--{$mime_boundary}\n";

        $ok = @mail($to, $subject, $message, $headers); 
        if ($ok) { 
            return "<p>mail sent to $e!</p>"; 
        } else { 
            return "<p>mail could not be sent!</p>"; 
        }
    }





    // $data['city']           = 'Dh"aka'; 
    // $data['state']          = 'Dhaka'; 
    // $data['zip']            = '3602'; 
    // $data['country']        = 'Bangladesh'; 
    // $data['address']        = 'Rampura", Dhaka, Bangladesh'; 
    // $data['description']    = 'Rampura, Dhaka, Banglad"esh';   

    // $save = save('location', $data);
    // if($save == 'true')
    // {
    //     echo 'Data Save Successfully...';
    // } else {
    //     echo $save;
    // }

    // $update = update('location', $data, 'id = 1');
    // if($update == 'true')
    // {
    //     echo 'Data Update Successfully...';
    // } else {
    //     echo $update;
    // }

    // $delete = delete('location', 'imd = 2');
    // if($delete == 'true')
    // {
    //     echo 'Data Delete Successfully...';
    // } else {
    //     echo $delete;
    // }

    // $read = read('all', 'location', '', '', '');
    // if(is_array($read))
    // {
    //     echo print_r($read);
    //     // foreach ($read as $key => $v) {
    //     //     echo $v['city'];
    //     // }
    // } else {
    //     echo $read;
    // }

    if(isset($_POST['submit']))
    {
        // $field = ['image', 'image2'];
        // foreach ($field as $key => $img) {
        //     $file       = $_FILES[$img]['name'];
        //     $name       = time()+($key+1).'.'.end(explode( ".", $file));
        //     $up         = move_uploaded_file($_FILES[$img]['tmp_name'], 'upload/'.$name);

        //     $data[$img] = $name;
        // }

        // $field = ['image', 'image2'];
        // foreach($field as $key => $img)
        // {
        //     $path        = 'upload';
        //     $name        = time()+($key+1);
        //     $size        = ['300', '300'];
        //     $convert     = 'png';
        //     $upload      = image($img, $name, $path);

        //     $upload         = image($img, time()+($key+1), 'upload', ['300', '300'], 'png');
        //     $data[$img]     = $upload; 
        // }

        // if(file_exists('upload/1541251151.png')) unlink('upload/1541251151.png');
    }
?>