@if($hotel->isReservationTravelline())
    <script type='text/javascript'>
        $(document).ready(function () {
            (function (w) {
                var q   = [
                    ['setContext', '{{ $hotel->travelline_key }}', '<?php echo $languageSlug; ?>'],
                    ['embed', 'booking-form', {
                        container: 'my-booking-form'
                    }]
                ];
                var t   = w.travelline = (w.travelline || {}),
                    ti  = t.integration = (t.integration || {});
                ti.__cq = ti.__cq ? ti.__cq.concat(q) : q;
                if (!ti.__loader) {
                    ti.__loader = true;
                    var d       = w.document,
                        p       = d.location.protocol,
                        s       = d.createElement('script');
                    s.type      = 'text/javascript';
                    s.async     = true;
                    s.src       = (p == 'https:' ? p : 'http:') + '//bg-ibe.tlintegration.com/integration/loader.js';
                    (d.getElementsByTagName('head')[0] || d.getElementsByTagName('body')[0]).appendChild(s);
                }
            })(window);
        });
    </script>
    <div id='my-booking-form'></div>
    <script src="{{ asset('website/plugins/travelline/js/loader.js') }}"></script>
@endif
