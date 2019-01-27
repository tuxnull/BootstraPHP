<?PHP
echo "<!-- BootstraPHP initialized! https://github.com/tuxnull/BootstraPHP -->";
echo "<meta name='bootstraPHP' content='https://github.com/tuxnull/BootstraPHP'>";


function init_meta(){
    return '<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
}

function init_stylesheet(){
    return '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">';
}

function init_bootswatch_stylesheet($style){
    $style = strtolower($style);
    return '<link rel="stylesheet" href="https://bootswatch.com/4/'.$style.'/bootstrap.min.css">';
}

function init_js(){
    return '<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>';
}

function init_navbar($args, $content){

    if(array_key_exists("style",$args)){
        $style = $args["style"];
    }else{
        return '<b>BootstraPHP has encountered an error: init_navbar is missing required argument "style"';
    }

    if(array_key_exists("links_to",$args)){
        $links_to = $args["links_to"];
    }else{
        return '<b>BootstraPHP has encountered an error: init_navbar is missing required argument "links_to"';
    }

    if(array_key_exists("brand",$args)){
        $brand = $args["brand"];
    }else{
        return '<b>BootstraPHP has encountered an error: init_navbar is missing required argument "brand"';
    }


    return '<nav class="navbar navbar-expand-lg navbar-'.$style.' bg-'.$style.'">
    <a class="navbar-brand" href="'.$links_to.'">'.$brand.'</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">'.$content."</ul></div></nav>";
}

function navbar_element($args){
    if(array_key_exists("element",$args)){
        $element = $args["element"];
    }else{
        return '<b>BootstraPHP has encountered an error: navbar_element is missing required argument "element"';
    }

    if(array_key_exists("links_to",$args)){
        $links_to = $args["links_to"];
    }else{
        return '<b>BootstraPHP has encountered an error: navbar_element is missing required argument "links_to"';
    }

    if(array_key_exists("name",$args)){
        $name = $args["name"];
    }else{
        return '<b>BootstraPHP has encountered an error: navbar_element is missing required argument "name"';
    }

    if(array_key_exists("active",$args)){
        if($args["active"] == true){
            $active = true;
        }else{
            $active = false;
        }
    }else{
        $active = false;
    }

    if(array_key_exists("style",$args)){
        $style = $args["style"];
    }else{
        $active = "";
    }

    if(array_key_exists("dropdown_content",$args)){
        $dcontent = $args["dropdown_content"];
    }else{
        $dcontent = "";
    }

    if(array_key_exists("return_url",$args)){
        $returl = $args["return_url"];
    }else{
        $returl = "";
    }

    if($element == "link"){
        if($active == true){
            return '<li class="nav-item active">
            <a class="nav-link" href="'.$links_to.'">'.$name.'</a>
            </li>';
        }else{
            return '<li class="nav-item">
            <a class="nav-link" href="'.$links_to.'">'.$name.'</a>
            </li>';
        }
    }
    if($element == "dropdown"){
        return '<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="'.$links_to.'" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        '.$name.'
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        '.$dcontent.'
        </div>
        </li>';
    }
    if($element == "search"){
        return '<form class="form-inline my-2 my-lg-0" action="'.$links_to.'" method="'.$returl.'">
        <input class="form-control mr-sm-2" type="search" placeholder="'.$name.'" aria-label="'.$name.'" name="query">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">'.$name.'</button>
        </form>';
    }
    if($element == "lead_link"){
        return '<a class="btn btn-outline-'.$style.' my-2 my-sm-0" href="'.$links_to.'">'.$name.'</a>';
    }

}

function dropdown_element($args){

    if(array_key_exists("element", $args)){
        $element = $args["element"];
    }else{
        return '<b>BootstraPHP has encountered an error: dropdown_element is missing required argument "element"';
    }

    if(array_key_exists("links_to", $args)){
        if($args["links_to"]){
            $links_to = $args["links_to"];
        }else{
            $links_to = "";
        }
    }else{
        $links_to = "";
    }

    if(array_key_exists("name", $args)){
        if($args["name"]){
            $name = $args["name"];
        }else{
            $name = "";
        }
    }else{
        $name = "";
    }

    if($element == "link"){
        return '<a class="dropdown-item" href="'.$links_to.'">'.$name.'</a>';
    }

    if($element == "divider"){
        return '<div class="dropdown-divider"></div>';
    }
}

