@foreach ($tableCols as $key => $col)
    @if($key == 'age') 
        <td> {{ !empty($item->birthdate) ? $item->birthdate->age : '-' }} </td> 
    @elseif($key == 'role')
        <td>{{ $item->pivot->title }}</td>
    @elseif($key == 'email')
        <td style="text-transform:lowercase;">{{ $item->$key }}</td>
    @elseif($key == 'is_member')
        @if($item->isMember())
            <td style="color:blue;"><b>Member</b></td>
        @else
            <td style="color:red;"><b>Visitor</b></td>
        @endif
    @elseif($key == 'service')
        <td><?php echo Config::get("constants.IBADAH.{$item->service}"); ?></td>
    @elseif($key == 'member_count')
        <td>{{ count($item->members) }}</td>
    @elseif($key == 'student_count')
        <td>{{ count($item->students) }}</td>
    @elseif($key == 'hours')
        <td>{{ $item->hours }}:{{ $item->minutes }}</td>
    @elseif($key == 'leader')
        <td></td>
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
