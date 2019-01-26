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

function init_navbar($style, $brand, $links_to, $content){
    return '<nav class="navbar navbar-expand-lg navbar-'.$style.' bg-'.$style.'">
    <a class="navbar-brand" href="'.$links_to.'">'.$brand.'</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">'.$content."</ul></div></nav>";
}

function navbar_element($element, $links_to, $name, $args){
    if($element == "link"){
        if($args == "active"){
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
        '.$args.'
        </div>
        </li>';
    }
    if($element == "search"){
        return '<form class="form-inline my-2 my-lg-0" action="'.$links_to.'" method="'.$args.'">
        <input class="form-control mr-sm-2" type="search" placeholder="'.$name.'" aria-label="'.$name.'" name="query">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">'.$name.'</button>
        </form>';
    }
    if($element == "lead_link"){
        return '<a class="btn btn-outline-'.$args.' my-2 my-sm-0" href="'.$links_to.'">'.$name.'</a>';
    }

}

function dropdown_element($element, $links_to, $name){
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

function alert($content, $style){
    return '<div class="alert alert-'.$style.'" role="alert">'.$content.'</div>';
}

function dismissable_alert($content, $style){
    return '<div class="alert alert-'.$style.'" role="alert">'.$content.'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button></div>';
}

function badge($content, $style){
    return '<span class="badge badge-'.$style.'">'.$content.'</span>';
}

function pill($content, $style){
    return '<span class="badge badge-pill badge-'.$style.'">'.$content.'</span>';
}

function custom_link($element, $links_to, $content, $style, $disabled){
    if($disabled == "true"){
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

function card($content, $card_header, $image_url){
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

function card_content($title, $subtitle, $content){
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

function collapsible_div($content, $id, $show){
    if($show == "true"){
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

function breadcrumb_item($links_to, $content, $active){
    if($links_to == ""){
        if($active == "true"){
            return '<li class="breadcrumb-item active"><a href="'.$links_to.'">'.$content.'</a></li>';
        }else{
            return '<li class="breadcrumb-item"><a href="'.$links_to.'">'.$content.'</a></li>';
        }
    }else{
        if($active == "true"){
            return '<li class="breadcrumb-item active">'.$content.'</li>';
        }else{
            return '<li class="breadcrumb-item">'.$content.'</li>';
        }
    }
}

function jumbotron($content, $fluid){
    if($fluid == "true"){
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

function jumbotron_content($title, $lead_text, $content, $links_to, $button_text){
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

function spinner($type, $style, $alt){
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

function grid_row($content, $horizontal_alignment){
    if($horizontal_alignment == ""){
        return '<div class="row">'.$content.'</div>';
    }else{
        return '<div class="row justify-content-'.$horizontal_alignment.'">'.$content.'</div>';
    }

}

function col($class_prefix, $units, $content){
    if($class_prefix == ""){

    }else{
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

function table($content, $dark, $striped, $bordered, $hover){
    if($dark != ""){
        $dark = "table-dark";
    }
    if($striped != ""){
        $striped = "table-striped ";
    }
    if($bordered != ""){
        $bordered = "table-bordered ";
    }
    if($hover != ""){
        $hover = "table-haver ";
    }

    return '<table class="table '.$dark." ".$striped." ".$bordered."".$hover.'">'.$content.'</table>';
}

function table_head($style, $content){
    if($style == ""){
        return '<thead><tr>'.$content.'</tr></thead>';
    }else{
        return '<thead class="thead-'.$style.'"><tr>'.$content.'</tr></thead>';
    }
}

function table_th($scope, $content){
    return '<th scope="'.$scope.'">'.$content.'</th>';
}

function table_body($content){
    return '<tbody>'.$content.'</tbody>';
}

function table_row($content){
    return '<tr>'.$content.'</tr>';
}

function table_td($colspan, $content){
    if($colspan != ""){
        return '<td colspan="'.$colspan.'">'.$content.'</td>';
    }
    return '<td>'.$content.'</td>';
}






?>
