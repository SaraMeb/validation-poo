<?php
 class Animal
 {
   public $uri;
   public $path;
   public $header = "./views/layouts/header.html";
   public $footer = "./views/layouts/footer.html";

   public function __construct($uri)
   {
    $this->uri = $uri;
    $this->path = "./views" . $uri . ".html";
   }

   public function createAnimals($sort)
   {
    //var_dump(scandir('./views'));die; //on scanne le dossier views et on supprime les elements dont on a pas besoin grace à la fontion array_diff
    $div = array_diff(scandir('./views'), [
      ".",
      "..",
      "layouts",
      "_404.html",
    ]);
    //var_dump($div);die;  //on s'assure qu'on a que les elements qui nous interessent dasn notre array
    $renderHtml = "<div>";
    if($sort){
      rsort($div); //rsort est une fonction php qui effectue un tri en ordre décroissant, on peut aussi utiliser sort pour l'ordre croissant
    }
      //var_dump($div);die;
      /*$input = array($div);
      $output = array_slice($div, $uri);*/
      //var_dump($output);die;
     foreach($div as $key => $value){
      $renderHtml .= "<div>" . file_get_contents("./views/" . $value) . "</div>";
      }
      $renderHtml .= "</div>";
      return $renderHtml;

   }
   public function renderView($sort = true)
   {
     if(file_exists($this->path)){
        $content = file_get_contents($this->path);
     } elseif ($this->uri == "/" || $this->uri == ""){
       $content = $this->createAnimals($sort);
     } else {
       $content = file_get_contents("./views/_404.html");
     }
     echo file_get_contents($this->header) . $content . file_get_contents($this->footer);
   }
 }