function navbar_swap_alignment(){
    return "</ul>";
}

function navbar_finish(){
    return '</div>
    </nav><meta name="bootstraPHP_warning" content="navbar_finish() is deprecated - do not use this statement">';
}

function alert($args){
    if(array_key_exists("dismissable",$args)){ #Dismissable attribute is optional, doesnt need to be included in the array this way
        if($args["dismissable"] == true){
            $dismissable = false;
        }else{
            $dismissable = false;
        }
    }else{
        $dismissable = false;
    }
    if ($dismissable == true) {
        return '<div class="alert alert-'.$args['style'].'" role="alert">'.$args['content'].'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>';
    } else {
        return '<div class="alert alert-'.$args['style'].'" role="alert">'.$args['content'].'</div>';
    }
}

function badge($content, $style){
    return '<span class="badge badge-'.$style.'">'.$content.'</span>';
}

function pill($content, $style){
    return '<span class="badge badge-pill badge-'.$style.'">'.$content.'</span>';
}

function custom_link($args, $content){

    if(array_key_exists("element",$args)){
        $element = $args["element"];
    }else{
        return '<b>BootstraPHP has encountered an error: custom_link is missing required argument "element"';
    }

    if(array_key_exists("links_to",$args)){
        $links_to = $args["links_to"];
    }else{
        return '<b>BootstraPHP has encountered an error: custom_link is missing required argument "links_to"';
    }

    if(array_key_exists("style",$args)){
        $style = $args["style"];
    }else{
        return '<b>BootstraPHP has encountered an error: custom_link is missing required argument "style"';
    }

    if(array_key_exists("disabled",$args)){
        $disabled = $args["disabled"];
    }else{
        $disabled = false;
    }


    if($disabled == true){
        $disabled = "disabled";
    }else{
        $disabled = "";
    }
    if($element == "badge"){
        return '<a href="'.$links_to.'" class="badge badge-'.$style.'" '.$disabled.'>'.$content.'</a>';
    }else if($element == "pill"){ #Pill Link
        return '<a href="'.$links_to.'" class="badge badge-pill badge-'.$style.'" '.$disabled.'>'.$content.'</a>';
    }else if($element == "button"){ #Button Link
        return '<a href="'.$links_to.'" class="btn btn-'.$style.'" '.$disabled.'>'.$content.'</a>';
    }else if($element == "outline-button"){ #Outline colored Button Link
        return '<a href="'.$links_to.'" class="btn btn-outline-'.$style.'" '.$disabled.'>'.$content.'</a>';
    }else if($element == "button-sm"){ #Small Button
        return '<a href="'.$links_to.'" class="btn btn-sm btn-'.$style.'" '.$disabled.'>'.$content.'</a>';
    }else if($element == "outline-button-sm"){ #Small Outline Button
        return '<a href="'.$links_to.'" class="btn btn-sm btn-outline-'.$style.'" '.$disabled.'>'.$content.'</a>';
    }else if($element == "button-lg"){ #Big Button
        return '<a href="'.$links_to.'" class="btn btn-lg btn-'.$style.'" '.$disabled.'>'.$content.'</a>';
    }else if($element == "button-block"){ #Block Button
        return '<a href="'.$links_to.'" class="btn btn-block btn-'.$style.'" '.$disabled.'>'.$content.'</a>';
    }else if($element == "button-block-lg"){ #Big Block Button
        return '<a href="'.$links_to.'" class="btn btn-block btn-lg btn-'.$style.'" '.$disabled.'>'.$content.'</a>';
    }else if($element == "button-block-sm"){ #Small Block Button
        return '<a href="'.$links_to.'" class="btn btn-block btn-sm btn-'.$style.'" '.$disabled.'>'.$content.'</a>';
    }else if($element == "outline-button-lg"){ #Big Outline Button
        return '<a href="'.$links_to.'" class="btn btn-lg btn-outline-'.$style.'" '.$disabled.'>'.$content.'</a>';
    }else{ #No Element Found, Creating regular link with error message
        return '<a href="'.$links_to.'" error="Could not find an element called '.$element.'" '.$disabled.'>'.$content.'</a>';
    }
}

