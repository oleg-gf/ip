<?php
    session_start();
    $api_array = require __DIR__ . "/components/api_array.php";

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  
    <link rel="stylesheet" type="text/css" href="/css/main.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script src="/js/main.js"></script>
 
  
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col m-3">
            
            <div class="ip-input">
            <label>Введите IP: </label>
            <input type="text" name="ip" id="ip-input"  />
            </div>

            
        </div>
        <div class="col m-3">
            
            <div class="services">
            <label>Выберите сервис: </label>
            <select name="services" id="services">
            <?php  foreach ($api_array as $key => $value): ?>
                <option value="<?=$key?>"><?=$key?></option>
            <?php  endforeach; ?>
            </select>
            </div>

            
        </div>
        <div class="col m-3">
            <button class="btn btn-secondary" id="ip-query">Проверить</button>
            </div>
        <div class="col d-flex m-3">
            <div class="m-2">Код страны: </div>
            <div class="m-2" id="ip-output"></div>
        </div>        
    </div>
    <div class="row">
        <div class="col d-flex m-3">
            
            <div class="m-2" >
            <label>Мой IP: </label>
            
            </div>
            <div class="m-2" id="myip-output"></div>
            
        </div>
  
    </div>
</div>
</body>