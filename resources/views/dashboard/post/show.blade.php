@extends('admin.layouts.app')

@section('title', 'Detail Blog')
@section('content')
<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 mt-1 p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Detail Blog</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <a href="{{ route('admin.blog.index') }}">
            <button type="button" class="btn btn-light">
                <i class="fas fa-arrow-circle-left mr-1"></i> Kembali
            </button>
        </a>
    </div>
</div>
<!-- row -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="basic-form">
                    <form>
                        <div class="form-group row">
                            <b class="col-sm-2 col-form-label">Gambar</b>
                            <div class="col-sm-10">
                                <img alt="ecommerce" class="object-cover object-center w-full h-full block" width="200"
                                    src="{{ is_null($blog->image) ? asset('assets/images/blank.png') : asset($blog->image) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Judul Blog</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" value="{{ $blog->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kategori Blog</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext"
                                    value="{{ $blog->category->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Form Url Blog</label>
                            <div class="col-sm-9 pt-1 text-dark">
                                {{ $blog->form_url }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Status Form Blog</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" 
                                value="{{ ($blog->active) ? 'Dibuka' : 'Ditutup' }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Deskripsi Blog</label>
                            <div class="col-sm-9 pt-1 text-dark">
                                {!! $blog->description !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Tanggal</label>
                            <div class="col-sm-9">
                                <input type="text" readonly class="form-control-plaintext" 
                                value="{{ \Carbon\Carbon::parse($blog->created_at)->isoFormat('ddd, DD MMM YYYY') }}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
