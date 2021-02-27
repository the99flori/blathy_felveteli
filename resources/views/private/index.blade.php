
@extends('private.layout')

@section('content')

    Meetings:

    <table>
        <tr>
            <td>Datetime</td>
            <td>Student</td>
            <td>Note</td>
        </tr>
        @foreach($meetings as $meeting)
            <tr>
                <td>
                    {{$meeting->datetime}}
                </td>
                <td>
                    {{$meeting->stundet->name}}
                </td>
                <td>
                    {{$meeting->student->note}}
                </td>
            </tr>
        @endforeach
    </table>


@endsection
