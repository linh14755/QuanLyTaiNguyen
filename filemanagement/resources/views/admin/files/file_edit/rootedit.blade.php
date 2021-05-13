@if($folder->getChild->count())

    'children': [
    @foreach($folder->getChild as $folderChildren)
        @if($folderChildren->type == 'folder')
            {
            'id': '{{$folderChildren->id}}',
            'text': '{{$folderChildren->name}}',
            'type': 'folder',
            @if($folderChildren->id == $parentid)
                'state': {
                'opened': true,
                'selected': true
                },
            @endif
            @include('admin.files.file_edit.rootedit',['folder'=>$folderChildren])
            },
        @endif
    @endforeach
    ]

@endif
