<?php
namespace BootstraPHP;

class BootstrapMeta {
    
    function getCSSLink(){
        return '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">';
    }
    
    function getViewportMeta(){
        return '<meta name="viewport" content="width=device-width, initial-scale=1">';
    }
    
    function getCharsetMeta($charset = "utf-8"){
        return '<meta charset="'.$charset.'">';
    }
    
    function getJSBundle(){
        return '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>';
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
    
    public function __construct($element = "div", $id = "", $classes = array(), $contentHTML = ""){
        $this->element = $element;
        $this->id = $id;
        $this->classes = $classes;
        $this->contentHTML = $contentHTML;
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
        if(isset($this->parameters[$p_name]))
            return $this->parameters[$p_name];
        return null;
    }
    
    public function removeParameter($p_name){
        unset($this->parameters[$p_name]);
    }
    
    public function export($ignore_empty_parameters = true){
        $classList = join(" ", $this->classes);
        $finalHTML = $this->contentHTML;
        foreach($this->children as $child){
            $finalHTML = $finalHTML . $child->export();
        }
        $paramStr = "";
        foreach($this->parameters as $name => $value){

            if($value == "" && $ignore_empty_parameters){
                continue;
            }

            $paramStr = $paramStr . " " . $name . '="' . $value . '"';
        }
        
        $out_builder = "";
        $out_builder = $out_builder . '<'.$this->element;
        if($this->id != ""){
            $out_builder = $out_builder . ' id="'.$this->id.'"';
        }
        if($classList != ""){
            $out_builder = $out_builder . ' class="'.$classList.'"';
        }
        if($this->style != ""){
            $out_builder = $out_builder . ' style="'.$this->style.'"';
        }
        if($paramStr != ""){
            $out_builder = $out_builder . ' '.$paramStr;
        }
        $out_builder = $out_builder . '>';
        $out_builder = $out_builder . $finalHTML;
        $out_builder = $out_builder . '</'.$this->element.'>';

        return $out_builder;
    }
    
}

class Color {
    
    const PRIMARY = "primary";
    const SECONDARY = "secondary";
    const SUCCESS = "success";
    const INFO = "info";
    const WARNING = "warning";
    const DANGER = "danger";    
    const LIGHT = "light";
    const DARK = "dark";

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



//DEPRECATED - PLEASE USE Container(fluid: true)
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
    
