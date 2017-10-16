<?php

   // $file = $_FILES['file-0'];
   $success = TRUE;
   $qty = $_POST['qty'];
   $pID= (int)$_POST['pid'];
   $dir = "C:/xampp/htdocs/CapturePinasWPTeamMonday/images/postimages/";

   // echo $qty . " < - > " . $pID;
   // $target = $dir . basename($file["name"]);
   $uploadOk = 1;
   // $imageFileType = pathinfo($target, PATHINFO_EXTENSION);
   $ftypeToJSON = array();
   $remarks = "Remarks:\n";
   
   $items = 0; //items actually uploaded

   // if (move_uploaded_file($file["tmp_name"], $target)) {
   //    // echo "The file ". basename($file["name"]). " has been uploaded.";
   // } else {
   //    // echo "Sorry, there was an error uploading your file.";
   // }

   for($it = 0; $it < $qty; $it++) //it can be used as <postid>img<X>
   {
      //Check if file is actually an image
      $file = $_FILES['file-' . $it];
      $target = $dir . basename($file['name']);
      $imageFileType = pathinfo($target, PATHINFO_EXTENSION);
      $ftype = $imageFileType;
      $target = $dir .$pID ."img" .($items +1) ."." .$imageFileType;
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
      // Check if file already exists
      if (file_exists($target)) 
      {
      //   echo "Sorry, file already exists.";
         $remarks .= " - already exists";
         $uploadOk = 0;
      }

      // Check file size (in bytes) if its too large
      if ($file["size"] > 500000) //500000 bytes is 0.5MB btw
      {
         //   echo "Sorry, your file is too large.";
         $remarks .= " - is too large (0.5MB limit)";
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
         $items++;

         array_push($ftypeToJSON, $ftype);
      }
      $remarks .= "\n";
   }
   $echoitems = array(); //0 is the message, 1 is the number of successful file uploads

   if($success)
   {
      array_push($echoitems, "All files uploaded successfully!");
      array_push($echoitems, $items);
      array_push($echoitems, json_encode($ftypeToJSON)); //this is the filetype;
      echo json_encode($echoitems);
   }
   else
   {
      array_push($echoitems, "Sorry, one or more files failed to upload:\n" .$remarks);
      array_push($echoitems, $items);
      array_push($echoitems, json_encode($ftypeToJSON)); //this is the filetype;
      echo json_encode($echoitems);
   }

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