<?php
class controler {  
    private $arr_dirs = array();
    private $arr_imgs = array();

    function __construct($Path){
        $this->start($Path);   
    }
    
    
    private function start($Path){
        foreach(scandir($Path) as $row){
            if($row[0] != '.'){
                $pwd = "$Path/$row";
                if(is_dir($pwd)){
                    $temp_arr = $this->info_dir($pwd);
                    array_push($this->arr_dirs, [
                        'name' => $row,
                        'pwd' => $pwd,
                        'col_ob' => $temp_arr['col_ob'],
                        'col_img' => $temp_arr['col_img']
                    ]);
                } elseif ($this->is_img($pwd)){
                    array_push($this->arr_imgs, [
                        'name' => $row,
                        'pwd' => $pwd
                    ]);
                }
            }
        }
    }
    
    private function info_dir($Path){
        $col_img = 0;
        $col_ob = 0;
        foreach(scandir($Path) as $row){
            if($row[0] != '.') {
                //if($this->is_img("$Path/$row")) $col_img++; //подсчет количества изображений во вложенных дерикториях отключен
                $col_ob++;
            }
        }

        return [
            'col_ob' => $col_ob,
            'col_img' => $col_img
        ];
    }
    
    private function is_img($Path){
        if(is_file($Path)){
            $mime = mime_content_type($Path);
            if(0 === strpos($mime, 'image/jpeg') || 
               0 === strpos($mime, 'image/png') ||
               0 === strpos($mime, 'image/gif')
            ) return 1;
        }
        return 0;
    }
    
    public function getDirs(){
        return $this->arr_dirs;
    }
    
    public function getImg(){
        return $this->arr_imgs;
    }
    
    public static function gen_nav($path){
        foreach(explode('/', $path) as $row){
            if($row != ''){
                yield [
                    'name' => $row,
                    'pwd' => @$temp .= "/$row"
                ];
            }
        }
    }
}