    public function __construct($id = "", $p_expand = Navbar::EXPAND_LG, $p_backgroundColor = BackgroundColor::LIGHT, $p_isDark = false){
        $this->expandBreakpoint = $p_expand;
        parent::__construct("div", $id, array("navbar", BackgroundColor::LIGHT, $p_expand), "");
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

class NavbarToggler extends BootstrapComponent {
    
    public function __construct($p_id = "", $p_target = "navbar_content"){
        parent::__construct("button",$p_id,array("navbar-toggler"),"");
        parent::addParameter("type", "button");
        parent::addParameter("data-bs-toggle", "collapse");
        $this->setTarget($p_target);
        parent::setContentHTML('<span class="navbar-toggler-icon"></span>');
    }
    
    public function setTarget($p_target){
        if(str_starts_with($p_target, "#")){
            parent::addParameter("data-bs-target", $p_target);
        }else{
            parent::addParameter("data-bs-target", "#".$p_target);
        }
    }
    
}

class Collapse extends BootstrapComponent {
    
    public function __construct($p_id = "collapse", $p_show = false){
        parent::__construct("div", $p_id, array("collapse"), "");
        if($p_show){
            parent::addClass("show");
        }
    }
    
}

class NavbarCollapse extends Collapse {
    
    public function __construct($id = "navbar_content"){
        parent::__construct($id);
        parent::addClass("navbar-collapse");
    }
    
}

class Nav extends BootstrapComponent {
    
    public function __construct($p_id = "", $useList = true){
        if($useList){
            parent::__construct("ul", $p_id, array("nav"), "");
        }else{
            parent::__construct("nav", $p_id, array("nav"), "");
        }
    }
    
}

class NavbarNav extends Nav {
    
    public function __construct($p_id = ""){
        parent::__construct($p_id, true);
        parent::addClass("navbar-nav");
    }
    
}

class NavItem extends BootstrapComponent {
    
    public function __construct($p_id = "", $p_content = ""){
        parent::__construct("li", $p_id, array("nav-item"), $p_content);
    }
    
}

class NavLink extends BootstrapComponent {
    
    public function __construct($p_id = "", $p_text = "", $p_url = ""){
        parent::__construct("a", $p_id, array("nav-link"), $p_text);
        $this->setUrl($p_url);
    }
    
    public function setText($p_text){
        parent::setContentHTML($p_text);
    }
    
    public function setUrl($p_url){
        parent::addParameter("href", $p_url);
    }
    
}

class NavDropdown extends BootstrapComponent {
    
    public function __construct($p_id = "", $p_content = ""){
        parent::__construct("li", $p_id, array("nav-item", "dropdown"), $p_content);
    }
    
}

#TODO: Extend to DropdownToggle instead of BootstrapComponent to allow for options like split toggles, etc.
class NavDropdownToggle extends BootstrapComponent {
    
    public function __construct($p_id = "", $p_text){
        parent::__construct("a", $p_id, array("nav-link", "dropdown-toggle"), $p_text);
        parent::addParameter("role", "button");
        parent::addParameter("data-bs-toggle", "dropdown");
        
    }
    
}

class DropdownMenu extends BootstrapComponent {
    
    public function __construct($p_id = ""){
        parent::__construct("ul", $p_id, array("dropdown-menu"), "");
    }
    
    public function addChild(BootstrapComponent $p_component){
        $list_item = new BootstrapComponent("li", "", "", "");
        $list_item->addChild($p_component);
        parent::addChild($list_item);
    }
    
}

class DropdownItem extends BootstrapComponent {
    
    public function __construct($p_id = "", $p_name, $p_url = "#"){
        parent::__construct("a", $p_id, array("dropdown-item"), $p_name);
        parent::addParameter("href", $p_url);
    }
    
    public function setURL($p_url){
        parent::removeParameter("href");
        parent::addParameter("href", $p_url);
    }
    
    public function setName($p_name){
        parent::setContentHTML($p_name);
    }
    
}

class FormInput extends BootstrapComponent {
    public function __construct($id = "", $type = "hidden", $name = "", $value = "", $placeholder = ""){
        parent::__construct("input", $id, array("form-control"), "");
        parent::addParameter("type", $type);
        parent::addParameter("name", $name);
        parent::addParameter("value", $value);
        parent::addParameter("placeholder", $placeholder);
    }

    public function setType($type){
        parent::removeParameter("type");
        parent::addParameter("type", $type);
    }

    public function getType(){
        return parent::getParameter("type");
    }

    public function setName($name){
        parent::removeParameter("name");
        parent::addParameter("name", $name);
    }

    public function getName(){
        return parent::getParameter("name");
    }

    public function setValue($value){
        parent::removeParameter("value");
        parent::addParameter("value", $value);
    }

    public function getValue(){
        return parent::getParameter("value");
    }

    public function setPlaceholder($placeholder){
        parent::removeParameter("placeholder");
        parent::addParameter("placeholder", $placeholder);
    }

    public function getPlaceholder(){
        return parent::getParameter("placeholder");
    }

    public function setRequired($required){
        if($required){
            parent::addParameter("required", "required");
        }else{
            parent::removeParameter("required");
        }
    }

    public function getRequired(){
        if(parent::getParameter("required") != null){
            return true;
        }
        return false;
    }

    public function setDisabled($disabled){
        if($disabled){
            parent::addParameter("disabled", "disabled");
        }else{
            parent::removeParameter("disabled");
        }
    }

    public function setReadOnly($readOnly){
        if($readOnly){
            parent::addParameter("readonly", "readonly");
        }else{
            parent::removeParameter("readonly");
        }
    }

    public function setAutoFocus($autoFocus){
        if($autoFocus){
            parent::addParameter("autofocus", "autofocus");
        }else{
            parent::removeParameter("autofocus");
        }
    }

    public function setAutoComplete($autoComplete){
        if($autoComplete){
            parent::addParameter("autocomplete", "autocomplete");
        }else{
            parent::removeParameter("autocomplete");
        }
    }

    public function setAutoCorrect($autoCorrect){
        if($autoCorrect){
            parent::addParameter("autocorrect", "autocorrect");
        }else{
            parent::removeParameter("autocorrect");
        }
    }
}

class InputGroup extends BootstrapComponent {

    public function __construct($id = "", $size = ""){
        parent::__construct("div", $id, array("input-group"), "");
        if($size != ""){
            parent::addClass("input-group-" . $size);
        }
    }
    
}

class Button extends BootstrapComponent {

    public function __construct($id = "", $text = "", $type = "button", $size = "", $color = "primary", $link_to = ""){
        parent::__construct("button", $id, array("btn","btn-".$color), $text);
        parent::addParameter("type", $type);
        if($size != ""){
            parent::addClass("btn-" . $size);
        }
        if($link_to != ""){
            parent::setElement("a");
            parent::addParameter("href", $link_to);
        }
    }

    public function setColor($color, $outline = false){

        //Remove all btn- classes (color classes)
        $classes = parent::getClasses();
        foreach($classes as $class){
            if(str_starts_with($class, "btn-")){
                parent::removeClass($class);
            }
        }

        if(!str_contains($color, "-")){
            if($outline){
                parent::addClass("btn-outline-" . $color);
            }else{
                parent::addClass("btn-" . $color);
            }
        }else{
            parent::addClass($color);
        }

    }

    public function setText($text){
        parent::setContentHTML($text);
    }

}

class Container extends BootstrapComponent {

    public function __construct($id = "", $fluid = false){
        if($fluid){
            parent::__construct("div", $id, array("container-fluid"), "");
        }else{
            parent::__construct("div", $id, array("container"), "");
        }
    }

}
