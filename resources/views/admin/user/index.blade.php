@extends('admin.layouts.master')

@section('title', 'Data Warga')

@section('css')
<link href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/magnific-popup/magnific-popup.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<!-- start page title -->
<div class="row align-items-center">
  <div class="col-sm-6">
    @component('admin.components.breadcumb')
    @slot('title') Data Warga  @endslot
    @slot('li_1') Warga @endslot
    @endcomponent
  </div>

  <div class="col-sm-6">
    <div class="float-right d-none d-md-block">
      <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle waves-effect waves-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="mdi mdi-gesture-spread mr-2"></i> Action
        </button>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="{{ route('admin.users.create') }}">Tambah Data</a>
          <a class="dropdown-item" href="javascript: void(0);" data-toggle="modal" data-target=".import-modal">Import</a>
        </div>
        <div class="modal fade import-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title mt-0">Import Data Warga</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
              <div class="modal-body">
                <form class="custom-validation" method="POST" action="{{ route('admin.import.data') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group row">
                    <label for="file_import" class="col-sm-2 col-form-label">File</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="file" name="file_import" id="file_import" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                      <p class='help-block'>Silahkan Download File Samplenya Disini.</p>
                    </div>
                  </div>
                  <div class="form-group mb-0">
                    <div>
                      <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                        Submit
                      </button>
                      <a class="btn btn-secondary waves-effect waves-light" role="button" data-dismiss="modal" aria-hidden="true">Cancel</a>
                    </div>
                  </div>
                </form>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
      </div>
    </div>
  </div>
</div>     
<!-- end page title -->

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">

        <h4 class="card-title">Data Warga</h4>
        @include('admin.components.message')
        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
          <thead>
            <tr>
              <th>Foto</th>
              <th>NIK</th>
              <th>Nama</th>
              <th>TTL</th>
              <th>Jenis Kelamin</th>
              <th>Alamat</th>
              <th>Status Perkawinan</th>
              <th>Pekerjaan</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
            <tr>
              <td>
                <a class="image-popup-no-margins" href="{{ asset($user->photo) }}">
                  <img class="img-fluid" alt="{{ $user->name }}" src="{{ asset($user->photo) }}" width="24">
                </a>
              </td>
              <td>{{ $user->sin }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->getPsb() }}</td>
              <td>{{ $user->getShortGender() }}</td>
              <td>{{ $user->address ?? '-' }}</td>
              <td>{{ $user->marital_status }}</td>
              <td>{{ $user->proffesion ?? '-' }}</td>
              <td>
                <a class="btn btn-sm btn-warning waves-effect waves-light" href="{{ route('admin.users.edit', $user->id) }}" role="button"><i class="mdi mdi-grease-pencil"></i></a>
                <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="d-inline form-delete">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger waves-effect waves-light"><i class="mdi mdi-trash-can"></i></button>
                </form>
                <a class="btn btn-sm btn-info waves-effect waves-light" href="{{ route('admin.users.show', $user->id) }}" role="button"><i class="mdi mdi mdi-eye-circle"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div> <!-- end col -->
</div> <!-- end row -->

@endsection

@section('script')

<!-- Plugins js -->
<script src="{{ URL::asset('assets/libs/datatables/datatables.min.js')}}"></script>
<script src="{{ URL::asset('assets/libs/magnific-popup/magnific-popup.min.js')}}"></script>
<script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

<script src="{{ URL::asset('assets/js/pages/datatables.init.js')}}"></script>
<script src="{{ URL::asset('assets/js/pages/lightbox.init.js')}}"></script>

<script type="text/javascript">
  $(document).on('submit', '.form-delete', function (e) {
    var form = this;
    e.preventDefault();
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#34c38f",
      cancelButtonColor: "#f46a6a",
      confirmButtonText: "Yes, delete it!"
    }).then(function (result) {
      if (result.value) {
        return form.submit();
      }
    });
  }); 
</script>

@endsection