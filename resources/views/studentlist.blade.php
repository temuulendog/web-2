<h1>List of Student</h1>

<ol>
@foreach($students as $student)
    <li>{{$student[0]}}</li>
@endforeach
</ol>