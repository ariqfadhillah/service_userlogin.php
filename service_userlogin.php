    <?php   
        $conn = new mysqli('localhost', 'root', '');  
        mysqli_select_db($conn, 'servicedb');  
        /*Di sini kami memberikan nama server sebagai ‘localhost’, nama pengguna sebagai ‘root’, kata sandi menjadi kosong (’’), dan kami memberikan nama database sebagai ‘servicedb’.*/
        /*untuk yang diatas ini adalah sekarang kita membuat koneksi server MySQL dari phpfile, jadi lewati nama server, nama pengguna, kata sandi, nama basis data dll. */

        if (isset($_GET['username']) && $_GET['username'] != '' &&isset($_GET['password']) && $_GET['password'] != '')   
        {  
           /* untuk yang diatas ini adalah perkodisian(apabila)
            ada username dan password yang diisi akan memunculkan yang diabwah ini*/

            $email = $_GET['username'];  
            $password = $_GET['password'];   
            
            $getData = "SELECT `ur_Id`,`ur_username`,`ur_password` FROM `tbl_user` WHERE `ur_username`='" .$email."'  
            and `ur_password`='".$password."'";  
      
            $result = mysqli_query($conn,$getData);  
          //  disini berisi var result yang isina query mysql (dari parameter con dan getData)
            $userId="";  

            while( $r = mysqli_fetch_row($result))  
            {  
                $userId=$r[0];  
            }  
      
            if ($result->num_rows> 0 ){  
      
                $resp["status"] = "1";  
                $resp["userid"] = $userId;  
                $resp["message"] = "Login successfully";  
            }  
            else{  
                $resp["status"] = "-2";  
                $resp["message"] = "Enter correct username or password";  
            }  
      
        }  
        else{  
            $resp["status"] = "-2";  
            $resp["message"] = "Enter Correct username.";        
            }  
      
        header('content-type: application/json');  
      
        $response["response"]=$resp;  
        echo json_encode($response);  
      
        @mysqli_close($conn);  
      
    ?>  