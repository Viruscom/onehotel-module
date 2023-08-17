@if($hotel->isReservationClientric())
    @php $url = 'https://' . $hotel->clientric_key . '.book-onlinenow.net/index.aspx?Page=1&lan_id=bg-BG'; @endphp
    <script>
        window.open('{{ $url }}');
        window.location.href = '{{ url('/'.$languageSlug) }}';
    </script>
@endif
