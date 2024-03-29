@extends('dashboard.layout')

@section('title', 'Tanulók kezelése')

@section('content')
    <div class="container-fluid">
        <h3 class="text-dark mb-4">Tanulók kezelése</h3>
        <div class="card shadow">
            <div class="card-body">
                <p class="text-warning card-text"><strong><em>Egyszerre csak egy fajta szűrés lehetséges!</em></strong></p>
                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table table-hover my-0" id="dataTable">
                        <thead class="table-light">
                        <tr>
                            <th class="justify-content-center">Oktatási azonosító<br><input class="form-control-sm" type="text" id="filterEduID" placeholder="KERESÉS" onkeyup="filterString(&#39;filterEduID&#39;,0)"><br></th>
                            <th>Tanuló neve<br><input class="form-control-sm" type="text" id="filterName" placeholder="KERESÉS" onkeyup="filterString('filterName',1)"><br></th>
                            <!--th>Időpont<br><input class="form-control-sm" type="text" id="filterBorn" placeholder="KERESÉS" onkeyup="filterString('filterBorn',2)"><br></th-->
                            <th class="text-center">Felvettük?<br><!--input class="form-control-sm" type="text" id="filterRoom" placeholder="KERESÉS" onkeyup="filterString('filterRoom',3)"--><br></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $student)
                        {{--<tr @if($student->centralExam->isSpecial && $student->files->where('type', 'special_decree')->first()!=NULL) class="table-warning" @elseif($student->centralExam->isSpecial) class="table-danger" @endif> --}}
                        <tr>
                            <td><a href="{{route('dashboard.student.oralexam.index', $student->id)}}" style="text-decoration: none;"><strong>{{$student->eduId}}</strong><br></a></td>
                            <td>{{$student->name}}</td>
                            <!--td>@isset($student->meeting->datetime){{date("Y.m.d. H:i", strtotime($student->meeting->datetime))}}@endisset</td-->
                            <td class="text-center">
                                @isset($student->result->final)
                                    @if($student->result->final == "0000")
                                        <i class="text-danger">NEM</i>
                                    @else
                                        <strong class="text-success">{{$student->result->final}}</strong>
                                    @endif
                                @endisset
                            </td>
                            <!--td class="text-center">
                                @if(isset($student->meeting->panel->room) && $student->meeting->panel->room!=NULL)
                                    {{$student->meeting->panel->room}}
                                @elseif(isset($student->meeting->note))
                                    <i>{{$student->meeting->note}}</i>
                                @else
                                    <i>nincs beosztva</i>
                                @endif
                            </td-->
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function filterString(element, no) {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById(element);
            filter = input.value.toUpperCase();
            table = document.getElementById("dataTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[no];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

@endsection
