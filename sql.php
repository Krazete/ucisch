<?php
    $db=mysqli_connect("mysql4.000webhost.com","a1446341_Krazete","rhaimi5","a1446341_UCISch");
    if(mysqli_connect_errno()){
        error("[CNXN] ".mysqli_connect_error());
    }
    
    if(mysqli_num_rows(mysqli_query($db,"SHOW TABLES LIKE '".$name."'"))==1){
        $exists=1;
    }
    else{
        $exists=0;
    }

    if($OP==0){
        if($exists==1){
            $qry="
            DROP TABLE $name
            ";
            mysqli_query($db,$qry);
            error("[NOTREALLYANERROR] Your data has been overwritten.");
        }
        $qry="
        CREATE TABLE $name (Code INT,Subject CHAR(10),Class CHAR(5),Type CHAR(5),Days CHAR(10),Building CHAR(5),Room CHAR(5),AesSubject CHAR(50),AesType CHAR(30),AesBuilding CHAR(50),RTime0 INT,RTime1 INT,AesTime CHAR(25),End INT)
        ";
        mysqli_query($db,$qry);
        for($i=0;$i<$end;$i++){
            $qry="
            INSERT INTO $name (Code,Subject,Class,Type,Days,Building,Room,AesSubject,AesType,AesBuilding,RTime0,RTime1,AesTime,End)
            VALUES ('$code[$i]','$subject[$i]','$class[$i]','$type[$i]','$days[$i]','$building[$i]','$room[$i]','$aessubject[$i]','$aestype[$i]','$aesbuilding[$i]',".$rtime[$i][0].",".$rtime[$i][1].",'$aestime[$i]',$end)
            ";
            mysqli_query($db,$qry);
        }
    }
    
    else if($OP==1){
        if($exists==1){
            $user=mysqli_query($db,"SELECT * FROM $name");
            $i=0;
            while($row=mysqli_fetch_array($user)) {
                $code[$i]=$row["Code"];
                $subject[$i]=$row["Subject"];
                $class[$i]=$row["Class"];
                $type[$i]=$row["Type"];
                $days[$i]=$row["Days"];
                $building[$i]=$row["Building"];
                $room[$i]=$row["Room"];
                $aessubject[$i]=$row["AesSubject"];
                $aestype[$i]=$row["AesType"];
                $aesbuilding[$i]=$row["AesBuilding"];
                $rtime[$i][0]=$row["RTime0"];
                $rtime[$i][1]=$row["RTime1"];
                $aestime[$i]=$row["AesTime"];
                $end=$row["End"];
                $i++;
            }
        }
    }
    
    else{
        error("[KRZT] Var_OP is undefined.");
    }
    
    mysqli_close($db);
    
    /*
    0 - Store
    1 - Retrieve
    */
?>