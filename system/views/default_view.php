<?php
// test commit makss56
require_once conf::$ROOT . 'system/etc/functions.php';
// получаем адрес страницы без учета параметров
$CURRENT_PAGE = basename($_SERVER['REQUEST_URI']); // получаем адрес
// способ 1
//$pos = strpos($CURRENT_PAGE, '?'); // получаем позицию знака вопроса
//if($pos) $CURRENT_PAGE = substr($CURRENT_PAGE, 0, $pos); // если знак вопроса есть, получаем подстроку до знака вопроса
// способ 2
// парсим адрес 
$arr = parse_url($CURRENT_PAGE);
$CURRENT_PAGE_HARD = $CURRENT_PAGE; // сохраняем для жестких ссылок прописанных с учетом параметров в запросе
$CURRENT_PAGE = $arr['path']; // получаем конечный адрес
//var_dump($arr);
// ------------- получаем адрес страницы без учета параметров


?><!DOCTYPE html>
<html lang="ru" ng-app="postApp">
    <head>
        <meta charset="utf-8"/>
        <title><?php echo isset($data['title']) ? $data['title'] : conf::$SITE_NAME; ?></title>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
        <?php
        
        sys::inc_no_cache('css', 'css/bootstrap.css');
        sys::inc_no_cache('css', 'css/styles.css');
        sys::inc_no_cache('css', 'css/jquery-ui.structure.css');
       
        sys::inc_no_cache('css', 'css/font-awesome.css');
        sys::inc_no_cache('css', 'css/create_title_block.css');

        sys::inc_no_cache('javascript', 'js/libraries/jquery-3.4.1.js');
        sys::inc_no_cache('javascript', 'js/libraries/popper.min.js');
        sys::inc_no_cache('javascript', 'js/libraries/bootstrap.min.js');
        sys::inc_no_cache('javascript', 'js/libraries/jquery-ui.js');
       
        sys::inc_no_cache('javascript', 'js/main.js');
        sys::inc_no_cache('javascript', 'js/flowtype.js');
        ?>
        
        <script type="text/ng-template" id="comments-tree">
            {{ comments.body }}
            
            <button class="btn btn-primary btn-sm" type="btn" ng-hide="!hide"  ng-click = "hide = false">ответить</button>
            <button class="btn btn-primary btn-sm" type="btn" ng-hide="hide" ng-click = "hide=true">скрыть</button>
            <textarea class="form-control" ng-hide="hide" ng-model="text"></textarea>
            <input ng-model="id" ng-init="id=comments.id" ng-hide="true"/>   
            <input ng-model="parent_id" ng-init="parent_id=comments.parent_id" ng-hide="true"/>  
            <button class="btn btn-primary btn-sm" id="comments.id" parent_id="comments.parent_id" type="btn" ng-hide="hide" ng-click="save()">отправить</button>
            <ul ng-if="comments.answers">
                <li ng-repeat="comments in comments.answers" id = "comments.id" ng-include="'comments-tree'" ng-controller="commController">           
                </li>
            </ul>
        </script>
        <script src="<?php echo conf::$SITE_URL ?>js/main.js" type="text/javascript"></script>
        <script src="<?php echo conf::$SITE_URL ?>js/default.js" type="text/javascript"></script>

        <link href="<?php echo conf::$SITE_URL ?>css/main.css" rel="stylesheet" type="text/css">
        <link href="<?php echo conf::$SITE_URL ?>css/menu.css" rel="stylesheet" type="text/css">
        <link href="<?php echo conf::$SITE_URL ?>css/btn_heder.css" rel="stylesheet" type="text/css">


        <script>
            var SITE_URL = "<?php echo conf::$SITE_URL ?>";
            var CURRENT_PAGE = "<?= $CURRENT_PAGE ?>"
        </script>

        <style>
            .main_menu .nav>li>a {
                position: relative;
                display: block;
                padding: 3px 10px;
            }
        </style>
        <title>Posts</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    </head>
    <body class='bg-light' ng-controller="postController">
        <div class="post">
            <button id="post" type="button" hidden ng-click="alert('awd')">awd</button>
            <ul>
                <li ng-repeat="comments in posts" id="comments.id" ng-include="'comments-tree'" ng-controller="commController"></li>
            </ul> 
        </div>
    </body>
</html>
