@if($hotel->isReservationClock())
    <script src='https://sky-eu1.clock-software.com/js/iframe_integration.js'></script>
    <script>clock_pms_iframe({height: '700px', width: '100%', seamless: 'seamless', frameborder: '0', src: 'https://sky-eu1.clock-software.com/{{$hotel->clock_key}}/wbe/<?php echo $languageSlug; ?>/products/new'})</script>
@endif
