<?php
   // $file = $_FILES['file-0'];
   session_start();
   $success = TRUE;
   $uID = $_SESSION['id']; //can already see some weird exploits lol
   $dir = "C:/xampp/htdocs/CapturePinasWPTeamMonday/images/userimages/";

   // echo $qty . " < - > " . $pID;
   // $target = $dir . basename($file["name"]);
   $uploadOk = 1;
   // $imageFileType = pathinfo($target, PATHINFO_EXTENSION);
   $ftype = "";
   $remarks = "Remarks:\n";
   
   // if (move_uploaded_file($file["tmp_name"], $target)) {
   //    // echo "The file ". basename($file["name"]). " has been uploaded.";
   // } else {
   //    // echo "Sorry, there was an error uploading your file.";
   // }

      //Check if file is actually an image
      $file = $_FILES['file-0'];
      $target = $dir . basename($file['name']);
      $imageFileType = "";
      $imageFileType = strtolower(pathinfo($target, PATHINFO_EXTENSION));
      
      $target = $dir ."u" .$uID ."." .$imageFileType;
      $check = getimagesize($file['tmp_name']);
      $remarks .= $file['name'];
      if($check !== FALSE)    
         //echo "file is an image"
         $uploadOk = 1;
      else
      {
         //echo "file is not an image"
         $remarks .= " - is not an image";
         $uploadOk = 0;
      }

      // Check file size (in bytes) if its too large
      if ($file["size"] > 5000000) //500000 bytes is 0.5MB btw. new: boosted higher to 5MB
      {
         //   echo "Sorry, your file is too large.";
         $remarks .= " - is too large (5MB limit)";
         $uploadOk = 0;
      }
      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) 
      {
         // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
         $remarks .= " - is not a JPG, JPEG, PNG, GIF file";
         $uploadOk = 0;
      }
      
      if($uploadOk == 0)
      {
         $success = FALSE;
      }
      else
      {
         move_uploaded_file($file["tmp_name"], $target); 
         $ftype = $imageFileType;
         $remarks .= " - OK";
      }
      $remarks .= "\n";
   
   $echoitems = array(); //0 is the message, 1 is the number of successful file uploads

   // if($success)
   // {
   //    array_push($echoitems, "All files uploaded successfully!");
   //    array_push($echoitems, $items);
   //    array_push($echoitems, $ftype); //this is the filetype;
   //    echo json_encode($echoitems);
   // }
   // else
   // {
   //    array_push($echoitems, "Sorry, one or more files failed to upload:\n" .$remarks);
   //    array_push($echoitems, $items);
   //    array_push($echoitems, $ftype); //this is the filetype;
   //    echo json_encode($echoitems);
   // }

      echo (string)$ftype;
   

   // echo json_encode($file) . " " . $qty;
   
   // Check if image file is a actual image or fake image
   // if(isset($_POST["submit"])) {
   //  $check = getimagesize($_FILES["img"]["tmp_name"]);
   //  if($check !== false) {
   //      echo "File is an image - " . $check["mime"] . ".";
   //      $uploadOk = 1;
   //  } else {
   //      echo "File is not an image.";
   //      $uploadOk = 0;
   //  }
   // }

?>