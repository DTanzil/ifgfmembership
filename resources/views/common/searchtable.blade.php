<div class="alert alert-info" role="alert">
    <?php echo trans('messages.search-instruction', ['role' => $defaultrole]); ?>
</div>
        
<table id="itemtable" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            @foreach ($tableCols as $key => $name)
                <th>{{ $name }}</th>
            @endforeach
                <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $selected = array(); ?>
        @if (count($results) > 0)
            @foreach ($results as $item)
                <tr class="cap">
                    @foreach ($tableCols as $key => $col)
                        @if($key == 'age') 
                            <td> {{ !empty($item->birthdate) ? $item->birthdate->age : '-' }} </td> 
                        @elseif($key == 'role')
                            <td>{{ $item->title }}</td>
                        @elseif($key == 'is_member')
                            <td>{{ $item->$key ? 'Member' : 'Visitor'}}</td>
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
                        @elseif($key == 'name')
                            <td class="dtname">{{ $item->$key }}</td>
                        @else
                            <td>{{ $item->$key or ''}}</td>
                        @endif
                    @endforeach
                    <td>
                        <span id="mbr-choice-{{ $item->id }}">
                            @if(in_array($item->id, $current_members))
                                <?php $selected[$item->id] = $item->name; ?>
                                <a name="mbr_mulselection" class="btn mty-btn grey mbr-mulchosen">
                                    <i class="fa fa-check" aria-hidden="true"></i> Selected
                                </a>
                            @else
                                <a name="mbr_mulselection" class="btn mty-btn grey">
                                Choose Member
                                </a>                                    
                            @endif
                        </span>
                    </td>
                </tr>
            @endforeach
    
        @endif
    </tbody>
</table>

<div class="center" style="margin:30px; border:1px solid #3aa0b7; border-top:3px solid #3aa0b7; padding:10px;">
    <p> Currently selected <span class="cap">{{ $defaultrole }}</span> from this list: </p> 
    <p id="selectedmembers"> 
        @foreach($selected as $id => $person)
            <span id="mbr_chs_{{ $id }}" class="chosen">{{ $person }}</span>
        @endforeach
    </p>
</div>