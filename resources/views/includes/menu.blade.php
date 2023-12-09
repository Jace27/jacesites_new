<div class="main_menu">
    <ul>
        @foreach(\App\Models\SitePages::whereShowInMenu(true)->orderBy('priority', 'desc')->get() as $key => $page)
            <li><a href="{{ $page->link }}">{{ $page->name }}</a></li>
        @endforeach
    </ul>
</div>
