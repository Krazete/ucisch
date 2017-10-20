<?php
    if(date("m")>0 && date("m")<=3){
        $qtr="w";
    }
    else if(date("m")>3 && date("m")<=6){
        $qtr="s";
    }
    else if(date("m")>9 && date("m")<=12){
        $qtr="f";
    }
    else{
        $qtr="-";
    }
    $qtr=date("y").$qtr;
    function error($message){
        echo "<div style=\"position:absolute;top:0;left:0;background-color:rgba(255,255,255,0.25);color:white;z-index:9999;\">Error: $message</div>";
    }
    if(isset($_COOKIE["user"]) && $_COOKIE["user"]!=null){
        $name=$_COOKIE["user"];
        $OP=1;
        include "sql.php";
        if($exists==1){
            setcookie("user",$name,time()+(60*60*24*7*11));
            include "schedule_beta.php";
        }
        else{
            setcookie("user","",time()-3600);
            include "request.html";
            error("[KRZT] Cookie_user does not exist.");
        }
    }
    else if($_POST!=null){
        if($_POST["user"]!=null){
            if($_POST["schd"]!=null){
                include "parser.php";
                $end=$i;
                $OP=0;
                include "sql.php";
                setcookie("user",$name,time()+(60*60*24*7*11));
                include "schedule_beta.php";
            }
            else{
                $name=strtolower(trim($_POST["user"]));
                $OP=1;
                include "sql.php";
                if($exists==1){
                    setcookie("user",$name,time()+(60*60*24*7*11));
                    include "schedule_beta.php";
                }
                else{
                    include "request.html";
                    error("[USER] Post_user does not exist.");
                }
            }
        }
        else{
            include "request.html";
            error("[USER] Post_user is null.");
        }
        //header("Location: http://ucisch.site50.net/");
    }
    else{
        include "request.html";
    }
    echo "<script type=\"text/undefined\">";
?>
