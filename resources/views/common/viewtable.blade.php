<h2>List of Members</h2>
<table id="itemtable" class="display" cellspacing="0" width="100%" style="border:1px solid #ddd;" >
    <thead>
        <tr>
            @foreach ($tableCols as $key => $name)
                 <th>{{ $name }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($order as $role)
            @if (isset($members[$role]) && count($members[$role]) >= 1)
                @foreach ($members[$role] as $item)
                    <tr class="cap">
                        @include('common.tablecols')
                    </tr>
                @endforeach
            @endif
        @endforeach
    </tbody>
</table>