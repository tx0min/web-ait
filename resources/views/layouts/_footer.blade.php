<footer >
    <div class="container"  >
        <div class="row align-items-end">
            <div class="col-md-2 text-center text-md-left pb-4 pb-md-0">
                @svg('img/logo-ait.svg',['style'=>'width:60px','class'=>' fill-white'])

            </div>
            <div class="col-md-6 text-center text-md-left">
                Associació d'Il·lustradores de Tarragona
                <div class="pt-3 social">
                    <a href="https://www.facebook.com/Aitarragona/" class="p-1" title="Facebook" target="_blank">@icon('facebook-f',['type'=>'fab'])</a>
                    <a href="https://twitter.com/aitarragona" class="p-1" title="Twitter"  target="_blank">@icon('twitter',['type'=>'fab'])</a>
                    <a href="https://instagram.com/aitarragona" class="p-1" title="Instagram"  target="_blank">@icon('instagram',['type'=>'fab'])</a>
                    <a href="https://www.youtube.com/channel/UCoEmkI0XBzD9PIue3TeXYJg" class="p-1" title="Youtube"  target="_blank">@icon('youtube',['type'=>'fab'])</a>
                </div>
            </div>
            <div class="col-md-4 text-center text-md-left">
                @include('layouts._mainmenu')

            </div>
        </div>
    </div>
</footer>
