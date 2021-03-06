@extends("layouts.app")

@section('page')
    <div class="col-lg-12">
        <div class="main_blog_details">
            <div class="card" style="max-width: 100%">

                <div class="card-header">
                    <h4>{{ $page->title }}</h4>

                </div>
                <div class="card-body">
                    {!! $page->content !!}</div>
                <div class="card-footer">
                    <div class="news_d_footer">
                        <a href="#"><i class="lnr lnr lnr-clock"></i>{{  date("d M Y h:i a", strtotime($page->created_at)) }}</a>
                        {{--<div class="justify-content-center ml-auto" ><i class="lnr lnr lnr-bubble"></i> <a href="{{ url()->current().'#disqus_thread' }}">0 comment</a> </div>--}}
                        <div class="news_socail ml-auto">
                            @foreach((config('site.social')) as $name => $url)
                                <a href="{{http($url)}}" target="_blank"><i class="fa fa-{{$name}}"></i></a>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

            {{--<div class="card mb-3 mt-3">--}}
                {{--<div class="card-body">--}}
                    {{--<div id="disqus_thread"></div>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>
        @endsection
        @push('js')
            <script>

                /**
                 *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                 *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/

                var disqus_config = function () {
                    this.page.url = "{{ url()->current() }}";  // Replace PAGE_URL with your page's canonical URL variable
                    this.page.identifier = "pro-{{ $page->slug }}"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                };

                (function() { // DON'T EDIT BELOW THIS LINE
                    var d = document, s = d.createElement('script');
                    s.src = 'https://rrd-2.disqus.com/embed.js';
                    s.setAttribute('data-timestamp', +new Date());
                    (d.head || d.body).appendChild(s);
                })();
            </script>
            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>        @endpush
        @push('css')
                <style>
                img {
                    max-width: 100%;
                }

                .img-fluid {
                    background: #bdbdbd;
                    padding: 12px;
                }

                .about-content {
                    color: white;
                    mix-blend-mode: difference;
                    text-align: center
                }

            </style>
    @endpush
