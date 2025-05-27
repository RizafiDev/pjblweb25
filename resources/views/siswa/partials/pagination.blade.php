@if(is_object($siswas) && method_exists($siswas, 'links') && request('per_page') !== 'all')
<div class="row mt-3">
    <div class="col-md-6">
        <div class="dataTables_info">
            Menampilkan {{ $siswas->firstItem() }} sampai {{ $siswas->lastItem() }} dari {{ $siswas->total() }} data
        </div>
    </div>
    <div class="col-md-6">
        <div class="d-flex justify-content-end">
            {{ $siswas->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endif