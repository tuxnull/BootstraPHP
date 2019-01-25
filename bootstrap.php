<?PHP
function init_meta(){
    echo '<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
}

function init_stylesheet(){
    echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">';
}

function init_js(){
    echo '<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>';
}

function init_navbar($style, $brand, $links_to){
    echo '<nav class="navbar navbar-expand-lg navbar-'.$style.' bg-'.$style.'">';
    echo '<a class="navbar-brand" href="'.$links_to.'">'.$brand.'</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">';
}

function add_navbar_element($element, $links_to, $name, $args){
    if($element == "link"){
        if($args == "active"){
            echo '<li class="nav-item active">
            <a class="nav-link" href="'.$links_to.'">'.$name.'</a>
            </li>';
        }else{
            echo '<li class="nav-item">
            <a class="nav-link" href="'.$links_to.'">'.$name.'</a>
            </li>';
        }
    }
    if($element == "dropdown"){
        echo '<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="'.$links_to.'" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        '.$name.'
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        '.$args.'
        </div>
        </li>';
    }
    if($element == "search"){
        echo '<form class="form-inline my-2 my-lg-0" action="'.$links_to.'" method="'.$args.'">
        <input class="form-control mr-sm-2" type="search" placeholder="'.$name.'" aria-label="'.$name.'" name="query">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">'.$name.'</button>
        </form>';
    }
    if($element == "lead_link"){
        echo '<a class="btn btn-outline-'.$args.' my-2 my-sm-0" href="'.$links_to.'">'.$name.'</a>';
    }

}

function create_dropdown_element($element, $links_to, $name){
    if($element == "link"){
        return '<a class="dropdown-item" href="'.$links_to.'">'.$name.'</a>';
    }

    if($element == "divider"){
        return '<div class="dropdown-divider"></div>';
    }
}

function navbar_swap_alignment(){
    echo "</ul>";
}

function navbar_finish(){
    echo '</div>
    </nav>';
}

function create_alert($content, $style){
    return '<div class="alert alert-'.$style.'" role="alert">'.$content.'</div>';
}

function create_dismissable_alert($content, $style){
    return '<div class="alert alert-'.$style.'" role="alert">'.$content.'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button></div>';
}




?>
