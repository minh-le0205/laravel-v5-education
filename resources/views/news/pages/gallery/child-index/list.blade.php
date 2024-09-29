<div class="posts">
    <div class="col-lg-12">
        <div class="row">
            @foreach ($items as $item)
                @php
                    $filename = $item->getFilename();
                @endphp
                <div class="col-lg-4">
                    <img style="width: 100%; padding-bottom:20%;" src="{{ asset('images/gallery/' . $filename) }}"
                        alt="" srcset="">
                </div>
            @endforeach
        </div>
    </div>
</div>
