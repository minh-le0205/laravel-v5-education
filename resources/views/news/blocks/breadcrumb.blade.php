@php
    use App\Helpers\Url;
@endphp
<div class="home">
    <div class="parallax_background parallax-window" data-parallax="scroll"
        data-image-src="{{ asset('news/images/footer.jpg') }}" data-speed="0.8"></div>
    <div class="home_content_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="home_content">
                        <div class="home_title">{!! $itemCategory['name'] !!}</div>
                        <div class="breadcrumbs">
                            <ul class="d-flex flex-row align-items-start justify-content-start">
                                <li><a href="{{ route('home') }}">Trang chủ</a></li>
                                @if (isset($breadcrumbs))
                                    @foreach ($breadcrumbs as $item)
                                        <li><a href="{!! Url::linkCategory($item['id'], $item['name']) !!}">{!! $item['name'] !!}</a></li>
                                    @endforeach
                                @else
                                    <li>{!! $itemCategory['name'] !!}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
