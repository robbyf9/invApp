@extends('layouts.master')
@section('content')
    <style>
        .content{
            margin-top: 50px;
        }

        #button-add{
            margin-top: -50px;
        }
    </style>

    <div id="app" class="content container">
        <!-- Button trigger modal add barang-->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Launch demo modal
        </button>

        <div id="list-barang">
            <div class="card" style="width: 18rem;">
                <img src="" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">iPhone 13</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item ">Harga : Rp. 13.000.000</li>
                    <li class="list-group-item">Stok : 10</li>
                    <li class="list-group-item">Satuan : 10</li>
                </ul>
                <div class="card-body">
                    <button class="btn btn-warning">  <i class="fas fa-edit" @click.prevent="ubah"></i> Edit</button>
                    <button class="btn btn-danger">  <i class="fas fa-trash" @click.prevent="hapus"></i> Delete</button>
                </div>
            </div>
        </div>

        
        
       <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
    </div>
@endsection
@push('page-script')
    <script>
        const vm = new Vue({
            el: '#app',
            data: {
                tes: ''
            },
            mounted() {

            },
            methods: {
                ubah(){
                    Swal.fire({
                            title: "Yakin ingin mengubah?",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ya, Ubah!',
                            cancelButtonColor: '#d33',
                            cancelButtonText: "Batal"
                        }).then((result) => {

                            if (result.value)
                            {
                            }
                        })
                },
                hapus(){
                    Swal.fire({
                            title: "Yakin ingin menghapus?",
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ya, Hapus!',
                            cancelButtonColor: '#d33',
                            cancelButtonText: "Batal"
                        }).then((result) => {

                            if (result.value)
                            {
                            }
                        })
                }
            }
        });//end v
    </script>
@endpush