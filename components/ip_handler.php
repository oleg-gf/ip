<?php
    session_start();

    $api_array = require __DIR__ . "/api_array.php";

    foreach ($_GET as &$value) {
            $value = trim(htmlspecialchars($value));
       }
       
    $service = $_GET["service"];

    if ($_GET["ip"]) {
        if(!filter_var($_GET["ip"], FILTER_VALIDATE_IP))
                {    
                    exit(json_encode("Неверный IP")); 
                }

        if ($_SESSION["ip"] == $_GET["ip"] && $_SESSION["service"] == $service){
                exit(json_encode($_SESSION["json_answer"]));
            } else {
                $any_ip = get_geobase_data($_GET["ip"], $api_array[$service]);

                $result = $any_ip->{$api_array[$service]['country_code']};
                
                exit(json_encode($result));
            }
    }
        
    if ($_GET["myip"]){

        $user_ip = get_ip();
        exit(json_encode($user_ip));
    }
                
           /**
         * функция определяет ip адрес по глобальному массиву $_SERVER
         * ip адреса проверяются начиная с приоритетного, для определения возможного использования прокси
         * @return ip-адрес
         */
        function get_ip()
        {
            $ipa = array();
            $ip = false;
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                $ipa[] = trim(strtok($_SERVER['HTTP_X_FORWARDED_FOR'], ','));

            if (isset($_SERVER['HTTP_CLIENT_IP']))
                $ipa[] = $_SERVER['HTTP_CLIENT_IP'];       
            
            if (isset($_SERVER['REMOTE_ADDR']))
                $ipa[] = $_SERVER['REMOTE_ADDR'];
            
            if (isset($_SERVER['HTTP_X_REAL_IP']))
                $ipa[] = $_SERVER['HTTP_X_REAL_IP'];
            

            // проверяем ip-адреса на валидность начиная с приоритетного.
            foreach($ipa as $ips)
            {
                //  если ip валидный обрываем цикл, назначаем ip адрес и возвращаем его
                if(filter_var($ips, FILTER_VALIDATE_IP))
                {                    
                    $ip = $ips;
                    break;
                }
                
            }
            return $ip;
            
        }

    
        function get_geobase_data($ip, $api)
        {
            // получаем данные по ip


           $link = $api['first_string'].$ip.$api['last_string'];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $link);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 3);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
            $string = curl_exec($ch);    

            $_SESSION["ip"] = $ip;
            $_SESSION["service"] = $_GET["service"];
            $_SESSION["json_answer"] = json_decode($string);

            return $string ? $_SESSION["json_answer"] : "Ошибка получения данных";
        }