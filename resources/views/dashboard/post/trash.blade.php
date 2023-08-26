@extends('admin.layouts.app')

@section('title', 'Data Sampah Blog')
@section('content')
<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 mt-1 p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Data Sampah Blog</h4>
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
                <div class="table-responsive">
                    <table id="example" class="display text-muted" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Status Form</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($blog as $item)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('ddd, DD MMM YYYY') }}</td>
                                    <td>
                                        <img alt="image" class="p-2" width="90"
                                            src="{{ is_null($item->image) ? asset('assets/admin/images/blank.png') : asset($item->image) }}">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ ($item->active) ? 'Dibuka' : 'Ditutup' }}</td>
                                    <td>
                                        <a href="javascript:void()"
                                            onclick="event.preventDefault(); document.getElementById('restore{{ $item->id }}').submit();"><button
                                                class="btn btn-success"><i
                                                    class="fa fa-recycle text-white"></i></button></a> &nbsp;
                                        </a>
                                        <form id="restore{{ $item->id }}"
                                            action="{{ route('admin.blog.restore', $item->id) }}"
                                            method="post" style="display: none;">
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
