@extends('layout.pimpinanLayout')
@section('content')
<style>
    table {
      border-spacing: 0;
      width: 100%;
      border: 1px solid #ddd;
    }
    
    th {
      cursor: pointer;
    }
    
    th, td {
      text-align: left;
      padding: 16px;
    }
    
    tr:nth-child(even) {
      background-color: #f2f2f2
    }
</style>
<div class="container-fluid pt-4 px-4">
    <div class="col-10 tableContent g-4">
        <div class="bg-light rounded h-100 p-4">
            <h2 class="mb-4 text-center">Data Laporan</h2>
            <div class="table-responsive">
                <table class="table align-middle text-center" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">SATKER</th>
                            <th scope="col">Nama User</th>
                            <th scope="col" onclick="sortTable(3)">Tanggal</th>
                            <th scope="col">Insiden Type</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Penanganan</th>
                            <th scope="col" onclick="sortTable(7)">Status</th>
                            <th scope="col">Bukti</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach($reports as $report)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $report->satker }}</td>
                            <td>{{ $report->user->nama_user }}</td>
                            <td>{{ $report->tanggal }}</td>
                            <td>{{ $report->insiden_type }}</td>
                            <td>{{ $report->keterangan }}</td>
                            <td>{{ $report->penanganan }}</td>
                            <td>{{ $report->status }}</td>
                            <td>
                                @if($report->bukti)
                                    <img src="{{ Storage::url('/' . $report->bukti) }}" alt="Bukti" style="max-width: 100px; max-height: 100px;">
                                @else
                                    No Image
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<script>
function sortTable(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("myTable");
    switching = true;
    //Set the sorting direction to ascending:
    dir = "asc"; 
    /*Make a loop that will continue until
    no switching has been done:*/
    while (switching) {
      //start by saying: no switching is done:
      switching = false;
      rows = table.rows;
      /*Loop through all table rows (except the
      first, which contains table headers):*/
      for (i = 1; i < (rows.length - 1); i++) {
        //start by saying there should be no switching:
        shouldSwitch = false;
        /*Get the two elements you want to compare,
        one from the current row and one from the next:*/
        x = rows[i].getElementsByTagName("TD")[n];
        y = rows[i + 1].getElementsByTagName("TD")[n];
        /*check if the two rows should switch place,
        based on the direction, asc or desc:*/
        if (dir == "asc") {
          if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            //if so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        } else if (dir == "desc") {
          if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
            //if so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
          }
        }
      }
      if (shouldSwitch) {
        /*If a switch has been marked, make the switch
        and mark that a switch has been done:*/
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
        //Each time a switch is done, increase this count by 1:
        switchcount++;      
      } else {
        /*If no switching has been done AND the direction is "asc",
        set the direction to "desc" and run the while loop again.*/
        if (switchcount == 0 && dir == "asc") {
          dir = "desc";
          switching = true;
        }
      }
    }
}
</script>
@endpush

@section('title','Pimpinan | Report Managemen')