function card($args, $content){

    if(array_key_exists("image_url",$args)){
        $image_url = $args["image_url"];
    }else{
        $image_url = "";
    }

    if(array_key_exists("card_header",$args)){
        $card_header = $args["card_header"];
    }else{
        $card_header = "";
    }

    if($image_url == ""){
        if($card_header == ""){
            $header = "<!-- Optional Card Header position here -->";
        }else{
            $header = '<div class="card-header">'.$card_header.'</div>';
        }
        return '<div class="card">
        '.$header.'
        <div class="card-body">
        '.$content.'
        </div>
        </div>';
    }else{
        if($card_header == ""){
            $header = "<!-- Optional Card Header position here -->";
        }else{
            $header = '<div class="card-header">'.$card_header.'</div>';
        }
        return '<div class="card">
        '.$header.'
        <img src="'.$image_url.'" class="card-img-top" alt="'.$image_url.'">
        <div class="card-body">
        '.$content.'
        </div>
        </div>';
    }

}

function card_content($args, $content){

    if(array_key_exists("title", $args)){
        $title = $args["title"];
    }else{
        $title = "";
    }

    if(array_key_exists("subtitle", $args)){
        $subtitle = $args["subtitle"];
    }else{
        $subtitle = "";
    }

    return '<h5 class="card-title">'.$title.'</h5>
    <h6 class="card-subtitle mb-2 text-muted">'.$subtitle.'</h6>
    <p class="card-text">'.$content.'</p>';
}

function card_list_group($content){
    return '</div>
    <ul class="list-group list-group-flush">
    '.$content.'
    </ul>
    <div class="card-body">';
}

function list_group_item($content){
    return '<li class="list-group-item">'.$content.'</li>';
}

function no_arg(){
    return "";
}

function collapsible_div($args, $content){

    if(array_key_exists("show", $args)){
        $show = $args["show"];
    }else{
        $show = false;
    }

    if(array_key_exists("id", $args)){
        $id = $args["id"];
    }else{
        $id = "";
    }

    if($show == true){
        $show = "show";
    }else{
        $show = "";
    }
    return '<div class="collapse '.$show.'" id="'.$id.'">'.$content.'</div>';
}

function collapse_link($id){
    return "javascript:$('#".$id."').collapse('toggle');";
}

function breadcrumb($content){
    return '<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    '.$content.'
    </ol>
    </nav>';
}

function breadcrumb_item($args, $content){

    if(array_key_exists("links_to", $args)){
        $links_to = $args["links_to"];
    }else{
        $links_to = "";
    }

    if(array_key_exists("active", $args)){
        $active = $args["active"];
    }else{
        $active = false;
    }

    if($links_to == ""){
        if($active == true){
            return '<li class="breadcrumb-item active"><a href="'.$links_to.'">'.$content.'</a></li>';
        }else{
            return '<li class="breadcrumb-item"><a href="'.$links_to.'">'.$content.'</a></li>';
        }
    }else{
        if($active == true){
            return '<li class="breadcrumb-item active">'.$content.'</li>';
        }else{
            return '<li class="breadcrumb-item">'.$content.'</li>';
        }
    }
}

function jumbotron($args, $content){

    if(array_key_exists("fluid", $args)){
        $fluid = $args["fluid"];
    }else{
        $fluid = false;
    }


    if($fluid == true){
        $fluid = "jumbotron-fluid";
    }else{
        $fluid = "";
    }
    return '<div class="jumbotron '.$fluid.'">
    <div class="container">
    '.$content.'
    </div>
    </div>';
}

function jumbotron_content($args, $content){

    if(array_key_exists("lead_text", $args)){
        $lead_text = $args["lead_text"];
    }else{
        $lead_text = "";
    }

    if(array_key_exists("title", $args)){
        $title = $args["title"];
    }else{
        $title = "";
    }

    if(array_key_exists("links_to", $args)){
        $links_to = $args["links_to"];
    }else{
        $links_to = "";
    }

    if(array_key_exists("button_text", $args)){
        $button_text = $args["button_text"];
    }else{
        $button_text = "";
    }


    if($lead_text == ""){
        $lead_text == "";
    }else{
        $lead_text = '<p class="lead">'.$lead_text.'</p>
        <hr class="my-4">';
    }

    return '<h1 class="display-4">'.$title.'</h1>
    '.$lead_text.'
    <p>'.$content.'</p>
    <a class="btn btn-primary btn-lg" href="'.$links_to.'" role="button">'.$button_text.'</a>';
}

