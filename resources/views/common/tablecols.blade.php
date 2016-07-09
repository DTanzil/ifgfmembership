@foreach ($tableCols as $key => $col)
    @if($key == 'age') 
        <td> {{ !empty($item->birthdate) ? $item->birthdate->age : '-' }} </td> 
    @elseif($key == 'role')
        <td>{{ $item->title }}</td>
    @elseif($key == 'is_member')
        <td>{{ $item->$key ? 'Member' : 'Visitor'}}</td>
    @elseif($key == 'member_count')
        <td>{{ count($item->members) }}</td>
    @elseif($key == 'ministry' || $key == 'icare' || $key == 'family')
        <td>
           <?php 
                $list = $item->$key->toArray();
                if(count($list) == 0) echo "-"; 
                for ($i=0; $i < count($list); $i++) { 
                    echo $list[$i]['name'];
                    if(next($list) !== FALSE) echo ", ";                                                    
                }                                        
            ?>
        </td>
    @elseif(isset($multiple) && $multiple && $key == 'name')
        <td class="dtname">{{ $item->$key }}</td>
    @else
        <td>{{ $item->$key or ''}}</td>
    @endif
@endforeach
