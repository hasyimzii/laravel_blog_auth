@extends('dashboard.layouts.body')

@section('title', 'Posts List')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Posts List</li>
    </ol>
</nav>

<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 my-auto p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Posts List</h4>
        </div>
    </div>
    <div class="col-sm-6 my-auto p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <a href="{{ route('dashboard.post.create') }}">
            <button type="button" class="btn btn-success">
                <i class="fas fa-plus-circle mr-1"></i> Create Post
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
                                <th>Published Date</th>
                                <th>Author</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($post as $item)
                                <tr>
                                    <!-- {{--
                                    <td>
                                        <img alt="image" class="p-2" width="90"
                                            src="{{ is_null($item->image) ? asset('assets/admin/images/blank.png') : asset($item->image) }}">
                                    </td>
                                    <td>{{ ($item->status) ? 'Dibuka' : 'Ditutup' }}</td>
                                    --}} -->
                                    @if($item->status == 'published')
                                        <td>{{ \Carbon\Carbon::parse($item->published_date)->isoFormat('ddd, DD MMM YYYY') }}</td>
                                    @else
                                        <td>Not published</td>
                                    @endif
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->title }}</td>
                                    @if($item->status == 'published')
                                        <td><span class="badge badge-success">Published</span></td>
                                    @elseif($item->status == 'draft')
                                        <td><span class="badge badge-warning text-white">Draft</span></td>
                                    @else
                                        <td><span class="badge badge-secondary">Archived</span></td>
                                    @endif
                                    <td>
                                        <a href="{{ route('dashboard.post.show', $item->id) }}"
                                            class="btn btn-info">
                                                <i class="fa fa-eye text-white"></i>
                                        </a>
                                        <a href="{{ route('dashboard.post.edit', $item->id) }}"
                                            class="btn btn-warning">
                                                <i class="fa fa-pencil text-white"></i>
                                        </a>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#confirmation{{ $item->id }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <!-- Confirmation Modal -->
                                        <div class="modal fade" id="confirmation{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmation" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <h1 class="text-center mt-3 mb-3"><i class="fa fa-circle-question fa-xl"></i></h1>
                                                        <h2 class="text-center">Delete Item!</h2>
                                                        <p class="text-center text-secondary">Are you sure you want to delete?</p>
                                                        <div class="flex row justify-content-center mb-3">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <form class="d-inline ml-3" 
                                                                action="{{ route('dashboard.post.delete', $item->id) }}" 
                                                                method="post">
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger">Yes, delete it!</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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

@push('style')
<link href="{{ asset('assets/dashboard/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
@endpush

@push('script')
<script src="{{ asset('assets/dashboard/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/plugins-init/datatables.init.js') }}"></script>
@endpush