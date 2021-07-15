<?php
    require_once 'db.php';
    require_once 'history.php';

    /**
     *С помощью стека определяется верность выражения, если в конце функции стек пустой, то выражение верное
    *@param string $string исходное выражение
    *@return boolean возваращет true, если скобки расставлены правильно, иначе false
    */
    function brackets($string){
        $arrOfStr = str_split($string);
        $listOfOpenned = ["<", "(", "{", "["];
        $listOfClossed = [">", ")", "}", "]"];
        $stack = new SplStack();

        //Цикл по массиву, в ходе которого добавляются или удаляются скобки в стеке
        for($i = 0; $i<count($arrOfStr); $i++){

            //проверка на то, что данный элемент - скобка
            if(array_search($arrOfStr[$i], $listOfOpenned)!==false || array_search($arrOfStr[$i], $listOfClossed)!==false){
                if(array_search($arrOfStr[$i], $listOfOpenned)!==false){
                    //если данный элемент открывающая скобка, добавить в стек и перейти на следующую итерацию
                    $stack->push($arrOfStr[$i]);
                    continue;
                }
                // Если стек пустой, но данный элемент закрывающая скобка, вернуть false
                if($stack->isEmpty()){
                    return false;
                }
                else if(array_search($stack->top(),$listOfOpenned) === array_search($arrOfStr[$i],$listOfClossed)){                
                        //если данный элемент, закрывающая скобка, и по значению она ровна с послденим элементом стека, то удалить этот элемент.
                        $stack->pop();
                    }
                }
            }    
        return $stack->isEmpty();
    }

    $link = $_POST["expression"];
    
    //если табли не создана, то создать
    if(!is_table_exists($mysqli)){
        create_table($mysqli);
    }
    if(empty($link)===false){
        //удаление пробелов
        $string = str_replace(" ","", $link);
        $result = brackets($string);
        insert_history($mysqli, "INSERT INTO `history` (`id`, `expression`, `success`) VALUES ('', '$link', '$result')");
        $history = get_history($mysqli);
        $json = json_encode($history);
        echo $json;
    }
    