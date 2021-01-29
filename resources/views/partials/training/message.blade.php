<div class="font-bold text-blue-800">
    @if($message === 'created')
        <span
            x-data="{show: true}"
            x-init="
                setTimeout(() => { show = false }, 2500)
                setTimeout(() => { $refs.this.remove() }, 3500)
            "
            x-show.transition.duration.1000ms="show"
            x-ref="this"
            >Record Created!
        </span>
    @elseif ($message === 'saved')
        <span
            x-data="{show: true}"
            x-init="
                setTimeout(() => { show = false }, 2500)
                setTimeout(() => { $refs.this.remove() }, 3500)
            "
            x-show.transition.duration.1000ms="show"
            x-ref="this"
            >Record Saved!
        </span>
    @elseif ($message === 'deleted')
        <span
            x-data="{show: true}"
            x-init="
                setTimeout(() => { show = false }, 2500)
                setTimeout(() => { $refs.this.remove() }, 3500)
            "
            x-show.transition.duration.1000ms="show"
            x-ref="this"
            >Record Deleted!
        </span>
    @endif
</div>
