<div id="paginate-content">
<div class="page-items">
@foreach ($paginateData['items'] as $user)
<div class="page-item" dataid="{{ $user->id }}">
<div><b>Name:</b> <span>{{ $user->name }}</span></div>
<div><b>Second Name:</b> <span>{{ $user->name_parent }}</span></div>
<div><b>Family Name:</b> <span>{{ $user->name_family }}</span></div>
<div><b>Email:</b> <span>{{ $user->email }}</span></div>
<div><b>Civil Id:</b> <span>{{ $user->civil_id }}</span></div>
@if(!empty($user['phone1']))
<div><b>Phone 1:</b> <span>{{ $user['phone1']->phone_type }}, {{ $user['phone1']->phone_ext }}, {{ $user['phone1']->phone_number }}</span></div>
@endif
@if(!empty($user['phone2']))
<div><b>Phone 2:</b> <span>{{ $user['phone2']->phone_type }}, {{ $user['phone2']->phone_ext }}, {{ $user['phone2']->phone_number }}</span></div>
@endif
</div>
<br/>
@endforeach
</div>
<hr/>
<br/>
<div class="pagination">
<div>Page: {{ $paginateData['page'] }}</div>
<div>Total Pages: {{ $paginateData['pages'] }}</div>
<div>Items: {{ $paginateData['count'] }}</div>
<div>Limit: {{ $paginateData['limit'] }}</div>
<div>Total Items: {{ $paginateData['total'] }}</div>
<br/>
<div class="page-buttons">
<a href="/paginator/1/">First Page</a>
<a href="/paginator/{{ $paginateData['page_prev'] }}/">Prev Page</a>
<a href="/paginator/{{ $paginateData['page_next'] }}/">Next Page</a>
<a href="/paginator/{{ $paginateData['pages'] }}/">Last Page</a>
</div>
</div>
<br/>
<div class="back-main">
<a href="/">Back to main</a>
</div>
</div>