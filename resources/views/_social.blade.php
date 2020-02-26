@if($facebook=$user->acf->url('facebook'))
    <a href="{{$facebook}}" class="p-1" title="Facebook" target="_blank">@icon('facebook-f',['type'=>'fab'])</a>
@endif
@if($twitter=$user->acf->url('twitter'))
    <a href="https://twitter.com/{{$twitter}}" class="p-1" title="Twitter"  target="_blank">@icon('twitter',['type'=>'fab'])</a>
@endif
@if($instagram=$user->acf->url('instagram'))
    <a href="https://instagram.com/{{$instagram}}" class="p-1" title="Instagram"  target="_blank">@icon('instagram',['type'=>'fab'])</a>
@endif
@if($youtube=$user->acf->url('youtube'))
    <a href="{{$youtube}}" class="p-1" title="Youtube"  target="_blank">@icon('youtube',['type'=>'fab'])</a>
@endif
@if($linkedin=$user->acf->url('linkedin'))
    <a href="{{$linkedin}}" class="p-1" title="LinkedIn"  target="_blank">@icon('linkedin',['type'=>'fab'])</a>
@endif