<div class="alert alert-info" role="alert">
    {{ trans('messages.search-instruction') }}
</div>

<table id="itemtable" class="display" cellspacing="0" width="100%" style="border:1px solid #ddd;" >
<!-- <table id="example2" class="table table-striped table-bordered" cellspacing="0" width="100%" > -->
    <thead>
        <tr>
            @foreach ($tableCols as $key => $name)
                 <th>{{ $name }}</th>
            @endforeach
            
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if (count($results) > 0)
            @foreach ($results as $item)

                <tr>
                    @foreach ($tableCols as $key => $col)
                        @if($key == 'age') 
                            <td> {{ !empty($item->birthdate) ? $item->birthdate->age : '-' }} </td>                           
                        @else
                            <td>{{ $item->$key }}</td>
                        @endif

                    @endforeach

                    <td>
                            <span id="mbr-choice-{{ $item->id }}">
                                @if(in_array($item->id, $current_members))
                                    <a name="mbr_mulselection" class="btn mty-btn grey mbr-mulchosen">
                                        <i class="fa fa-check" aria-hidden="true"></i> Selected
                                    </a>
                                @else
                                    <a name="mbr_mulselection" class="btn mty-btn grey">
                                    Choose Member
                                    </a>                                    
                                @endif
                                
                            </span>
                        <!-- </form> -->
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