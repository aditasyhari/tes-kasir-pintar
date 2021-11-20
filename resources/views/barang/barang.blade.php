@extends('layouts.app')

@section('title') Stok Barang @endsection

@section('content')

<div class="card p-3">
    <div class="d-flex justify-content-between">
        <h3>Stok Barang</h3>
        @auth
            <button class="btn btn-primary" data-toggle="modal" data-target="#add">Tambah</button>

            <!-- Modal Tambah -->
            <div class="modal fade" id="add" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLabel">Tambah Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-add" action="{{ url('barang') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nama_barang">Nama Barang</label>
                                <input type="text" class="form-control" name="nama_barang" id="nama-barang" required>
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah Barang</label>
                                <input type="number" class="form-control" name="jumlah" id="jumlah" min="1" value="1" required>
                            </div>
                            <div class="form-group form-check">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" id="tanggal" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        @endauth

    </div>

    <table id="table" class="display expandable-table w-100">
        <div id="outside" class="mb-3"></div>
        <thead class="thead-light">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Jumlah Barang (pcs)</th>
                <th scope="col">Tanggal</th>
                @auth
                    <th scope="col">Aksi</th>
                @endauth
            </tr>
        </thead>
        <tbody id="table-list">
            @auth
                @if(Auth::user()->role == 'admin')
                    @foreach($barang as $b)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $b->data()['nama_barang'] }}</td>
                            <td>{{ $b->data()['jumlah'] }}</td>
                            <td>{{ $b->data()['tanggal'] }}</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" id="getEditData" data-id="{{ $b->id() }}">Edit</button>
                                <button class="btn btn-danger btn-sm" id="getDeleteId" data-id="{{ $b->id() }}" data-toggle="modal" data-target="#modalDelete">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    @foreach($barang as $b)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $b->data()['nama_barang'] }}</td>
                            <td>{{ $b->data()['jumlah'] }}</td>
                            <td>{{ $b->data()['tanggal'] }}</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" id="getEditData" data-id="{{ $b->id() }}">Edit</button>
                            </td>
                        </tr>
                    @endforeach
                @endauth
            @else
                @foreach($barang as $b)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $b->data()['nama_barang'] }}</td>
                        <td>{{ $b->data()['jumlah'] }}</td>
                        <td>{{ $b->data()['tanggal'] }}</td>
                    </tr>
                @endforeach
            @endauth
        </tbody>
    </table>

    <!-- Edit Modal -->
    <div class="modal" id="modalEdit" tabindex="-1" aria-labelledby="modalEditlLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Barang</h4>
                    <button type="button" class="close modelClose" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                        <strong>Berhasil ! </strong>Barang berhasil diperbarui.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form-edit" action="{{ url('barang/update') }}" method="POST">
                        @method('put')
                        @csrf
                        
                        <div id="EditModalBody">
                                
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="SubmitEditForm">Update</button>
                    <button type="button" class="btn btn-danger modelClose" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeletelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Barang</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin menghapus ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="SubmitDeleteForm">Iya</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('js')
    @if(session('status'))
        <script>
            $(function() {
                $('#status').modal('show');
            });
        </script>

        <!-- Modal Status -->
        <div class="modal fade" id="status" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="statusLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="statusLabel">Berhasil !!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ session('status') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });

        var id;
        $('body').on('click', '#getEditData', function(e) {
            e.preventDefault();
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "barang/"+id+"/edit",
                method: 'GET',
                success: function(result) {
                    $('#EditModalBody').html(result.html);
                    $('#modalEdit').modal('show');
                }
            });
        });

        var deleteID;
        $('body').on('click', '#getDeleteId', function(){
            deleteID = $(this).data('id');
        })
        $('#SubmitDeleteForm').click(function(e) {
            e.preventDefault();
            var id = deleteID;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "barang/"+id,
                method: 'DELETE',
                success: function(result) {
                    $('#modalDelete').modal('hide');
                    location.reload();
                }
            });
        });

    </script>
@endsection