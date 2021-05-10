@if($folder->getChild->count())

    'children': [
    @foreach($folder->getChild as $folderChildren)
        @if($folderChildren->type == 'folder')
        {
        'text': '{{$folderChildren->name}}',
        'type': 'folder',
        @if($folderChildren->id == $parentid)
            'state': {
            'opened': true,
            'selected': true
            },
        @endif
        "a_attr": {
        "href": "{{route('folder.selected',['id'=>$folderChildren->id])}}"
        },

        @include('admin.files.root',['folder'=>$folderChildren])
        },
        @endif
    @endforeach
    ]

@endif
