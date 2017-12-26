<!DOCTYPE html>
<html>
<head>
  <title></title>
  <style type="text/css">
    table, th, td {
      padding: 5px;
    border: 1px solid black;
    border-collapse: collapse;
}
  </style>
</head>
<body>

  <h1>Performance Report</h1>
  <br>

  <p><strong>Name : </strong>{{$user->username}}</p>
  <p><strong>Current Active Group : </strong> 
    @foreach($user->user_groups as $group)
      {{ $group->group->name }}              
    @endforeach</p>
  <div class="box-body no-padding">
    <table class="table table-striped">
      <tr>
        <th style="width: 10px">#</th>
        <th>Course</th>
        <th>Teacher</th>
        <th>Group</th>
        <th style="width: 40px">Grade</th>
      </tr>                
      @for($i=0 ; $i < sizeof($grades) ; $i++)
      <tr>
        <td>{{ $i+1 }}</td>
        <td>{{$grades[$i]->course->title }}</td>
        <td>
          {{$grades[$i]->teacher->username }}
        </td>
        <td>
          {{$grades[$i]->group->name }}
        </td>
        @if(in_array($grades[$i]->value,["A","AB","B","BC"]))
        <td><span class="badge bg-green">{{$grades[$i]->value}}</span></td>      
        @elseif($grades[$i]->value == "C")          
        <td><span class="badge bg-yellow">{{$grades[$i]->value}}</span></td>  
        @else
        <td><span class="badge bg-red">{{$grades[$i]->value}}</span></td> 
        @endif
      </tr>
      @endfor

    </table>
  </div>

</body>
</html>
