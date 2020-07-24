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
.x1{
    border-radius: 25px;
    border: 2px solid black; 
    background-color: gray; 
    padding: 10px
}
</style>

@if(isset($head))
    <script>
    $(document).ready(function(){
    $("#store_task").modal('show');
    });</script> 
@endif


<body>
    <div class="container x1" style="border: 2px solid black">
    @include('flash::message')
        <div class="row"> 
            <div class="col">
                <a class="btn btn-primary float-right" href="{{route('home')}}" style="padding: 15px; margin-top: 15px">Home</a>
            </div>
         
            <div class="col">
                <h2 style="text-align: center; margin-top: 15px" >Your Finished Tasks</h2>
            </div>
            
            <div class="col">
                <a class="btn btn-danger float-right" href="{{route('deleteAll')}}" style="padding: 15px; margin-top: 15px">Delete All</a>
            </div>
            
        </div>
        <hr>
        <table  id="usersTable" class="w3-table-all">
            <tr>
                <th scope="">Name</th>
                <th scope="">Description</th>
                <th scope="">Priority</th>
                <th scope="">Data</th>
                <th scope="">Actions</th>
            </tr>
            
            @foreach($data as $value)
            <tr class="item">
                <td width="40%">{{$value->task_name}}</td>
                <td width="30%">{{$value->description}}</td>
                <td class=""@if($value->priority == 'low') style="background-color: green" @endif
                            @if($value->priority == 'medium') style="background-color: orange" @endif 
                            @if($value->priority == 'high') style="background-color: red; color:white" @endif
                            @if($value->priority == 'immediately') style="background-color: black; color:white" @endif>{{$value->priority}}</td>
                <td class="">{{$value->date}}</td>
                <td width="10%"><a class="btn btn-danger" href="{{route('delete', $value->id)}}">Delete</a></td>
            </tr>
            @endforeach
        </table>
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
