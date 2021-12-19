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
        <!-- Button trigger modal add item-->
        <button type="button" class="btn btn-primary" id="button-add" data-bs-toggle="modal" data-bs-target="#modal-add-item">
            <i class="fas fa-plus"> Tambah</i>
        </button>

        <div id="list-item">
            <div class="row">
                @forelse ($items as $item)
                    <div class="col-md-3">
                        <div class="card m-2" style="width: 18rem;">
                            <img src="{{ asset('storage/image/item/' . $item['barang']) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item['nama_item'] }}</h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item ">Harga : Rp. {{ $item['harga_satuan'] }}</li>
                                <li class="list-group-item">Stok : {{ $item['stok'] }}</li>
                                <li class="list-group-item">Unit : {{ $item['unit'] }}</li>
                            </ul>
                            <div class="card-body">
                                <button class="btn btn-warning" @click.prevent="getItemById({{ $item['id'] }})" data-bs-toggle="modal" data-bs-target="#modal-edit-item"><i class="fas fa-edit"></i> Edit</button>
                                <button class="btn btn-danger" @click.prevent="hapus({{ $item['id'] }})"><i class="fas fa-trash"></i> Delete</button>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Kosong</p>
                @endforelse
            </div>
        </div>

        <!-- Modal Add Item-->
        <div class="modal fade" id="modal-add-item" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Form Tambah Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-add-item" @submit.prevent="simpan()">
                            <div class="mb-3">
                                <label for="nama_item" class="form-label">Nama Item</label>
                                <input type="text" class="form-control" id="nama_item" name="nama_item" v-model="form.nama_item" required>
                            </div>
                            <div class="mb-3">
                                <label for="unit" class="form-label">Unit</label>
                                <select class="form-select" id="unit" name="unit" aria-label="Default select example" v-model="form.unit" required>
                                    <option value="" selected disabled>Pilih Unit</option>
                                    <option value="Kg">Kg</option>
                                    <option value="Pcs">Pcs</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="stok" class="form-label">Stok</label>
                                <input type="number" class="form-control" id="stok" name="stok" v-model="form.stok" required>
                            </div>
                            <div class="mb-3">
                                <label for="harga_satuan" class="form-label">Harga Satuan</label>
                                <input type="number" class="form-control" id="harga_satuan" name="harga_satuan" v-model="form.harga_satuan" required>
                            </div>
                            <div class="mb-3">
                                <label for="barang" class="form-label">Barang</label>
                                <input class="form-control" type="file" id="barang" @change="onFileChange" ref="file">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" form="form-add-item" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Item-->
        <div class="modal fade" id="modal-edit-item" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Form Edit Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-edit-item" @submit.prevent="ubah()">
                            <div class="mb-3">
                                <label for="nama_item_e" class="form-label">Nama Item</label>
                                <input type="text" class="form-control" id="nama_item" name="nama_item_e" v-model="formEdit.nama_item">
                            </div>
                            <div class="mb-3">
                                <label for="unit_e" class="form-label">Unit</label>
                                <select class="form-select" id="unit_e" name="unit_e" aria-label="Default select example" v-model="formEdit.unit">
                                    <option selected disabled>Pilih Unit</option>
                                    <option value="kg">Kg</option>
                                    <option value="Pcs">Pcs</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="stok_e" class="form-label">Stok</label>
                                <input type="number" class="form-control" id="stok_e" name="stok_e" v-model="formEdit.stok">
                            </div>
                            <div class="mb-3">
                                <label for="harga_satuan_e" class="form-label">Harga Satuan</label>
                                <input type="number" class="form-control" id="harga_satuan_e" name="harga_satuan_e" v-model="formEdit.harga_satuan">
                            </div>
                            <div class="mb-3">
                                <label for="barang" class="form-label">Barang</label>
                                <input class="form-control" type="file" id="barang_e" @change="onFileChange" ref="fileEdit">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" form="form-edit-item" class="btn btn-primary">Save changes</button>
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
                form: {
                    nama_item: '',
                    unit: '',
                    stok: '',
                    harga_satuan: '',
                    barang: ''
                },
                formEdit: {
                    id: '',
                    nama_item: '',
                    unit: '',
                    stok: '',
                    harga_satuan: '',
                    barang: '',
                    barangLama: ''
                },
            },
            mounted() {
                
            },
            methods: {
                onFileChange(e) {
                    this.form.barang = this.$refs.file.files[0];
                    this.formEdit.barang = this.$refs.fileEdit.files[0];
                },
                getItemById(id){
                    axios.get('/item/get-item-by-id/' + id)
                        .then((response) => {
                            this.formEdit.id = id;
                            this.formEdit.nama_item = response.data.nama_item;
                            this.formEdit.unit = response.data.unit;
                            this.formEdit.stok = response.data.stok;
                            this.formEdit.harga_satuan = response.data.harga_satuan;
                            this.formEdit.barangLama = response.data.barang;
                        })
                },
                simpan(){
                    let formData = new FormData();
                    formData.append('nama_item', this.form.nama_item);
                    formData.append('unit', this.form.unit);
                    formData.append('stok', this.form.stok);
                    formData.append('harga_satuan', this.form.harga_satuan);
                    formData.append('barang', this.form.barang);

                    axios.post('/item/add-item' , formData, {
                        'Content-Type': 'multipart/form-data'
                    })
                    .then((response) => {
                        Swal.fire({
                            title: response.data.responCode == 1 ? 'Berhasil!' : 'Gagal!',
                            text: response.data.respon,
                            icon: response.data.responCode == 1 ? 'success' : 'error',
                        }).then(()=>{
                            location.reload();
                        });
                    })
                },
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
                                let formData = new FormData();
                                formData.append('id', this.formEdit.id);
                                formData.append('nama_item', this.formEdit.nama_item);
                                formData.append('unit', this.formEdit.unit);
                                formData.append('stok', this.formEdit.stok);
                                formData.append('harga_satuan', this.formEdit.harga_satuan);
                                formData.append('barang', this.formEdit.barang);

                                axios.post('/item/edit-item' , formData, {
                                    'Content-Type': 'multipart/form-data'
                                })
                                .then((response) => {
                                    Swal.fire({
                                        title: response.data.responCode == 1 ? 'Berhasil!' : 'Gagal!',
                                        text: response.data.respon,
                                        icon: response.data.responCode == 1 ? 'success' : 'error',
                                    }).then(()=>{
                                        location.reload();
                                    });
                                })
                            }
                        })
                },
                hapus(id){
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
                            axios.post('/item/delete-item' , {id})
                            .then((response) => {
                                Swal.fire({
                                    title: response.data.responCode == 1 ? 'Berhasil!' : 'Gagal!',
                                    text: response.data.respon,
                                    icon: response.data.responCode == 1 ? 'success' : 'error',
                                }).then(()=>{
                                    location.reload();
                                });
                            })
                        }
                    })
                }
            }
        });//end v
    </script>
@endpush