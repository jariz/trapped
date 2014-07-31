@if($thread->votes > 3)
label-success
@elseif($thread->votes <= 3 && $thread->votes >= 1)
label-warning
@elseif($thread->votes <= 0)
label-danger
@endif