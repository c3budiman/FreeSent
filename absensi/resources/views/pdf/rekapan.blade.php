<table>
  <thead>
    <tr>
      <th> Id</th>
      <th >Email</th>
      <th >Nama</th>
      <th >Lokasi Absen</th>
      <th >Waktu Absen</th>
      <th >Waktu Logout</th>
      <th >Durasi Pekerjaan</th>
    </tr>
  </thead>

    @foreach ($rekapan as $res)
        <tr>
          <td>{{$res->id_tabel}}</td>
          <td>{{$res->karyawan->email}}</td>
          <td>{{$res->karyawan->nama}}</td>
          <td>{{$res->lokasi_real}}</td>
          <td>{{$res->waktu_absen}}</td>
          <td>{{$res->waktu_logout}}</td>
          <td>{{$res->durasi_pekerjaan}}</td>
        </tr>
      @endforeach
  </table>
