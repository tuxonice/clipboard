<?php echo('<?xml version="1.0" encoding="UTF-8"?>'); ?>
<root>
@foreach($data as $item)
{!! $item['startTag'] !!}{{ $item['content'] }}{!! $item['endTag'] !!}
@endforeach
</root>