function spinner($args){

    if(array_key_exists("type", $args)){
        $type = $args["type"];
    }else{
        return '<b>BootstraPHP has encountered an error: spinner is missing required argument "type"';
    }

    if(array_key_exists("style", $args)){
        $style = $args["style"];
    }else{
        return '<b>BootstraPHP has encountered an error: spinner is missing required argument "style"';
    }

    if(array_key_exists("alt", $args)){
        $alt = $args["alt"];
    }else{
        $alt = "";
    }



    if($type == "border"){
        return '<div class="spinner-border text-'.$style.'" role="status"><span class="sr-only">'.$alt.'</span></div>';
    }else if($type == "growing"){
        return '<div class="spinner-grow text-'.$style.'" role="status"><span class="sr-only">'.$alt.'</span></div>';
    }else{
        return "Spinner-element not found.";
    }
}

function span_spinner($type){
    if($type == "border"){
        return '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
    }else if($type == "growing"){
        return '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>';
    }else{
        return 'Spinner-element not found.';
    }
}

function container($content){
    return '<div class="container">'.$content.'</div>';
}

function grid_row($args, $content){

    if(array_key_exists("horizontal_alignment", $args)){
        $horizontal_alignment = $args["horizontal_alignment"];
    }else{
        $horizontal_alignment = "";
    }

    if($horizontal_alignment == ""){
        return '<div class="row">'.$content.'</div>';
    }else{
        return '<div class="row justify-content-'.$horizontal_alignment.'">'.$content.'</div>';
    }

}

function col($args, $content){

    if(array_key_exists("class_prefix", $args)){
        $class_prefix = $args["class_prefix"];
    }else{
        $class_prefix = "";
    }

    if(array_key_exists("units", $args)){
        $units = $args["units"];
    }else{
        $units = "";
    }


    if($class_prefix != ""){
        $class_prefix = "-".$class_prefix;
    }

    if($units>12){
        echo '"<meta name="bootstraPHP_warning" content="Using a column with more than 12 width-units is not recommended!">';
    }
    if($units != ""){
        $units = "-" . $units;
    }
    return '<div class="col'.$class_prefix.$units.'">'.$content.'</div>';
}

function grid_break(){
    return '<div class="w-100"></div>';
}

function table($args, $content){

    if(array_key_exists("dark", $args)){
        $dark = $args["dark"];
    }else{
        $dark = false;
    }

    if(array_key_exists("striped", $args)){
        $striped = $args["striped"];
    }else{
        $striped = false;
    }

    if(array_key_exists("bordered", $args)){
        $bordered = $args["bordered"];
    }else{
        $bordered = false;
    }

    if(array_key_exists("hover", $args)){
        $hover = $args["hover"];
    }else{
        $hover = false;
    }



    if($dark == true){
        $dark = "table-dark";
    }
    if($striped == true){
        $striped = "table-striped ";
    }
    if($bordered == true){
        $bordered = "table-bordered ";
    }
    if($hover == true){
        $hover = "table-hover ";
    }

    return '<table class="table '.$dark." ".$striped." ".$bordered."".$hover.'">'.$content.'</table>';
}

function table_head($args, $content){

    if(array_key_exists("style", $args)){
        $style = $args["style"];
    }else{
        $style = "";
    }

    if($style == ""){
        return '<thead><tr>'.$content.'</tr></thead>';
    }else{
        return '<thead class="thead-'.$style.'"><tr>'.$content.'</tr></thead>';
    }
}

function table_th($args, $content){

    if(array_key_exists("scope", $args)){
        $scope = $args["scope"];
    }else{
        $scope = "";
    }

    return '<th scope="'.$scope.'">'.$content.'</th>';
}

function table_body($content){
    return '<tbody>'.$content.'</tbody>';
}

function table_row($content){
    return '<tr>'.$content.'</tr>';
}

