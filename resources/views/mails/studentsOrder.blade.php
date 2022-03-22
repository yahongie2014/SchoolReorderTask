@extends('layouts.mail')

@section('content')
<div>
    <h1>{{__('Student Reorderd')}} </h1>

    <table>
        <tr>
            <th>Student name</th>
            <th>Student Order</th>
            <th>Student School</th>
        </tr>
        <tr>
            <td>{{ $reorder_students['student']['name'] }}</td>
            <td>{{ $reorder_students['student']['order'] }}</td>
            <td>{{ $reorder_students['student']['school'] }}</td>
        </tr>
    </table>
</div>
@endsection