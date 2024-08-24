<div class="x_content">
    <div class="row">
        <div class="col-md-6">
            <div class="col-mb-0">
                <span class="label label-info label-pagination">{{ $items->perPage() }} items per page</span>
                <span class="label label-success label-pagination">{{ $items->total() }} items</span>
                <span class="label label-danger label-pagination">{{ $items->lastPage() }} items last page</span>
            </div>
        </div>
        <div class="col-md-6">
            {{ $items->appends(request()->input())->links('pagination.pagination_backend') }}
        </div>
    </div>
</div>
