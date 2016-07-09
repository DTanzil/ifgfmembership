<div class="alert alert-info" role="alert">
    <?php echo trans('messages.search-instruction', ['role' => $defaultrole]); ?>
</div>
        
<table id="itemtable" class="display" cellspacing="0" width="100%" style="border:1px solid #ddd;" >
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

                    @include('common.tablecols', ['multiple' => true])
                    
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
        @else 
            <tr>
                <td colspan"7">{{ trans('messages.no-data') }}</td>
            </tr>
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