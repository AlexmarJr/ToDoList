@extends('layouts.app')

@section('content')
<head>
    <script src="https://www.w3schools.com/lib/w3.js"></script>
    <link href="https://www.w3schools.com/w3css/4/w3.css" rel="stylesheet" />
</head>
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
th {
  cursor: pointer;
  background-color: coral;
}
option, td{
    text-transform: uppercase;
    word-break:break-word
}
</style>

@if(isset($head))
    <script>
    $(document).ready(function(){
    $("#store_task").modal('show');
    });</script> 
@endif


<body>
<button class="btn btn-primary" data-toggle="modal" data-target=".news-modal" style="padding: 15px;">Stay Updated</button>
    <div class="container" style="border: 2px solid black">
    @include('flash::message')
        <div class="row"> 
            <div class="col">
                @if(isset($head))
                <a class="btn btn-warning" style="padding: 15px; margin-top: 15px" href="{{route('home')}}">Back</a>
                @else
                <button class="btn btn-success" style="padding: 15px; margin-top: 15px" data-toggle="modal" data-target="#store_task">Add Task</button>
                @endif
            </div>
         
            <div class="col">
                <h2 style="text-align: center; margin-top: 15px" >Your Tasks</h2>
            </div>
            
            <div class="col">
                <a class="btn btn-primary float-right" href="{{route('historic')}}" style="padding: 15px; margin-top: 15px">Historic</a>
            </div>
        </div>
        <hr>
        <table  id="usersTable" class="w3-table-all">
            <tr>
                <th scope="">Name</th>
                <th scope="">Priority</th>
                <th scope="">Data</th>
                <th scope="">Actions</th>
            </tr>
            
            @foreach($data as $value)
            <tr class="item">
                <td width="53%">{{$value->task_name}}</td>
                <td class=""@if($value->priority == 'low') style="background-color: green" @endif
                            @if($value->priority == 'medium') style="background-color: orange" @endif 
                            @if($value->priority == 'high') style="background-color: red; color:white" @endif
                            @if($value->priority == 'immediately') style="background-color: black; color:white" @endif>{{$value->priority}}</td>
                <td class="">{{$value->date}}</td>
                <td width="25%"><a class="btn btn-primary" href="{{route('read', $value->id)}}">Details</a> <a class="btn btn-warning"  href="{{route('update', $value->id)}}">Finish</a> <a class="btn btn-danger" href="{{route('delete', $value->id)}}">Delete</a></td>
            </tr>
            @endforeach
        </table>
    </div>

    <!-- New Task Modal -->
    <form action="{{route('store_task')}}" method="post" autocomplete="off" enctype="multipart/form-data">
    @csrf>
    @if(isset($head))
    <input type="hidden" name="id" value="{{$head->id}}">
    @endif
    <div class="modal fade store_task-lg" id="store_task" tabindex="-1" role="dialog" aria-labelledby="storage_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="storage_modal_title">Add Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-9">
                        <label>Task Name</label>
                        <input class="form-control" name="task_name" placeholder="Task Name" style="text-transform: uppercase" @if(isset($head)) value='{{$head->task_name}}') @endif required>
                    </div>
                    <div class="col-sm-3">
                        <label>Priority</label>
                        <select class="form-control" name="priority">
                            <option value="low" style="color: green" @if(isset($head) && ($head->priority == "low")) selected @endif>LOW</option>
                            <option value="medium" style="color: orange" @if(isset($head) && ($head->priority == "medium")) selected @endif>MEDIUM</option>
                            <option value="high" style="color: red" @if(isset($head) && ($head->priority == "high")) selected @endif>HIGH</option>
                            <option value="immediately" style="color: black" @if(isset($head) && ($head->priority == "immediately")) selected @endif>IMMEDIATELY</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="form-group row justify-content-md-center">
                    <div class="col-md-3">
                        <label for="example-datetime-local-input" class="col-4 col-form-label">Date </label>
                        <input class="form-control" name="date" type="date" placeholder="2020-03-25" @if(isset($head)) value="{{$head->date}}" @endif>
                    </div>
                    <div class="col-md-3">
                        <label for="example-datetime-local-input" class="col-4 col-form-label">Time</label>
                        <input class="form-control" name="time" type="time" @if(isset($head)) value="{{$head->hour}}" @endif>
                    </div>
                </div>
                <hr>
                <div>
                    <label>Description</label>
                    <textarea class="form-control" name="description" rows="4" > @if(isset($head)) {{$head->description}} @endif</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            </div>
        </div>
    </div>
    </form>


    <!-- News modal -->
    
    <div class="content">
        <?php 
        $url = "http://newsapi.org/v2/top-headlines?sources=google-news-br&apiKey=1c3d750ef01d454f889b2c1b65d5a5fe";
        $response = file_get_contents($url);
        $NewsData = json_decode($response);
        ?>
    </div>
    
    <div class="modal fade news-modal" role="dialog">
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
                    </div>
                    <hr>
                    <?php }?>
                    
                </div>
            </div>
        </div>
    </div>
</body>

<script>

let tid = "#usersTable";
let headers = document.querySelectorAll(tid + " th");

// Sort the table element when clicking on the table headers
headers.forEach(function(element, i) {
  element.addEventListener("click", function() {
    w3.sortHTML(tid, ".item", "td:nth-child(" + (i + 1) + ")");
  });
});

</script>

@endsection
