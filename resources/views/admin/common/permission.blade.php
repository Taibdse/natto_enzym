<link href="{{ url('assets/admin/assets/vendors/custom/jstree/jstree.bundle.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ url('assets/admin/assets/vendors/custom/jstree/jstree.bundle.js') }}" type="text/javascript"></script>
<script>
    @php
        if(isset($item)){
            $permission = is_array($item->permission) ? $item->permission : explode(',', $item->permission);
        }
    @endphp

    var $data = [
            @foreach($admin_module as $key => $item1)
        {
            "text": '@lang('admin/module.'. $item1['title'])',
            @if(isset($item1['items']))
            "children": [
                    @foreach($item1['items'] as $key2 => $item2)
                {
                    "text": "@lang('admin/module.'. $item2['title'])",
                    "state": {
                        "opened": false
                    },
                    @if(isset($item2['permission']))
                    "children": [
                            @foreach($item2['permission'] as $key3 => $per3)
                        {
                            "text": "@lang('admin/module.' . $per3['title'])",
                            "icon" : "fa {{ $per3['icon'] ?? 'fa-check' }} kt-font-default  ==={{ $item1['route'] ? str_replace('.', '-', $item1['route']) : '' }},{{ $item2['route'] ? str_replace('.', '-', $item2['route']) : '' }},{{ $item2['route'] ? str_replace('.', '-', $item2['route']) : '' }}-{{ $per3['action'] }}",
                            "state": {
                                "selected": @if(in_array($item2['route'].'.'.$per3['action'], $permission ?? [])) true @else false @endif
                            }
                        },
                        @endforeach
                    ]
                    @endif
                },
                @endforeach
            ],
            @elseif(isset($item1['permission']))
            "state": {
                "opened": false,
            },
            "children": [
                    @foreach($item1['permission'] as $key2 => $per2)
                {
                    "text": "{{ $per2['title'] ?? '' }}",
                    "icon" : "fa {{ $per2['icon'] ?? 'fa-check' }} kt-font-default  ==={{ $item1['route'] ? str_replace('.', '-', $item1['route']) : '' }},{{ $item1['route'] ? str_replace('.', '-', $item1['route']) : '' }}-{{ $per2['action'] }}",
                    "state": {
                        "selected": @if(in_array($item1['route'].'.'.$per2['action'], $permission ?? [])) true @else false @endif
                    }
                },
                @endforeach
            ]
            @endif
        },
        @endforeach
    ];
    $('.role_tree').jstree({
        "state" : { "key" : "jstree{{ $item->id ? $item->id : time() }}" },
        'plugins': ["types", "checkbox", "wholerow"],
        'core': {
            "themes" : {
                "responsive": false
            },
            'data': $data
        },
        "types" : {
            "default" : {
                "icon" : "fa fa-folder kt-font-warning"
            },
            "file" : {
                "icon" : "fa fa-file  kt-font-warning"
            }
        },
    }).on("changed.jstree", function (e, data) {
        var i, j, r = [];
        for(i = 0, j = data.selected.length; i < j; i++) {
            var $icon = data.instance.get_node(data.selected[i]).icon;
            $icon = $icon.split('===');
            if ($icon[1]) {
                r.push($icon[1].replace(new RegExp('-', 'g'), '.'));
            }
        }
        $('textarea[name=permission]').val(r.join(','));
        console.log('Selected: ' + r.join(', '));
    });
</script>
