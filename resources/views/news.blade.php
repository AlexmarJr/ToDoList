@extends('layouts.app')


@section('content')
<body>
    <div class="container" style="border: 2px solid black">
        <div class="row"> 
            <div class="col">
                <button class="btn btn-success" style="padding: 15px; margin-top: 15px">Add Task</button>
            </div>
         
            <div class="col">
                <h2 style="text-align: center; margin-top: 15px" >Your Tasks</h2>
            </div>
            
            <div class="col">
                <button class="btn btn-primary float-right" style="padding: 15px; margin-top: 15px">Historic</button>
            </div>
        </div>
        <hr>
    </div>




    <div class="content">
        <?php 
        $url = "http://newsapi.org/v2/top-headlines?sources=google-news-br&apiKey=1c3d750ef01d454f889b2c1b65d5a5fe";
        $response = file_get_contents($url);
        $NewsData = json_decode($response);
        ?>
    </div>


    <!-- Large modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Noticias!</button>

    <div class="modal fade bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="container fluid">
        <h2 style="text-align: center">API de autoria de: <a href="https://newsapi.org/">News API!</h2></span>
        <hr>
            <?php
                foreach($NewsData->articles as $News){
            ?>
            <div class="row grid">
                <div class="col-md-4">
                    <img class="img-q" src="<?php echo $News->urlToImage?>" >
                </div>
                <div class="col-md-8" style="text-align: center">
                    <h2><a href="<?php echo $News->url?>" style="color: black"> <?php echo $News->title ?> </a></h2>
                    <h5><?php echo $News->description?></h5>
                    <p><?php echo $News->content ?></p>
                    <h6>Autor: <?php echo $News->author?></h6>
                    <h6>Data: <?php echo $News->publishedAt ?></h6>
                </div>           
            <div>
            <hr>
            <?php }?>
            
        </div>
        <div>
    </div>
    </div>
</body>
<style>
body {
    background-image: url('/img/back.jpg');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: 100% 100%;
    }

.fluid{
    padding: 15px;
    border: 1px solid black
}
hr{
    margin: 25px;
    border:1px solid black
}
.img-q{
    height: 200px;
    width: 200px;
}

.grid{
    margin: 1px;
}
</style>

<script>
$(document).ready(function () {

$("#sidebar").mCustomScrollbar({
     theme: "minimal"
});

$('#sidebarCollapse').on('click', function () {
    $('#sidebar').toggleClass('active');
});

});

$(document).ready(function () {

$("#sidebar").mCustomScrollbar({
     theme: "minimal"
});

$('#sidebarCollapse').on('click', function () {
    // open or close navbar
    $('#sidebar').toggleClass('active');
    // close dropdowns
    $('.collapse.in').toggleClass('in');
    // and also adjust aria-expanded attributes we use for the open/closed arrows
    // in our CSS
    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
});

});
</script>
@endsection