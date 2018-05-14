<?php

namespace App\DataTables;

use App\User;
use App\daftarPresensi;
use Yajra\DataTables\Services\DataTable;
use Auth;
use Carbon\Carbon;

class presensiDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
        ->addColumn('action', function ($datatb) {
          $id = $datatb->id;
            return
            '<button data-id="'.$id.'" data-nama="'.$datatb->karyawan->nama.'" class="delete-modal btn btn-xs btn-danger" type="submit"><i class="fa fa-trash"></i> Delete</button>';
        })
        ->editColumn('waktu_absen', function ($datatb) {
            return $datatb->waktu_absen ? with(new Carbon($datatb->waktu_absen))->format('d/m/Y h:i:s a') : '';
        })
        ->editColumn('waktu_logout', function ($datatb) {
            return $datatb->waktu_logout ? with(new Carbon($datatb->waktu_logout))->format('d/m/Y h:i:s a') : '';
        })
        ->editColumn('durasi_pekerjaan', function ($datatb) {
          return
          date("h \j\a\m\,\ i \m\\e\\n\\i\\t", strtotime($datatb->durasi_pekerjaan));
        });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(daftarPresensi $model)
    {
        return $query = daftarPresensi::with('karyawan')->where('id_manajer','=',Auth::User()->id);;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->parameters([
                          'dom' => 'Bfrtip',
                          'buttons' => ['csv', 'excel', 'print'],
                      ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
          'id' => ['data' => 'id', 'name' => 'id'],
          'email' => ['data' => 'karyawan.email', 'email' => 'karyawan.email'],
          'nama' => ['data' => 'karyawan.nama', 'nama' => 'karyawan.nama'],
          'lokasi_absen' => ['data' => 'lokasi_absen', 'lokasi_absen' => 'lokasi_absen'],
          'waktu_absen' => ['data' => 'waktu_absen', 'waktu_absen' => 'waktu_absen'],
          'waktu_logout' => ['data' => 'waktu_logout', 'waktu_logout' => 'waktu_logout'],
          'durasi_pekerjaan' => ['data' => 'durasi_pekerjaan', 'durasi_pekerjaan' => 'durasi_pekerjaan'],
          'action' => ['data' => 'action', 'name' => 'action', 'orderable'=> false, 'searchable' => false],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'presensi_' . date('YmdHis');
    }
}
