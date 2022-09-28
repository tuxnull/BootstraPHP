<?php
namespace BootstraPHP;

class BootstrapMeta {
    
    function getCSSLink(){
        return '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">';
    }
    
    function getViewportMeta(){
        return '<meta name="viewport" content="width=device-width, initial-scale=1">';
    }
    
    function getCharsetMeta($charset = "utf-8"){
        return '<meta charset="'.$charset.'">';
    }
    
    function getJSBundle(){
        return '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>';
    }
    
}

class BootstrapComponent {
    
    private $element = "div";
    private $id = "";
    private $classes = array();
    private $children = array();
    private $parameters = array();
    private $contentHTML = "";
    private $style = "";
    
    public function __construct($p_element, $p_id, $p_classes, $p_contentHTML){
        $this->element = $p_element;
        $this->id = $p_id;
        $this->classes = $p_classes;
        $this->contentHTML = $p_contentHTML;
    }
    
    public function setElement($p_element){
        $this->element = $p_element;
    }
    
    public function getElement(){
        return $this->element;
    }
    
    public function setId($p_id){
        $this->id = $p_id;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function addClass($p_class){
        if(!in_array($p_class, $this->classes, false)){
            array_push($this->classes, $p_class);
        }
    }
    
    public function removeClass($p_class){
        if(($key = array_search($p_class, $this->classes)) !== false){
            unset($this->classes[$key]);
        }
    }
    
    public function getClasses(){
        return $this->classes;
    }
    
    public function setContentHTML($p_contentHTML){
        $this->contentHTML = $p_contentHTML;
    }
    
    public function getContentHTML(){
        return $this->contentHTML;
    }
    
    public function setStyle($p_style){
        $this->style = $p_style;
    }
    
    public function getStyle(){
        return $this->style;
    }
    
    public function addChild(BootstrapComponent $p_component){
        array_push($this->children, $p_component);
    }
    
    public function removeChild(BootstrapComponent $p_component){
        if(($key = array_search($p_component, $this->children)) !== false){
            unset($this->children[$key]);
        }
    }
    
    public function addParameter($p_name, $p_value){
        $this->parameters[$p_name] = $p_value;
    }
    
    public function getParameter($p_name){
        return $this->parameters[$p_name];
    }
    
    public function removeParameter($p_name){
        unset($this->parameters[$p_name]);
    }
    
    public function export(){
        $classList = join(" ", $this->classes);
        $finalHTML = $this->contentHTML;
        foreach($this->children as $child){
            $finalHTML = $finalHTML . $child->export();
        }
        $paramStr = "";
        foreach($this->parameters as $name => $value){
            $paramStr = $paramStr . " " . $name . '="' . $value . '"';
        }
        
        return '<'.$this->element.' id="'.$this->id.'" class="'.$classList.'" style="'.$this->style.'" '.$paramStr.'>'.$finalHTML.'</'.$this->element.'>';
    }
    
}

class BackgroundColor {
    
    const PRIMARY = "bg-primary";
    const SECONDARY = "bg-secondary";
    const SUCCESS = "bg-success";
    const INFO = "bg-info";
    const WARNING = "bg-warning";
    const DANGER = "bg-danger";    
    const LIGHT = "bg-light";
    const DARK = "bg-dark";
    
}

class ContainerFluid extends BootstrapComponent {
    
    public function __construct($p_id = ""){
        parent::__construct("div", $p_id, array("container-fluid"), "");
    }
    
}

class Navbar extends BootstrapComponent {
    
    const EXPAND_SM = "navbar-expand-sm";
    const EXPAND_MD = "navbar-expand-md";
    const EXPAND_LG = "navbar-expand-lg";
    const EXPAND_XL = "navbar-expand-xl";
    const EXPAND_XXL = "navbar-expand-xxl";
    
    private $expandBreakpoint;
    private $currentBackgroundColor;
    
    public function __construct($p_id = "", $p_expand = Navbar::EXPAND_LG, $p_backgroundColor = BackgroundColor::LIGHT, $p_isDark = false){
        $this->expandBreakpoint = $p_expand;
        parent::__construct("div", $p_id, array("navbar", BackgroundColor::LIGHT, $p_expand), "");
        $this->currentBackgroundColor = BackgroundColor::LIGHT;
    }
    
    public function setBackgroundColor($p_backgroundColor, $p_isDark = false){
        # Keeping track of the current background color and removing it if it needs to be changed
        # should be faster than going through all classes in the Elements classes array, but might
        # cause problems if the style has been manually overwritten.
        if(str_starts_with($this->currentBackgroundColor, "bg-")){
            parent::removeClass($this->currentBackgroundColor);
        }else{
            # Current Background Color is set in style attribute
            parent::setStyle(preg_replace("background-color:[#\d\w\s]*;", "",parent::getStyle()));
        }
        
        if(str_starts_with($p_backgroundColor, "bg-")){
            parent::addClass($p_backgroundColor);
        }else{
            $styleStr = parent::getStyle();
            $styleStr = $styleStr . " background-color: ".$p_backgroundColor.";";
            parent::setStyle(preg_replace("\s{2,}", "", $styleStr));
        }
        
        $this->currentBackgroundColor = $p_backgroundColor;
    }
    
    public function getBackgroundColor(){
        return $this->currentBackgroundColor;
    }
    
    public function setExpandBreakpoint($p_expand){
        parent::removeClass($this->expandBreakpoint);
        parent::addClass($p_expand);
        $this->expandBreakpoint = $p_expand;
    }
    
    public function getExpandBreakpoint(){
        return $this->expandBreakpoint;
    }
    
}

class NavbarBrand extends BootstrapComponent {
    
    private $text = "";
    private $imageUrl = "";
    
    public function __construct($p_id = "", $p_text = "", $p_imageUrl = "", $p_urlTo = "#"){
        parent::__construct("a", $p_id, array("navbar-brand"), "");
        $this->text = $p_text;
        $this->imageUrl = $p_imageUrl;
        $this->compile();
    }
    
    public function setText($p_text){
        $this->text = $p_text;
        $this->compile();
    }
    
    public function setImageUrl($p_imageUrl){
        $this->imageUrl = $p_imageUrl;
        $this->compile();
    }
    
    private function compile(){
        
        $html = "";
        if($this->imageUrl != ""){
            $html = $html . '<img src="'.$this->imageUrl.'" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">';
        }
        if($this->text != ""){
            $html = $html . $this->text;
        }
        parent::setContentHTML($html);
    }
    
}