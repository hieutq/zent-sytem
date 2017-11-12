@extends('layouts.master')
@section('contents')
<div class="options clearfix">
<div class="ck-button">
<label><input type="checkbox" value="1" name="first_name" checked="checked"><span>First Name</span></label>
</div>
<div class="ck-button">
<label><input type="checkbox" value="1" name="last_name" checked="checked"><span>Last Name</span></label>
</div>
<div class="ck-button">
<label><input type="checkbox" value="1" name="email"><span>Email</span></label>
</div>
</div>

<table class="table table-striped table-bordered table-hover table-condensed">
<thead>
<tr>
 <th class="first_name">First Name</th>
 <th class="last_name">Last Name</th>
 <th class="email">Email</th>
</tr>
</thead>
<tbody>
<tr>
 <td class="first_name">Larry</td>
 <td class="last_name">Hughes</td>
 <td class="email">larry@gmail.com</td>
</tr>
<tr>
 <td class="first_name">Mike</td>
 <td class="last_name">Tyson</td>
 <td class="email">mike@gmail.com</td>
</tr>
</tbody>
<script type="text/javascript">
	$("input:checkbox:not(:checked)").each(function() {
    var column = "table ." + $(this).attr("name");
    $(column).hide();
});

$("input:checkbox").click(function(){
    var column = "table ." + $(this).attr("name");
    $(column).toggle();
});
</script>
@endsection