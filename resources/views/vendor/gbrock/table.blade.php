<table class="{{ $class or 'table' }}">
    @if(count($columns))
	<thead>
		<tr>
        @foreach($columns as $c)
            <th {!! $c->getClasses() ? ' class="' . $c->getClassString() . '"' : '' !!}>
                @if($c->isSortable())
                    <a href="{{ $c->getSortURL() }}">
                        {!! $c->getLabel() !!}
                        @if($c->isSorted())
                            @if($c->getDirection() == 'asc')
                                <span class="fa fa-sort-asc"></span>
                            @elseif($c->getDirection() == 'desc')
                                <span class="fa fa-sort-desc"></span>
                            @endif
                        @endif
                    </a>
                @else
                    {{ $c->getLabel() }}
                @endif
            </th>
        @endforeach

		</tr>
	</thead>
    @endif
	<tbody>
        <?php $totalIn = 0; $totalOut = 0; $totalHold = 0; ?>
        @if(count($rows))
            @foreach($rows as $r)
            <tr class = "datarow">

            @foreach($columns as $c)
                 <td data-val="{!! $r->id !!}" data-toggle="modal"
                 @if ($loop->index < 4)
                   style="width:140px"
                 @endif
                 @if ($r->{$c->getField()} == "Delete" or $r->{$c->getField()} == "Modify")
                   @if ($r->{$c->getField()} == "Delete")
                   class = "deleterequest"
                   style = "background-color: lightgreen;"
                   data-target="#viewdeletecashmodal"
                   @else
                   class = "changerequest"
                   style = "background-color: lightgreen;"
                   data-target="#viewchangecashmodal"
                   @endif
                 @else
                   class = "datacell"
                   data-target="#changecashmodal"
                 @endif
                 {!! $c->getClasses() ? ' class="' . $c->getClassString() . '"' : '' !!}>
                 @if($c->hasRenderer())
                    {{-- Custom renderer applied to this column, call it now --}}
                    {!! $c->render($r) !!}
                 @else
                    {{-- Use the "rendered_foo" field, if available, else use the plain "foo" field --}}
                    @if ($r->{$c->getField()} == "Delete" or $r->{$c->getField()} == "Modify")
                      @if ($r->{$c->getField()} == "Delete")
                      <span><b>{!! $r->{'rendered_' . $c->getField()} or $r->{$c->getField()} !!}</b></span>
                      @else
                      <span style="color:brown;"><b>{!! $r->{'rendered_' . $c->getField()} or $r->{$c->getField()} !!}</b></span>
                      @endif
                    @else
                    {!! $r->{'rendered_' . $c->getField()} or $r->{$c->getField()} !!}
                    @endif
                 @endif
                 @if ($loop->index == 4)
                   <?php $totalIn += substr($r->{$c->getField()}, 1); ?>
                 @endif
                 @if ($loop->index == 5)
                   <?php $totalOut += substr($r->{$c->getField()}, 1); ?>
                 @endif
                 @if ($loop->index == 6)
                   <?php $totalHold += substr($r->{$c->getField()}, 1); ?>
                 @endif
                 </td>
            @endforeach
            </tr>

            @endforeach
        @endif
        @if(count($rows) < 15)
            @for ($i = 0; $i < 15 - count($rows); $i++)

            <tr>
            @for ($j = 0; $j < count($columns); $j++)
                <td>&nbsp;
                </td>
            @endfor
            </tr>

            @endfor
        @endif
        <tr>
            <td colspan = "4">Totals</td>
            <td>${!! number_format($totalIn, 2, '.', '') !!}</td>
            <td>${!! number_format($totalOut, 2, '.', '') !!}</td>
            <td>${!! number_format($totalHold, 2, '.', '') !!}</td>
            <td>
              <div class="row">
                <div class="col-xs-1 col-md-2">
                </div>
                <div class="col-xs-5 col-md-7">
                </div>
                <div class="col-xs-3 col-md-2">
                  <a href="#" id = "addcashlink" data-toggle="modal" data-target="#addcashmodal"><h1><i id = "addcash" class="fa fa-plus-circle" aria-hidden="true"></i></h1></a>
                </div>
              </div>
            </td>
        </tr>
	</tbody>
</table>

@if(is_object($rows) && class_basename(get_class($rows)) == 'LengthAwarePaginator')
    {{-- Collection is paginated, so render that --}}
    {!! $rows->render() !!}
@endif
