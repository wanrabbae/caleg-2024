@extends('layouts.admin')

@section('content')
<div class="card shadow mb-4">
    {{-- <div class="card-header py-3">
    </div> --}}

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nik</th>
                        <th>Nama Relawan</th>
                        <th>Upline</th>
                        <th>Desa</th>
                        <th>KTP</th>
                        <th>Caleg</th>
                        <th>Status</th>
                        <th>No Hp</th>
                        <th>E-mail</th>
                        <th>Username</th>
                        <th>Blokir</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data->count())
                        @foreach ($data as $data)
                            <tr>
                                <td>{{ $data->id_relawan }}</td>
                                <td>{{ $data->nik }}</td>
                                <td>
                                    <button class="text-nowrap btn @if ($data->loyalis == 1) btn-success @elseif ($data->loyalis == 2) btn-warning @else btn-danger @endif" data-toggle="modal" data-target="#editLoyalModal"
                                        onclick="getLoyalis({{ $data->id_relawan }})"
                                        >
                                        {{ $data->nama_relawan }}
                                    </button>
                                </td>
                                <td>
                                    {{ $data->upline }}
                                </td>
                                <td>{{ $data->desa->nama_desa }}</td>
                                <td>
                                    @if (Storage::exists($data->foto_ktp))
                                        <img src="{{ asset('storage/' . $data->foto_ktp) }}" alt="" style="width: 200px">
                                    @else
                                        <i class="fas fa-image"></i>
                                        <span>Image Not Found</span>
                                    @endif
                                </td>
                                <td>{{ $data->caleg->nama_lengkap ?? ' ' }}</td>
                                <td>{{ $data->status }}</td>
                                <td>{{ $data->no_hp }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->username }}</td>
                                <td>{{ $data->blokir }}</td>
                                <td>
                                    <a href="{{ asset("team/upline/$data->id_relawan") }}">
                                        <button class="btn btn-warning">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </a>
                                    <button class="btn btn-primary" onclick="getData({{ $data->id_relawan }})" data-toggle="modal" data-target="#editModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="/team/{{ $data->id_relawan }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" onclick="return confirm('Anda yakin ingin menghapus data ini ?')" class="btn btn-danger">
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
@endsection