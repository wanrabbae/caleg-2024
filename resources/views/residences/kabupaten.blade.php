@extends('layouts.admin')

@section("content")
<div class="card shadow mb-4">
    <div class="card-header py-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                <i class="fas fa-plus"></i>
                Kabupaten
            </button>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <div class="table-responsive">
          <div class="d-flex justify-content-between flex-column flex-md-row">
            <div>
              <form action="" method="GET" class="d-block mb-2">
              @if (request()->has("search"))
              <input type="hidden" name="search" id="search" value="{{ request("search") }}" pattern="[a-zA-Z0-9@\s]+">
              @endif
              <span class="d-block">Data Per Page</span>
                <input type="number" name="paginate" id="paginate" list="paginates" value="{{ request("paginate") }}">
                <datalist id="paginates">
                  <option value="25">25</option>
                  <option value="50">50</option>
                  <option value="75">75</option>
                  <option value="100">100</option>
                </datalist>
              </form>
            </div>
            <div>
              <form action="" method="GET" class="d-block mb-2" onsubmit="return !/[^\w\d@\s]/gi.test(this['search'].value)">
                @if (request()->has("paginate"))
                <input type="hidden" name="paginate" id="paginate" list="paginates" value="{{ request("paginate") }}">
                @endif
                <span class="d-block">Search</span>
                <input type="text" name="search" id="search" value="{{ request("search") }}" pattern="[a-zA-Z0-9@\s]+">
              </div>
            </form>
          </div>
            {{ $dataArr->links() }}
            <table class="table table-bordered" id="" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kabupaten</th>
                        <th>Nama Provinsi</th>
                        <th>Daerah Pemilihan</th>
                        <th>Jumlah Dapil</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($dataArr->count())
                        @foreach($dataArr as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->nama_kabupaten }}</td>
                                <td>{{ $data->provinsi->nama_provinsi }}</td>
                                <td>{{ $data->dapil == 0 ? "Tidak Ada" : $data->dapil }}</td>
                                <td>{{ $data->jumlah_dapil == 0 ? "Tidak Ada" : $data->jumlah_dapil }}</td>
                                <td class="d-flex justify-content-center">
                                    <button class="btn btn-warning mx-3 getData" value={{ $data->id_kabupaten }} data-target="#editModal" data-toggle="modal">
                                        <i class="fas fa-edit"></i>
                                   </button>
                                    <form action="{{ asset('kabupaten/' . $data->id_kabupaten) }}" method="POST" class="d-inline">
                                        @method("delete")
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Create --}}
  <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createModalLabel">Tambah Kabupaten</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ asset('kabupaten') }}" method="POST">
        <div class="modal-body">
                @csrf
                <div class="form-group">
                  <label for="kabupaten">Nama Kabupaten</label>
                  <input type="text" class="form-control" id="kabupaten" placeholder="Nama Kabupaten" name="nama_kabupaten">
                </div>
                <div class="form-group">
                  <label for="provinsi">Pilih Provinsi</label>
                  <select class="form-control" name="id_provinsi" id="provinsi">
                      <option value="">Pilih Provinsi</option>
                      @foreach ($provinsi as $item)
                      <option value="{{ $item->id_provinsi }}">{{ $item->nama_provinsi }}</option>
                      @endforeach
                  </select>
              </div>
                <div class="form-group">
                  <label for="dapil">Pilih Dapil</label>
                  <select class="form-control" name="dapil" id="dapil">
                      <option value="">Pilih Provinsi Dahulu</option>
                  </select>
              </div>
              <div class="form-group">
                <label for="jumlah_dapil">Jumlah Dapil</label>
                <input type="number" class="form-control" id="jumlah_dapil" placeholder="Jumlah Dapil" name="jumlah_dapil">
              </div>
            </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="">
                  <button type="submit" class="btn btn-primary">Tambah</button>
                </a>
              </div>
            </form>
      </div>
    </div>
  </div>

  {{-- Edit Modal --}}
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Kabupaten</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" id="edit_form" method="POST">
            <div class="modal-body">
                @method('put')
                @csrf
                <div class="form-group">
                    <label for="kabupaten">Nama Kabupaten</label>
                    <input type="text" class="form-control" id="edit_kabupaten" placeholder="Nama Kabupaten" name="nama_kabupaten">
                </div>
                <div class="form-group">
                  <label for="provinsi">Pilih Provinsi</label>
                  <select class="form-control" name="id_provinsi" id="edit_provinsi">
                      @foreach ($provinsi as $item)
                      <option value="{{ $item->id_provinsi }}">{{ $item->nama_provinsi }}</option>
                      @endforeach
                  </select>
              </div>
              <div class="form-group">
                  <label for="dapil">Pilih Dapil</label>
                  <select class="form-control" name="dapil" id="edit_dapil">
                      <option value="">Pilih Provinsi</option>
                  </select>
              </div>
              <div class="form-group">
                <label for="edit_jumlah_dapil">Jumlah Dapil</label>
                <input type="number" class="form-control" id="edit_jumlah_dapil" placeholder="Jumlah Dapil" name="jumlah_dapil">
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </a>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@section("script")
  <script>
  $(document).ready(function() {
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    }
});

  let getData = e => {
    $.ajax({
        url: `{{ asset('kabupaten') }}`,
        method: "POST",
        data: {
          getData: true,
          data: e.currentTarget.value
        },
        dataType: "json",
        success: resp => {
            $("#edit_form").attr("action", `{{ asset('kabupaten/${resp.id_kabupaten}') }}`);
            $("#edit_kabupaten").val(resp.nama_kabupaten);
            $("#edit_provinsi").val(resp.id_provinsi);
            $("#edit_jumlah_dapil").val(resp.jumlah_dapil);
        } 
      })
  }

  let getDapil = e => {
    $.ajax({
        url: `{{ asset('kabupaten') }}`,
        method: "POST",
        data: {
          getDapil: true,
          data: e.currentTarget.value
        },
        dataType: "json",
        success: resp => {
          if (!e.currentTarget.id.includes("edit")) {
            $("#dapil").html(resp ? resp : "<option value=''>Tidak Ada Dapil</option>");
          } else {
            $("#edit_dapil").html(resp ? resp : "<option value=''>Tidak Ada Dapil</option>");
          }
        } 
      })
  }

  $(".getData").on("click", getData);
  $("#provinsi").on("change", getDapil);
  $("#edit_provinsi").on("change", getDapil);
  })
</script>
@endsection