function table_td($args, $content){

    if(array_key_exists("colspan", $args)){
        $colspan = $args["colspan"];
    }else{
        $colspan = "";
    }

    if($colspan != ""){
        return '<td colspan="'.$colspan.'">'.$content.'</td>';
    }
    return '<td>'.$content.'</td>';
}

function form($args, $content){

    if(array_key_exists("action", $args)){
        $action = $args["action"];
    }else{
        return '<b>BootstraPHP has encountered an error: form is missing required argument "action"';
    }

    if(array_key_exists("method", $args)){
        $method = $args["method"];
    }else{
        return '<b>BootstraPHP has encountered an error: form is missing required argument "method"';
    }

    if(array_key_exists("enctype", $args)){
        $enctype = $args["enctype"];
    }else{
        $enctype = "";
    }

    if($enctype != ""){
        $enctype = 'enctype="'..$enctype'"';
    }

    return '<form action="'.$action.'" method="'.$method.'" '.$enctype.'>'.$content.'</form>';
}

function form_input($args){

    if(array_key_exists("prepend", $args)){
        $prepend = $args["prepend"];
    }else{
        $prepend = "";
    }

    if(array_key_exists("append", $args)){
        $append = $args["append"];
    }else{
        $append = "";
    }

    if(array_key_exists("type", $args)){
        $type = $args["type"];
    }else{
        return '<b>BootstraPHP has encountered an error: form_input is missing required argument "type"';
    }

    if(array_key_exists("placeholder", $args)){
        $placeholder = $args["placeholder"];
    }else{
        $placeholder = "";
    }

    if(array_key_exists("name", $args)){
        $name = $args["name"];
    }else{
        $name = "";
    }

    if($prepend != ""){
        $prepend = '<div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">'.$prepend.'</span>
        </div>';
    }

    if($append != ""){
        $append = '<div class="input-group-append">
        <span class="input-group-text" id="basic-addon1">'.$append.'</span>
        </div>';
    }

    return '<div class="input-group mb-3">
    '.$prepend.'
    <input type="'.$type.'" class="form-control" placeholder="'.$placeholder.'" aria-label="'.$placeholder.'" aria-describedby="basic-addon1" name="'.$name.'">
    '.$append.'
    </div>';
}

function input_group($content){
    return '<div class="input-group mb-3">'.$content.'</div>';
}

function input_group_prepend($content){
    return '<div class="input-group-prepend">'.$content.'</div>';
}

function input($args){

    if(array_key_exists("type", $args)){
        $type = $args["type"];
    }else{
        return '<b>BootstraPHP has encountered an error: input is missing required argument "type"';
    }

    if(array_key_exists("placeholder", $args)){
        $placeholder = $args["placeholder"];
    }else{
        $placeholder = "";
    }

    if(array_key_exists("name", $args)){
        $name = $args["name"];
    }else{
        $name = "";
    }

    if(array_key_exists("id", $args)){
        $id = $args["id"];
    }else{
        $id = "";
    }

    return '<input type="'.$type.'" placeholder="'.$placeholder.'" name="'.$name.'" id="'.$id.'">';
}

function input_group_append($content){
    return '<div class="input-group-append">'.$content.'</div>';
}

function pagination($args, $content){

    if(array_key_exists("alignment", $args)){
        $alignment = $args["alignment"];
    }else{
        $alignment = "";
    }

    if(array_key_exists("aria_label", $args)){
        $aria_label = $args["aria_label"];
    }else{
        $aria_label = "";
    }

    if($alignment != ""){
        $alignment = "justify-content-".$alignment;
    }
    return '<nav aria-label="'.$aria_label.'"><ul class="pagination '.$alignment.'">'.$content.'</ul></nav>';
}

function page_item($args, $content){

    if(array_key_exists("disabled", $args)){
        $disabled = $args["id"];
    }else{
        $disabled = false;
    }

    if($disabled == true){
        $disabled == "disabled";
    }
    return '<li class="page-item '.$disabled.'">'.$content.'</li>';
}

function page_link($args, $content){

    if(array_key_exists("links_to", $args)){
        $links_to = $args["links_to"];
    }else{
        $links_to = "";
    }

    return '<a class="page-link" href="'.$links_to.'">'.$content.'</a>';
}






?>
