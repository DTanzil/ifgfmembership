<h2>List of Members</h2>
<table id="itemtable" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            @foreach ($tableCols as $key => $name)
                 <th>{{ $name }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($fellowship->members as $item)
                    <tr class="cap">
                        @include('common.tablecols')
                    </tr>
        @endforeach

    </tbody>
</table>