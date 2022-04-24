<?php //session_start();
	function compareIPs($ip_address){
        if(!empty($ip_address)){
            if($ip_address == "96.126.106.125" || $ip_address === "::x1"){
                return "homer";
            }
            elseif($ip_address == "50.116.41.217"){
                return "homer";
            }
            elseif($ip_address == "192.155.90.179"){
                return "homer";
            }
            elseif($ip_address == "192.81.129.227"){
                return "homer";
            }
            elseif($ip_address == "198.58.111.80"){
                return "homer";
            }
            elseif($ip_address == "139.162.220.143"){
                return "homer";
            }
            else{
                return "awayer";
            }
        }else{
            return "awayer";
        }
    }
    function getIPAddress() {  
    //whether ip is from the shared internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP']) && $_SERVER['HTTP_CLIENT_IP'] != "::1") {  
         $ip = $_SERVER['HTTP_CLIENT_IP'];  
         return compareIPs($ip); 
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != "::1") {  
                $ip2 = $_SERVER['HTTP_X_FORWARDED_FOR'];  
                return compareIPs($ip2); 
     }  
    //whether ip is from the remote address  
    else{  
             $ip3 = $_SERVER['REMOTE_ADDR'];  
             return compareIPs($ip3); 
     }  
}
?> 