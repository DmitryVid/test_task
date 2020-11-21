<?php
class default_model extends model 
{
  public function get_data() 
  {
    $data = array();
    $data['title'] = conf::$SITE_NAME;
    $data['content'] = '';
    return $data;
  }
  function get_comments(){
      
      function push_elem($elem, $arr){
          for($i = 0; $i < count($arr); $i++){
              if($arr[$i]["id"] == $elem["parent_id"]){
                  
                  array_push($arr[$i]["answers"], $elem);
              } 
              else{
              $arr[$i]["answers"] = push_elem($elem, $arr[$i]["answers"]);
            }
          }
          
         return $arr;
      }
      $sql = "Select id, parent_id, topic_id, body from comments where topic_id = :topic_id order by parent_id";
      $q = sys::$PDO->prepare($sql);
      $q->execute(array("topic_id" => $_GET["topic"]));
      $Q = $q->fetchAll();
      
      $return = array();
      foreach($Q as $row){
          if($row["parent_id"] == 0){
              array_push($return,array("id" => $row["id"], "parent_id"=>$row["parent_id"], "body" => $row["body"], "answers"=>array()));
          
              
          }else{
              $elem = array("id" => $row["id"], "parent_id"=>$row["parent_id"], "body" => $row["body"], "answers"=>array());
              $return = push_elem($elem, $return);
          }
      }
      return $return;
  }
  
  function save_comments(){
      $sql = "INSERT INTO COMMENTS (parent_id, topic_id, body)
              VALUES(:parent_id, :topic_id, :body)";
      $q = sys::$PDO->prepare($sql);
      $q -> execute(array("parent_id" => $_POST["parent_id"], "topic_id" => $_POST["topic_id"], "body" => $_POST["body"]));
      return(array("result" => 1));
  }
}
