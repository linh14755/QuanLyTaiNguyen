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
            "href": "{{route('file.selected',['id'=>$folderChildren->id])}}"
            },

            @include('admin.uploadfile.root',['folder'=>$folderChildren])
            },
        @endif
    @endforeach
    ]

@endif
