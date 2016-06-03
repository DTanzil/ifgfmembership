<div class="alert alert-info" role="alert">
    {{ trans('messages.search-instruction') }}
</div>

<table id="example" class="display" cellspacing="0" width="100%" style="border:1px solid #ddd;" >
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
                        <td>{{ $item->$key }}</td>
                    @endforeach

                    <!-- Table actions: view,edit,delete -->
                    <td>
                        <!-- <form action="/user/profile/add" method="POST"> -->
                            <!-- {{ csrf_field() }} -->
                            <!-- {{ method_field('POST') }} -->
                            
                            
                            
                            <?php //echo Form::email($name, $value = null, $attributes = []); ?>
                            <span id="mbr-choice-{{ $item->id }}">
                                <a name="mbr_selection" class="btn mty-btn grey">
                                Choose Member
                                </a>
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