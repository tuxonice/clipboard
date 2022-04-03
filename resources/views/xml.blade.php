<?php echo('<?xml version="1.0" encoding="UTF-8"?>'); ?>
<root>
    @foreach($storedValue as $key => $value)
        <{{ $key }}>{{ htmlentities($value) }}</{{ $key }}>
    @endforeach
</root>
