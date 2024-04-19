 {{-- @extends('layouts.user_type.auth')

 @section('content')
     <div class="container">
         <h3 class="text-center mt-4 mb-5">edit data pegawai</h3>
         <div class="row justify-content-center">
             <div class="col-8">
                 <div class="card">
                     <div class="card-body">
                         <form action="/updatedata/{{ $data->id }}" method="post" enctype="multipart/form-data">
                             @csrf
                             <div class="mb-3">
                                 <label for="nama" class="form-label">nama</label>
                                 <input type="text" name="nama" class="form-control" value="{{ $data->nama }}">
                             </div>


                             <div class="mb-3">
                                 <label for="jurusan" class="form-label">jurusan</label>
                                 <select class="form-select" name="jurusan" aria-label="Default select example">
                                     <option selected>{{ $data->jurusan }}</option>
                                     <option value="1">rpl</option>
                                     <option value="2">multimedia</option>
                                 </select>
                             </div>


                             <div class="mb-3">
                                 <label for="kelas" class="form-label">Kelas</label>
                                 <input type="text" name="kelas"class="form-control" value="{{ $data->kelas }}">
                             </div>
                             <button type="submit" class="btn btn-primary">Submit</button>
                         </form>
                     </div>
                 </div>
             </div>
             --}}
