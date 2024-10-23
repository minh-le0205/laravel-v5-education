@php
    use Illuminate\Support\Facades\Http;

    $apiKey = env('GOOGLE_API_KEY');
    $playlistId = !empty($item['value']) ? explode('=', parse_url($item['value'], PHP_URL_QUERY))[1] : '';

    $listVideo = [];

    if (!empty($playlistId)) {
        $response = Http::get('https://www.googleapis.com/youtube/v3/playlistItems', [
            'part' => 'snippet',
            'maxResults' => 50,
            'playlistId' => $playlistId,
            'key' => $apiKey,
        ]);

        if ($response->ok()) {
            $listVideo = $response->json()['items'];
        }
    }
@endphp
<div class="x_content">
    @if (!empty($listVideo))
        <div class="row">
            @foreach ($listVideo as $video)
                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="x_panel">
                        <div class="x_content">
                            <img style="width: 100%" src="{{ $video['snippet']['thumbnails']['medium']['url'] }}"
                                alt="Card image cap">
                            <div class="text-center">
                                <h6>{{ $video['snippet']['title'] }}</h6>
                                <a target="_blank" class="btn btn-primary"
                                    href="https://youtu.be/{{ $video['snippet']['resourceId']['videoId'] }}">Xem
                                    video</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <h4>Danh sách rỗng</h4>
    @endif
</div>
