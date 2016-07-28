<h2>List of Students & Attendance</h2>
<table id="{{ $tableid or 'attendancetable' }}" class="display cell-border" cellspacing="0" width="100%">
    <thead>
        <tr>
            @foreach ($tableCols as $key => $name)
                 <th>{{ $name }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($fellowship->students as $item)
            <tr class="cap">
                @foreach ($tableCols as $key => $col)
                    @if($key == 'name') 
                        <td>{{ $item->name }}</td>
                    @elseif($key == 'status')
                        <td>{{ $item->pivot->description }} </td>
                    @else
                        <td class="center">
                            <?php 
                            if(isset($class_attendance[$item->id])) {
                                $list = $class_attendance[$item->id];
                                if(in_array($key, $list)) echo '<i class="fa fa-check" aria-hidden="true"></i>';
                            }
                            ?>
                        </td>
                    @endif
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>